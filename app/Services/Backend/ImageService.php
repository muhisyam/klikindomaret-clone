<?php

namespace App\Services\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageService 
{
    /**
     * Check if image exists in the public directory
     */
    public function findImage(object $data, string $section) 
    {
        if(!is_null($data->category_image_name)) {
            $path = 'img/uploads/' . $section . '/' . $data->category_image_name;
            
            if (File::exists($path)) {
                File::delete($path);
            } 
        }
    }

    /**
     * Store image to db and public directory
     * 
     * @param Request    $request          
     * @param string     $dataName          name data section (category, product, etc)
     * @param string     $folderDataName    folder name (categories, products, etc)
     */
    public function storeImage(Request $request, string $dataName, string $folderDataName)
    {
        $randFileName = null;

        if ($request->hasFile($dataName . '_image')) {
            $file = $request->file($dataName . '_image');
            $randFileName = time() . '.' . strtolower($file->getClientOriginalExtension());
            // $file->move('img/uploads/' . $folderDataName . '/', $randFileName);
        }

        return $randFileName; 
    }

    /**
     * Store image name to db
     */
    public function storeImageName(Request $request)
    {
        $fileName = null;

        if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $originalName = explode('.', $file->getClientOriginalName());
            $fileName = $originalName[0]  . '.' . strtolower($file->getClientOriginalExtension());
        }
        
        return $fileName; 
    }
}