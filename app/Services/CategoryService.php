<?php

namespace App\Services;

use App\Enums\DeployStatus;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Support\Arr;

class CategoryService 
{
    /**
     * Create a new resource instance.
    */
    public function __construct(
        protected PaginationService $paginationService
    ) {}

    // MARK: Updating meta link.
    /**
     * Formating pagination page number navigation. 
     * 
     * @param array $response
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
                'search' => 'category_deploy_status',
                'value'  => DeployStatus::DRAFT->value,
                'label'  => DeployStatus::DRAFT->value,
            ],
            [
                'search' => 'category_deploy_status',
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
     * @param array                     $formData
     * @param array                     $column
     * @param null|\App\Models\Category $category
     * @return array                    $formData
    */
    public function setNecessaryData(array $formData, array $column, null|Category $category = null): array
    {
        // Set parent id data to null or int. Null means the category is parent category, 
        // apart from that, it is a subcategory.
        if (in_array('parent_id', $column)) {
            $formData['parent_id'] = $formData['parent_id'] == '0' ? null : $formData['parent_id'];
        }

        // Set form category image value, for cases of deleting or updating images.
        // - First check if form has between delete or new image key.
        // - Set image value to new image data if new image is exists.
        // - Set image value to null if new image not exists, it mean category image will be remove.
        $whetherImageKeyExists = isset($formData['delete_category_image']) || isset($formData['category_image']);

        if (in_array('category_image_name', $column) && $whetherImageKeyExists) {
            $imageName = $category ? $category->category_image_name : '';

            // Concern if category_image_name is null
            $imageName    = $imageName ?? '';
            $dataImage    = $formData['category_image'] ?? null;
            $imageService = new ImageService;

            $imageService->deleteExistsImage('categories', $imageName);

            // Generate new image name, if formData is null (cause of the command to delete image), 
            // all image data will be set to null.
            [$formData['category_image_name'], $formData['original_category_image_name']] = $imageService->getDataImage($dataImage, 'categories');
        }

        return $formData;
    }

    // MARK: Save image to asset.
    /**
     * Saves the category image file to the asset.
     *
     * @param array $formData The form data containing the category image.
    */
    public function saveImagesToAsset(array $formData): bool
    {
        if (! isset($formData['category_image'])) {
            return false;
        }
        
        $imageService = new ImageService;

        $imageService->saveImage(
            image:      $formData['category_image'],
            imageName:  $formData['category_image_name'],
            folderPath: 'categories'
        );

        return true;
    }
    
}