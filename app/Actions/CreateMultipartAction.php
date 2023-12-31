<?php

namespace App\Actions;

use Illuminate\Support\Str;

class CreateMultipartAction
{
    private array $param = [];

    private function handleDataImage($key, $value): Array 
    {
        if (is_array($value)) {
            foreach ($value as $index => $dataImage) {
                $this->param[] = [
                    'name'  => $key . '[' . $index . ']',
                    'contents' => fopen($dataImage->path(), 'r'),
                    'filename' => $dataImage->getClientOriginalName(), 
                ];
            }
        } else {
            $this->param[] =[
                'name'  => $key,
                'contents' => fopen($value->path(), 'r'),
                'filename' => $value->getClientOriginalName(), 
            ];
        }

        return $this->param;
    }

    private function handleDataNonImage($key, $value): Array 
    {
        if (is_array($value)) {
            foreach ($value as $index => $dataForm) {
                if (!is_null($dataForm)) {
                    $this->param[] = [
                        'name' => $key . '[' . $index . ']',
                        'contents' => $dataForm,
                    ];
                }
            }
        } else {
            $this->param[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }

        return $this->param;
    }

    private function handleDidntHasImage($key, $value): Array 
    {
        $keyList = [
            'product_images' => 'product_images[]'
        ];

        if (array_key_exists($key, $keyList)) {
            $key = $keyList[$key];
            
            $this->param[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }

        return $this->param;
    }

    public function execute(Array $formRequest, String $imageFormName = null): Array
    {
        $didntHasImage = true;

        foreach ($formRequest as $key => $value) {
            if (Str::contains($key, $imageFormName) && !is_null($didntHasImage)) {
                $didntHasImage = false;
                $this->handleDataImage($key, $value);
            } else {
                $this->handleDataNonImage($key, $value);
            }
        }
                
        if ($didntHasImage) {
            $this->handleDidntHasImage($imageFormName, NULL);
        }

        return $this->param;
    }
}