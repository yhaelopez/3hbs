<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FlightCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => FlightResource::collection($this->collection),
            'links' => [
                'self' => route('api.v1.flights.index')
            ],
            'meta' => [
                'airports_count' => $this->collection->count()
            ]
        ];
    }
}
