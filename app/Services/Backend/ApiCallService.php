<?php

namespace App\Services\Backend;

use Exception;
use Illuminate\Http\Request;
use App\Actions\ClientRequestAction;
use App\DataTransferObjects\FindDataDto;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiCallService 
{
    public function __construct(
        protected ClientRequestAction $clientRequestAction,
    ) {}
    
    /**
     * Get data category from database
     */
    public function getData(string $url, Request $request = null): array
    {
        if (!is_null($request)) {
            $request->input('page') && $url .= '?page=' . $request->input('page');
        }
        
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

    /**
     * Find data by spesific column in db and return data if exists or throw exception if not found
     */
    public function findData(FindDataDto $dto)
    {
        try {
            return $dto->model
                ::where($dto->whereSchema)
                ->with($dto->withSchema)
                ->withCount($dto->withCountSchema)
                ->firstOrFail();

        } catch (Exception $th) {
            throw new HttpResponseException(response()->json([
                "errors" => [
                    "message" => [
                        $th->getMessage()
                    ]
                ]
            ])->setStatusCode(404));
        }
    }
}