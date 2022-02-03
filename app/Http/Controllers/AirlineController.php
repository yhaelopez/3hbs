<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAirlineRequest;
use App\Http\Requests\UpdateAirlineRequest;
use App\Http\Resources\AirlineCollection;
use App\Http\Resources\AirlineResource;
use App\Models\Airline;

class AirlineController extends Controller
{
    public function index()
    {
        return AirlineCollection::make(Airline::get());
    }

    public function store(StoreAirlineRequest $request)
    {
        $airline = Airline::create($request->validated());
        return AirlineResource::make($airline);
    }

    public function show(Airline $airline)
    {
        return AirlineResource::make($airline);
    }

    public function update(UpdateAirlineRequest $request, Airline $airline)
    {
        $airline->update($request->validated());
        return AirlineResource::make($airline);
    }

    public function destroy(Airline $airline)
    {
        $airline->delete();
        return AirlineResource::make($airline);
    }
}
