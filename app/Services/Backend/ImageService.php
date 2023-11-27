<?php

namespace App\Services\Backend;

use Illuminate\Support\Facades\File;

class ImageService 
{
    /**
     * Check if image exists in the public directory, then delete it
     */
    public function deleteExistsImage(string $dataImageName, string $folderSaveName) 
    {
        if(!is_null($dataImageName)) {
            $path = 'img/uploads/' . $folderSaveName . '/' . $dataImageName;
            
            if (File::exists($path)) {
                File::delete($path);
            } 
        }
    }

    /**
     * Store image to db and public directory
     */
    public function storeImage(Object $dataImage, string $folderSaveName)
    {
        $randomImageName = null;
        
        $randomImageName = time() . '.' . strtolower($dataImage->getClientOriginalExtension());
        $dataImage->move('img/uploads/' . $folderSaveName . '/', $randomImageName);

        return $randomImageName; 
    }

    /**
     * Store multiple image to db and public directory
     */
    public function storeMultipleImage(Object $dataImage, string $index, string $folderSaveName)
    {
        $randomImageName = null;
        
        $randomImageName = time() . $index . '.' . strtolower($dataImage->getClientOriginalExtension());
        $dataImage->move('img/uploads/' . $folderSaveName . '/', $randomImageName);

        return $randomImageName; 
    }

    /**
     * Store image name to db
     */
    public function storeImageName(Object $dataImage)
    {
        $fileName = null;

        $originalName = explode('.', $dataImage->getClientOriginalName());
        $fileName = $originalName[0]  . '.' . strtolower($dataImage->getClientOriginalExtension());
        
        return $fileName; 
    }
}