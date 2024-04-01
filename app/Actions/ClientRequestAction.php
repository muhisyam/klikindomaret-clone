<?php

namespace App\Actions;

use App\DataTransferObjects\ClientRequestDto;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Arr;

class ClientRequestAction
{
    /**
     * Create and send an HTTP request.
     *
     * @param ClientRequestDto $dto       Client param object transfer include below.
     * @param string           $method    HTTP method.
     * @param string           $endpoint  URI of endpoint.
     * @param array            $header    Associative array of headers to add to the request.
     * @param array            $formData  Parameter from Request. See \GuzzleHttp\RequestOptions.
     */
    public function request(ClientRequestDto $dto): array
    {
        $client     = new Client();
        $acceptJson = ['Accept' => 'application/json'];
        $options    = [
            'headers'   => array_merge($acceptJson, $dto->headers),
            'multipart' => $dto->formData,
        ];

        try {
            $response = $client->request($dto->method, $dto->endpoint, $options);

            return $this->withMetadata($response);

        } catch (ClientException $exception) {
            $response = $exception->getResponse();

            return $this->withMetadata($response);
        }
    }

    /**
     * Add metadata resource to the response for convinience checking responses.
     * 
     * @param Response $response Response data from request.
     * 
     * @return array [data => [...], meta => [...]]
    */
    private function withMetadata(Response $response): array
    {
        $content    = json_decode($response->getBody()->getContents(), true);
        $hasMessage = isset($content['message']);

        if (! isset($content['meta'])) {
            // If has $message, remove message and status code key from current response data
            $meta['message']     = $hasMessage ? $content['message'] : $response->getReasonPhrase();
            $meta['status_code'] = $response->getStatusCode();
            $content             = $hasMessage ? Arr::except($content, ['message', 'status_code']) : $content;

            return array_merge($content, ['meta' => $meta]);
        }

        return $content;
    }
}