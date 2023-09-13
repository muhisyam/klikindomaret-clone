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
        $path = 'img/uploads/' . $section . '/' . $data->image;
        
        if (File::exists($path)) {
            File::delete($path);
        } 
    }

    /**
     * Store image to db and public directory
     */
    public function storeImage(Request $request, string $section): string
    {
        $file = $request->file('image');
        $filename = time() . '.' . strtolower($file->getClientOriginalExtension());
        $file->move('img/uploads/' . $section . '/', $filename);
        
        return $filename; 
    }
}