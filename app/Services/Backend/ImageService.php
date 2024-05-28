<?php

namespace App\Services\Backend;

use Illuminate\Support\Facades\File;

class ImageService 
{
    /**
     * Check if image exists in the public directory, then delete it
     */
    public function deleteExistsImage(string|null $dataImageName, string $folderSaveName) 
    {
        if(!is_null($dataImageName)) {
            $path = 'img/uploads/' . $folderSaveName . '/' . $dataImageName;
            
            if (File::exists($path)) {
                File::delete($path);
            } 
        }
    }

    /**
     * Store image and image name to db and public directory
     * 
     * @param object|null $dataImage
     * @param string $folderSaveName
     * @return null|array [$randomImageName, $originalImageName]
     */
    public function storeImage(object|null $dataImage, string $folderSaveName): null|array
    {
        if (is_null($dataImage)) {
            return $dataImage;
        }

        $randomImageName   = null;
        $originalImageName = null;
        
        $randomImageName = time() . mt_rand(11, 99) . '.' . strtolower($dataImage->getClientOriginalExtension());
        $dataImage->move('img/uploads/' . $folderSaveName . '/', $randomImageName);
        
        $originalImageName = explode('.', $dataImage->getClientOriginalName());
        $originalImageName = $originalImageName[0]  . '.' . strtolower($dataImage->getClientOriginalExtension());

        return [$randomImageName, $originalImageName]; 
    }

    /**
     * Store multiple image to db and public directory
     */
    public function storeMultipleImage(object $dataImage, string $index, string $folderSaveName)
    {
        $randomImageName = null;
        
        $randomImageName = time() . $index . '.' . strtolower($dataImage->getClientOriginalExtension());
        $dataImage->move('img/uploads/' . $folderSaveName . '/', $randomImageName);

        return $randomImageName; 
    }

    /**
     * Store image name to db
     */
    public function storeImageName(object|null $dataImage)
    {
        if (is_null($dataImage)) {
            return $dataImage;
        }

        $fileName     = null;
        $originalName = explode('.', $dataImage->getClientOriginalName());
        $fileName     = $originalName[0]  . '.' . strtolower($dataImage->getClientOriginalExtension());
        
        return $fileName; 
    }
}