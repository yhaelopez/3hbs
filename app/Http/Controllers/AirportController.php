<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAirportRequest;
use App\Http\Requests\UpdateAirportRequest;
use App\Http\Resources\AirportCollection;
use App\Http\Resources\AirportResource;
use App\Models\Airport;

class AirportController extends Controller
{
    public function index()
    {
        return AirportCollection::make(Airport::get());
    }

    public function store(StoreAirportRequest $request)
    {
        $airport = Airport::create($request->validated());
        return AirportResource::make($airport);
    }

    public function show(Airport $airport)
    {
        return AirportResource::make($airport);
    }

    public function update(UpdateAirportRequest $request, Airport $airport)
    {
        $airport->update($request->validated());
        return AirportResource::make($airport);
    }

    public function destroy(Airport $airport)
    {
        $airport->delete();
        return AirportResource::make($airport);
    }
}
