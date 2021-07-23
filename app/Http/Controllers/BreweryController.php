<?php

namespace App\Http\Controllers;

use App\Http\Resources\BreweryResource;
use App\Models\Brewery;
use App\Services\HttpClient;

class BreweryController extends Controller
{
    public function index(HttpClient $client)
    {
        $options = [
            'query' => [
                'page' => request('page', 1),
                'per_page' => request('per_page', 20),
            ],
        ];

        $data = $client->get('breweries', $options);
        $breweries = Brewery::hydrate($data);

        return response()->json(BreweryResource::collection($breweries));
    }
}
