<?php

namespace App\Services\Backend;

use App\Actions\ClientRequestAction;
use Illuminate\Http\Request;

class ApiCallService 
{
    public function __construct(
        protected ClientRequestAction $clientRequestAction,
    ) {}
    
    /**
     * Get data category from database
     */
    public function getData(string $url, Request $request): array
    {
        $request->input('page') && $url .= '?page=' . $request->input('page');
        
        return $this->clientRequestAction->execute('GET', $url);
    }

    /**
     * Store data to database
     */
    public function postData(string $url, array $param): array
    {
        return $this->clientRequestAction->execute('POST', $url, $param);
    }

    /**
     * Get spesific data from database
     */
    public function showData(string $url): array
    {
        return $this->clientRequestAction->execute('GET', $url);
    }

    /**
     * Delete data from database
     */
    public function deleteData(string $url): array
    {
        return $this->clientRequestAction->execute('DELETE', $url);
    }
}