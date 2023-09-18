<?php

namespace App\Actions;

class IsCategoryParentAction
{
    public function handle($dataValidated)
    {
        if ($dataValidated === '0') {
            return null;
        }

        return $dataValidated;
    }
}