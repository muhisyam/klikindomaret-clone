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
        if(!is_null($data->image_name)) {
            $path = 'img/uploads/' . $section . '/' . $data->image_name;
            
            if (File::exists($path)) {
                File::delete($path);
            } 
        }
    }

    /**
     * Store image to db and public directory
     */
    public function storeImage(Request $request, string $section)
    {
        $randFileName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $randFileName = time() . '.' . strtolower($file->getClientOriginalExtension());
            $file->move('img/uploads/' . $section . '/', $randFileName);
        }

        return $randFileName; 
    }

    /**
     * Store image name to db
     */
    public function storeImageName(Request $request)
    {
        $fileName = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $originalName = explode('.', $file->getClientOriginalName());
            $fileName = $originalName[0]  . '.' . strtolower($file->getClientOriginalExtension());
        }
        
        return $fileName; 
    }
}