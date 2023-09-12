<?php

namespace App\Actions;

use GuzzleHttp\Client;

class GetSpesificFieldAction
{
    public function handle(string $apiUrl, string $id, string $key): string
    {
        $client = new Client();
        $url = $apiUrl . '/' . $id;

        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['data'][$key];
    }

}