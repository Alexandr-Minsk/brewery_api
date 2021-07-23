<?php

namespace App\Services;

use App\Exceptions\HttpClientException;
use GuzzleHttp\Client;
use Exception;

class HttpClient
{
    private $client;

    public function __construct(array $options = [])
    {
        $this->client = new Client($options);
    }

    public function get($url, array $options = [])
    {
        try {
            $response = $this->client->get($url, $options);
            $data = json_decode($response->getBody()->getContents());

            return $data;
        } catch (Exception $e) {
            throw new HttpClientException($e->getMessage(), $e->getCode(), $e);
        }

    }
}