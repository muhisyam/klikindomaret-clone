<?php

namespace App\Actions;

class ErrorResponseAction
{
    public function execute(string $pageRole, array $dataErrors) 
    {
        if ($pageRole === 'admin') {
            $withVariable = [
                'dataErrors' => $dataErrors,
                'pageParent' => 'admin.index', 
                'linkRedirect' => '/admin/dashboard', 
            ];
        }

        switch ($dataErrors['code']) {
            case 404:
                return view('livewire.pages.error-404', $withVariable);
        }
    }
}