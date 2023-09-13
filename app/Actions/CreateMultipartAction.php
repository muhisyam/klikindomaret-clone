<?php

namespace App\Actions;

use Illuminate\Support\Str;

class CreateMultipartAction
{
    public function execute(Array $formRequest): Array
    {
        $param = [];

        foreach ($formRequest as $key => $value) {
            if (!(Str::contains($key, 'token') || Str::contains($key, 'image'))) {
                $param[] = [
                    'name' => $key,
                    'contents' => $value,
                ];

                continue;
            }

            if (Str::contains($key, 'image')) {
                $param[] = [
                    'name'  => $key,
                    'contents' => fopen($value->path(), 'r'),
                    'filename' => $value->getClientOriginalName(), 
                ];

                continue;
            }
        }

        return $param;
    }
}