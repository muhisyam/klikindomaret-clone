<?php

namespace App\Actions;

class MergeArrayErrorAction
{
    /**
     * Create a new error data key that contain the list of images errors
     * 
     * @param array $dataErrors     Data errors
     * @param string $searchNeedle  Using for searching multiple array key in $dataErrors
     */
    public function execute(Array $dataErrors, string $searchNeedle): Array
    {
        foreach ($dataErrors as $key => $value) {
            $newDataMessage = [];

            if (strpos($key, $searchNeedle) !== false) {
                foreach ($value as $message) {
                    $newDataMessage[] = ucfirst(substr($message, strpos($message, 'field')));
                }
                
                $newDataError[ucfirst($key)] = $newDataMessage;
            }
        }

        return $newDataError;
    }
}