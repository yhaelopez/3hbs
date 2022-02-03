<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AirportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => 'airports',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'code' => $this->code,
                'city' => $this->city,
            ],
            'links' => [
                'self' => route('api.v1.airports.show', $this)
            ]
        ];
    }
}
