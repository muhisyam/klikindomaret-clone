<?php

namespace App\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ClientRequestAction
{
    protected $client;

    public function __construct() 
    {
        $this->client = new Client();
    }
    
    /**
     * Create and send an HTTP request.
     *
     * @param string              $method  HTTP method.
     * @param string|UriInterface $uri     URI object or string.
     * @param array               $param   Parameter from Request. See \GuzzleHttp\RequestOptions.
     */
    public function execute(string $method, string $uri, array $param = []): array
    {
        $options = [];

        if (!empty($param)) {
            $options = [
                'header' => ['Content-Type', 'application/json'],
                'multipart' => $param,
            ];
        }

        try {
            $response = $this->client->request($method, $uri, $options);

            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            return $data;

        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            $error = json_decode($response, true);
            
            return $error;
        }
    }
}