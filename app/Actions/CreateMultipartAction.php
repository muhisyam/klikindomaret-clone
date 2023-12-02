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
                $this->param[] = [
                    'name' => $key . '[' . $index . ']',
                    'contents' => $dataForm,
                ];
            }
        } else {
            $this->param[] = [
                'name' => $key,
                'contents' => $value,
            ];
        }

        return $this->param;
    }

    public function execute(Array $formRequest, String $imageFormName): Array
    {
        foreach ($formRequest as $key => $value) {
            if (Str::contains($key, $imageFormName)) {
                $this->handleDataImage($key, $value);
            } else {
                $this->handleDataNonImage($key, $value);
            }
        }

        return $this->param;
    }
}