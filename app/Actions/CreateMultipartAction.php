<?php

namespace App\Actions;

use Illuminate\Support\Str;

class CreateMultipartAction
{
    private array $param = [];

    private function handleDataImage($key, $value): array 
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

    private function handleDataNonImage($key, $value): array 
    {
        if (is_array($value)) {
            foreach ($value as $index => $dataForm) {
                if (!is_null($dataForm)) {
                    $this->param[] = [
                        'name' => $key . '[' . $index . ']',
                        'contents' => $dataForm === 'all_store' ? null : $dataForm,
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

    private function handleDidntHasImage($key): array 
    {
        $keyList = [
            'product_images' => 'product_images[]'
        ];

        if (array_key_exists($key, $keyList)) {
            $key = $keyList[$key];
            
            $this->param[] = [
                'name' => $key,
                'contents' => null,
            ];
        }

        return $this->param;
    }

    private function handleDeleteExitsImage(array|string $dataForm): array 
    {
        if (is_array($dataForm)) {
            foreach ($dataForm as $index => $dataForm) {
                if (!is_null($dataForm)) {
                    $this->param[] = [
                        'name' => 'delete_images[' . $index . ']',
                        'contents' => $dataForm,
                    ];
                }
            }
        } else {
            $this->param[] = [
                'name' => 'delete_image',
                'contents' => $dataForm,
            ];
        }

        return $this->param;
    }

    public function execute(array $formRequest, string $imageFormName = null): array
    {
        $isUpdateProduct = isset($formRequest['_method']);
        $didntHasImage = true;

        foreach ($formRequest as $key => $value) {
            if (Str::contains($key, $imageFormName)) {
                $didntHasImage = false;
                $this->handleDataImage($key, $value);
            } else {
                $this->handleDataNonImage($key, $value);
            }
        }
                
        if ($didntHasImage && !$isUpdateProduct) {
            if (isset($formRequest['delete_image'])) {
                $this->handleDeleteExitsImage($formRequest['delete_image']);
            } else {
                $this->handleDidntHasImage($imageFormName, NULL);
            }  
        }

        return $this->param;
    }
}