<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ImageService 
{
    // MARK: Get data image
    /**
     * Retrieves the data image information such as the random image name and the original image name.
     *
     * @param \Illuminate\Http\UploadedFile|null $dataImage The uploaded image file.
    */
    public function getDataImage(UploadedFile|null $dataImage): array|null
    {
        if (is_null($dataImage)) {
            return null;
        }
        
        // Generate random image name.
        $randomImageName = time() . mt_rand(11, 99) . '.' . strtolower($dataImage->getClientOriginalExtension());

        // Get original image name.
        $originalImageName = explode('.', $dataImage->getClientOriginalName());
        $originalImageName = $originalImageName[0]  . '.' . strtolower($dataImage->getClientOriginalExtension());

        return [$randomImageName, $originalImageName]; 
    }

    // MARK: Save image
    /**
     * Saves the image file to the public directory.
     * 
     * @param \Illuminate\Http\UploadedFile|null $image The uploaded image file.
     * @param string                             $folderPath The folder path where the image will be saved.
     * @param string                             $imageName The image name.
    */
    public function saveImage(UploadedFile|null $image, string $folderPath, string $imageName): void 
    {
        if (! is_null($image)) {
            $image->move('img/uploads/' . $folderPath . '/', $imageName);
        }
    }

    // MARK: Delete exists image
    /**
     * Check if image exists in the public directory, then delete it.
     * 
     * @param string $folderSaveName The folder name where the image is saved.
     * @param string $dataImageName  The image name.
     */
    public function deleteExistsImage(string $folderSaveName, string $dataImageName) 
    {
        if(! empty($dataImageName)) {
            $path = 'img/uploads/' . $folderSaveName . '/' . $dataImageName;
            
            if (File::exists($path)) {
                File::delete($path);
            } 
        }
    }

    // MARK: Delete exists image directory
    /**
     * Delete a folder directory if it exists.
     * 
     * @param string $path The path of the directory to be deleted.
    */
    public function deleteDirectory(string $path): bool
    {
        if (! File::exists($path)) {
            return false;
        }

        return File::deleteDirectory($path);
    }
}