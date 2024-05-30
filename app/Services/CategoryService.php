<?php

namespace App\Services;

use App\Enums\DeployStatus;
use App\Models\Category;
use App\Services\Backend\ImageService;
use App\Services\Backend\PaginationService;
use Illuminate\Support\Arr;

class CategoryService 
{
    /**
     * Create a new resource instance.
     *
     * @return void
    */
    public function __construct(
        protected PaginationService $paginationService
    ) {}

    /**
     * Mutators to set the necessary data of category.
     * 
     * @param array $formData
     * @param array $column
     * @param \App\Models\Category $category
     * @return array $formData
    */
    public function setNecessaryData(array $formData, array $column, Category $category = null): array
    {
        /**
         * Set parent id data to null or int. Null means the category is parent category, 
         * apart from that, it is a subcategory.
        */
        if (in_array('parent_id', $column)) {
            $formData['parent_id'] = $formData['parent_id'] == '0' ? null : $formData['parent_id'];
        }

        /**
         * Set form category image value, for cases of deleting or updating images.
         * - First check if form has between delete or new image key.
         * - Set image value to new image data if new image is exists.
         * - Set image value to null if new image not exists, it mean category image will be remove.
        */
        $whetherTheSpecificKeyWasFound = isset($formData['delete_category_image']) || isset($formData['category_image_name']);

        if (in_array('set_image_value', $column) && $whetherTheSpecificKeyWasFound) {
            $formData['category_image_name'] = $formData['category_image_name'] ?? null;
        }

        /**
         * Set the category image and original image name, if new image is found.
        */
        if (in_array('category_image_name', $column) && $whetherTheSpecificKeyWasFound) {
            $imageService = new ImageService;

            /**
             * Remove existing category image using current category image name when not null.
            */
            $imageService->deleteExistsImage($category?->category_image_name, 'categories');

            /**
             * Generate new image name, if formData is null (cause of the command 
             * to delete image), all image data will be set to null.
            */
            [$formData['category_image_name'], $formData['original_category_image_name']] = $imageService->storeImage($formData['category_image_name'], 'categories');
        }

        return $formData;
    }
    
    /**
     * Change pagination url links from api link to web link. Then format pagination 
     * page number navigation. 
     * 
     * @param array $response
     * @param string $url
    */
    public function updatingMetaLink(array $response, string $url): array
    {
        if (! $this->isResponsePagination($response)) {
            return $response;
        }

        $response['meta']['links'] = $this->paginationService->customPaginationLinks($response['meta']);

        return $response;
    }

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
}