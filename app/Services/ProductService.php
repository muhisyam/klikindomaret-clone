<?php

namespace App\Services;

use App\Enums\DeployStatus;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ImageService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ProductService 
{
    /**
     * Amount essential data that included to keywords.
    */ 
    private int $amountEssentialKeywords;

    /**
     * Create a new resource instance.
    */
    public function __construct(
        protected PaginationService $paginationService,
        protected ImageService      $imageService,
    ) {}

    // MARK: Updating meta link.
    /**
     * Formating pagination page number navigation.
     * 
     * @param array $response
     * @param string $url
    */
    public function updatingMetaLink(array $response): array
    {
        if (! $this->isResponsePagination($response)) {
            return $response;
        }

        $response['meta']['links'] = $this->paginationService->customPaginationLinks($response['meta']);

        return $response;
    }

    // MARK: Set filter key.
    /**
     * Set available filter table key. 
     * 
     * @param array $response
    */
    public function setFilterKey(array $response): array
    {
        if (! $this->isResponsePagination($response)) {
            return $response;
        }

        $response['filter'] = [
            [
                'search' => 'product_deploy_status',
                'value'  => DeployStatus::DRAFT->value,
                'label'  => DeployStatus::DRAFT->value,
            ],
            [
                'search' => 'product_deploy_status',
                'value'  => DeployStatus::PUBLISHED->value,
                'label'  => DeployStatus::PUBLISHED->value,
            ],
        ];

        return $response;
    }
    
    private function isResponsePagination(array $response): bool
    {
        return Arr::exists($response, 'links') ? true : false;
    }
    
    // MARK: Set necessary data.
    /**
     * Mutators to set the necessary data of category.
     * 
     * @param array $formData
     * @param array $column
    */
    public function setNecessaryData(array $formData, array $column): array
    {
        // Combine existing meta keyword with some essential data
        if (in_array('keywords', $column)) {
            $categoryName = Category::find($formData['category_id'])->category_name;
            $brandName    = Brand::find($formData['brand_id'])->brand_name;
            $keywords     = implode(',', $formData['product_meta_keyword']);
            $keywords     = $keywords . ',pn-' . $formData['product_name'] . ',bn-' . $brandName . ',cn-' . $categoryName;
            
            $this->amountEssentialKeywords = 3;

            $formData['product_meta_keyword'] = $keywords;
        }

        // Create new array contains name of images
        if (in_array('raw_data_images', $column) && isset($formData['product_images'])) {
            $imageTemp = [];

            for ($i = 0; $i < count($formData['product_images']); $i++) { 
                [$randomName, $originalName] = $this->imageService->getDataImage($formData['product_images'][$i]);

                $imageTemp[] = [
                    'product_image_name'          => $randomName,
                    'original_product_image_name' => $originalName,
                ];
            }

            $formData['many_images'] = $imageTemp;
        }

        return $formData;
    }

    // MARK: Handle image directory
    /**
     * Handle image directory such as delete existing image depend on form delete_product_images or 
     * delete directory if new images is exists.
     * 
     * @param array  $formData
     * @param string $productSlug
    */
    public function handleImageDirectory(array $formData, string $productSlug): bool
    {
        $whetherImageKeyExists = isset($formData['delete_product_images']) || isset($formData['product_images']);
        $ifNewImagesExists     = isset($formData['product_images']);

        if (! $whetherImageKeyExists) {
            return false;
        }

        if ($ifNewImagesExists) {
            return $this->imageService->deleteDirectory('img/uploads/products/' . $productSlug);
        }

        for ($i = 0; $i < count($formData['delete_product_images']); $i++) { 
            $this->imageService->deleteExistsImage(
                dataImageName:  $formData['delete_product_images'][$i], 
                folderSaveName: 'products/' . $productSlug,
            );
        }

        return true;
    }

    // MARK: Save image to db
    /**
     * Save image if exists in formdata.
     * 
     * @param \App\Models\Product $product
     * @param array               $formData
    */
    public function saveImageToDbIfExists(Product $product, array $formData): void
    {
        if (isset($formData['many_images'])) {
            $product->images()->createMany($formData['many_images']);
        }
    }
    
    // MARK: Save image to asset
    /**
     * Prepare essential data before save image to asset.
     * 
     * @param array $formData
    */
    public function saveImagesToAsset(array $formData): bool
    {
        if (! isset($formData['product_images'])) {
            return false;
        }
        
        $folderPath = 'products/' . $formData['product_slug'];
        $countImage = count($formData['product_images']);

        for ($i = 0; $i < $countImage; $i++) { 
            $fileName = $formData['many_images'][$i]['product_image_name'];

            $this->imageService->saveImage(
                image:      $formData['product_images'][$i], 
                folderPath: $folderPath, 
                imageName:  $fileName
            );
        }

        return true;
    }
    
    // MARK: Get discount percent
    /**
     * Accessor get discount percent if exists.
     * 
     * @param \App\Models\Product $product
     * @param bool                $isHasDiscount
    */
    public function getDiscountPercent(Product $product, bool $isHasDiscount): string|null
    {
        return $isHasDiscount
            ? round((($product->normal_price - $product->discount_price) / $product->normal_price) * 100) . '%'
            : null;
    }

    // MARK: Get image path
    /**
     * Accessor get image path.
     * 
     * @param \App\Models\Product $product
     * @param string              $productImage
    */
    public function getImagePath(Product $product, string $productImage): string|null
    {
        if (is_null($productImage)) {
            return null;
        }

        $isNotDefaultImage = ! str_contains($productImage, 'product-default-image');
        $imagePath         = $isNotDefaultImage ? $product->product_slug . '/' : '';

        return $imagePath;
    }
    
    // MARK: Get image size
    /**
     * Accessor get image size.
     * 
     * @param \App\Models\ProductImage $productImage
     * @param string                   $imagePath
    */ 
    public function getImageSize(ProductImage $productImage, string $imagePath): string
    {
        if (is_null($productImage->product_image_name)) {
            return null;
        }

        $imagePath = 'img/uploads/products/' . $imagePath . $productImage->product_image_name;

        return File::exists($imagePath) ? round(filesize($imagePath) / 1024) . ' kB' : null;
    }

    // MARK: Filter keyword
    /**
     * Filtering keyword which mean remove the last three keyword such as product name (pn-), 
     * brand name (bn-), category name (cn-).
     * 
     * @param string $productKeyword
    */ 
    public function filterKeywords(string $productKeyword): array
    {
        $keywordInArray   = explode(',', $productKeyword);
        $newLength        = count($keywordInArray) - $this->amountEssentialKeywords;
        $filteredKeywords = array_slice($keywordInArray, 0, $newLength);

        return $filteredKeywords;
    }
}