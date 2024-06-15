<?php

namespace App\Actions;

class CreateMultipartAction
{
    private array $param = [];

    /**
     * Creates a new multipart assoc array based on form request data and image input.
     *
     * @param array  $formRequest The form request data
     * @param string $formImage   Key name of image input
    */
    public function create(array $formRequest, string $formImage): array
    {
        foreach ($formRequest as $key => $value) {
            $key = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));

            $this->checkIsImageExists($formImage, $key)
                ? $this->handleDataRequest($key, $value, 'image')
                : $this->handleDataRequest($key, $value, 'non-image');
        }
                
        return $this->param;
    }

    private function checkIsImageExists($formImage, $key)
    {
        return ! empty($formImage) && $key == $formImage;
    }
    
    /**
     * Set the data contents of a multipart array.
     *
     * @param string $key   The key name for the data
     * @param mixed  $value The value to be prepared
     * @param string $form  The type of form ('image' or 'non-image')
    */
    private function handleDataRequest(string $key, mixed $value, string $form): array 
    {
        if (is_array($value)) {
            foreach ($value as $index => $data) {
                $keyName = $key . '[' . $index . ']';
                
                $this->param[] = $this->prepareData($keyName, $data, $form);
            }
        } else {
            $this->param[] = $this->prepareData($key, $value, $form);
        }

        return $this->param;
    }

    /**
     * Create key-values pairs of multipart body.
     *
     * @param string $key   The key name for the data
     * @param mixed  $value The value to be prepared
     * @param string $form  The type of form ('image' or 'non-image')
    */
    private function prepareData(string $key, $value, $form): array 
    {
        return match ($form) {
            'image' => [
                'name'     => $key,
                'contents' => fopen($value->path(), 'r'),
                'filename' => $value->getClientOriginalName(),
            ],
            'non-image' => [
                'name'     => $key,
                'contents' => $value,
            ],
        };
    }
}