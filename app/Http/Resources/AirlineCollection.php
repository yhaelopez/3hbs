<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AirlineCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => AirlineResource::collection($this->collection),
            'links' => [
                'self' => route('api.v1.airlines.index')
            ],
            'meta' => [
                'airports_count' => $this->collection->count()
            ]
        ];
    }
}
