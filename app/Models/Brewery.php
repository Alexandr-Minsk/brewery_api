<?php

namespace App\Models;

use App\Services\HttpClient;
use Illuminate\Database\Eloquent\Casts\ArrayObject;
use Jenssegers\Model\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Brewery extends Model
{
    /**
     * @param $value
     * @param null $field
     * @throws ModelNotFoundException
     * @return Brewery
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $client = App::make(HttpClient::class);
        $endpoint = sprintf('/breweries/%d', $value);
        $data = $client->get($endpoint);
        $arrayObject = new ArrayObject($data);

        return new Brewery($arrayObject->toArray());
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'obdb_id' => $this->obdb_id,
            'name' => $this->name,
            'brewery_type' => $this->brewery_type,
            'address' => [
                'street' => $this->street,
                'address_2' => $this->address_2,
                'address_3' => $this->address_3,
                'city' => $this->city,
                'state' => $this->state,
                'county_province' => $this->county_province,
                'postal_code' => $this->postal_code,
                'country' => $this->country,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
            ],
            'phone' => $this->phone,
            'website_url' => $this->website_url,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'url' => sprintf('%sbreweries/%d', config('app.api_url'), $this->id),
        ];
    }
}
