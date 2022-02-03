<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Http\Resources\FlightCollection;
use App\Http\Resources\FlightResource;
use App\Models\Flight;

class FlightController extends Controller
{
    public function index()
    {
        return FlightCollection::make(Flight::get());
    }

    public function store(StoreFlightRequest $request)
    {
        $flight = Flight::create($request->validated());
        return FlightResource::make($flight);
    }

    public function show(Flight $flight)
    {
        return FlightResource::make($flight);
    }

    public function update(UpdateFlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());
        return FlightResource::make($flight);
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();
        return FlightResource::make($flight);
    }
}
