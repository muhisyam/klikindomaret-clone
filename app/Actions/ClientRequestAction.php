<?php

namespace App\Actions;

use App\DataTransferObjects\ClientRequestDto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ClientRequestAction
{
    /**
     * Create and send an HTTP request.
     *
     * @param string              $method  HTTP method.
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $param   Parameter from Request. See \GuzzleHttp\RequestOptions.
     */
    public function request(ClientRequestDto $dto): array
    {
        $options = [];
        $client = new Client();

        if (!empty($dto->headers)) {
            $options = [
                'headers' => $dto->headers,
            ];
        }

        if (!empty($dto->formData)) {
            $options = [
                'headers' => ['Accept-Type', 'application/json'],
                'multipart' => $dto->formData,
            ];
        }

        try {
            $response = $client->request($dto->method, $dto->endpoint, $options);

            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            return $data;

        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            
            $error = json_decode($response, true);
            $error['errors']['code'] = $exception->getCode();
            
            return $error;
        }
    }
}