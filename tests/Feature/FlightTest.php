<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlightTest extends TestCase
{
    use WithFaker;

    public $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGRhYzg4NDFhNmQ0YjVlZGY0MTdiZGM3ZjBkNjBiYzQ5Y2YwMzdlOTEzMWMxYmY2YTVmOTkxMzU4OGM2MzYyMmVlODIwNzNiMzg4M2EwZjAiLCJpYXQiOjE2NDM4NzI2NjkuNzEwNDksIm5iZiI6MTY0Mzg3MjY2OS43MTA0OTUsImV4cCI6MTY3NTQwODY2OS42OTczNDQsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.h789OkkBXHhoVkBG7RUT5Z4X8KGyE7L2n21EkWAHkHnArO-tfl9e2N_PcWzy-ztwSvSqW3znRniS91VtuCiSMWx7a_DIJ_K_pP1Pqsa7lrLFGfIIK1dF_GfaWIT5KUQsXJpM5arxrnyjN0YvKVQg7RIRFVQLcatv7_CZcxyMsGzknx9OnVbtPJ3sLbKW8bBZlQp1aQNH883Zry7bSk9JPTf9GH1KcEL0adrijfFBZ4_lZvhzLo-enawWOx8z4-gAKRc-AVvxUqVMsqwdL5mvDfUigiPX1p9X_Pd-i92toL52PuWB4oyRH6sOV_VjzjzT5KkH1cBuqBWtbg8Wll1P6uwQJAxAh8NEXkDUjSbJYC7PA2cbFYvdlvkLrInX767j7PYRXX6Tg6BMlFUn0J_UT-rEdnm1w2-_PBWh3WyqjAYspJh0H2-TL4ow7qJcCWIdv4uV2ENkVPD2bQ_XXHZ7jHnUEMijsWnmBnSS2K8yZAS0GrW_5OxCQFwFifrx3OFGfy1Rjeyq_txO-GET9jjHvhw8WHV3LMCBNngZZ1o4s4bIXDOJbFvm7br0-_f09GkHYCFb_3x2j8CKNqdRY_MO0SGx287XfxWWFGRQgoWV__S6D35gMavuY8BngyswNAsy55gzpSMG4-ZHwUWFGI52YBYmkJevp_FxjajgXttKCUw";

    public function test_can_fetch_single_flight()
    {
        $this->withoutExceptionHandling();

        $flight = Flight::factory()->create();

        $response = $this->getJson(route('api.v1.flights.show', ['flight' => $flight]), [
            'Authorization' => $this->token
        ]);

        $response->assertJson([
            'data' => [
                'type' => 'flights',
                'id' => $flight->id,
                'attributes' => [
                    'airline_id' => $flight->airline_id,
                    'code' => $flight->code,
                    'type' => $flight->type,
                    'departure_id' => $flight->departure_id,
                    'destination_id' => $flight->destination_id,
                    'departure_time' => $flight->departure_time->format('Y-m-d H:i:s'),
                    'arrival_time' => $flight->arrival_time->format('Y-m-d H:i:s'),
                ],
                'links' => [
                    'self' => route('api.v1.flights.show', ['flight' => $flight])
                ]
            ]
        ]);
    }

    public function test_can_fetch_all_flights()
    {
        $this->withoutExceptionHandling();

        $response = $this->getJson(route('api.v1.flights.index'), [
            'Authorization' => $this->token
        ]);

        $flights = json_decode($response->getContent());

        $response->assertOk();
    }

    public function test_can_create_flight()
    {
        $this->withExceptionHandling();

        $response = $this->postJson(route('api.v1.flights.store'), [
            'airline_id' => Airline::factory()->create()->id,
            'code' => $this->faker->word(),
            'type' => 'PASSENGER',
            'departure_id' => Airport::factory()->create()->id,
            'destination_id' => Airport::factory()->create()->id,
            'departure_time' => now(),
            'arrival_time' => now()->addDay(),
        ], [
            'Authorization' => $this->token
        ]);

        $flight = json_decode($response->getContent());

        $response->assertJson([
            'data' => [
                'type' => 'flights',
                'id' => $flight->data->id,
                'attributes' => [
                    'airline_id' => $flight->data->attributes->airline_id,
                    'code' => $flight->data->attributes->code,
                    'type' => $flight->data->attributes->type,
                    'departure_id' => $flight->data->attributes->departure_id,
                    'destination_id' => $flight->data->attributes->destination_id,
                    'departure_time' => $flight->data->attributes->departure_time,
                    'arrival_time' => $flight->data->attributes->arrival_time,
                ],
                'links' => [
                    'self' => route('api.v1.flights.show', ['flight' => $flight->data->id])
                ]
            ]
        ]);
    }

    public function test_can_update_flights()
    {
        $this->withoutExceptionHandling();

        $flight = Flight::first();

        $response = $this->postJson(route('api.v1.flights.update', ['flight' => $flight]), [
            '_method' => 'PATCH',
            'airline_id' => Airline::factory()->create()->id,
            'code' => $this->faker->word(),
            'type' => 'PASSENGER',
            'departure_id' => Airport::factory()->create()->id,
            'destination_id' => Airport::factory()->create()->id,
            'departure_time' => now(),
            'arrival_time' => now()->addDay(),
        ], [
            'Authorization' => $this->token
        ]);

        $flight = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'flights',
                'id' => $flight->data->id,
                'attributes' => [
                    'airline_id' => $flight->data->attributes->airline_id,
                    'code' => $flight->data->attributes->code,
                    'type' => $flight->data->attributes->type,
                    'departure_id' => $flight->data->attributes->departure_id,
                    'destination_id' => $flight->data->attributes->destination_id,
                    'departure_time' => $flight->data->attributes->departure_time,
                    'arrival_time' => $flight->data->attributes->arrival_time,
                ],
                'links' => [
                    'self' => route('api.v1.flights.show', ['flight' => $flight->data->id])
                ]
            ]
        ]);
    }

    public function test_can_delete_flights()
    {
        $this->withoutExceptionHandling();

        $flight = Flight::first();

        $response = $this->postJson(route('api.v1.flights.destroy', ['flight' => $flight]), [
            '_method' => 'DELETE',
        ], [
            'Authorization' => $this->token
        ]);

        $flight = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'flights',
                'id' => $flight->data->id,
                'attributes' => [
                    'airline_id' => $flight->data->attributes->airline_id,
                    'code' => $flight->data->attributes->code,
                    'type' => $flight->data->attributes->type,
                    'departure_id' => $flight->data->attributes->departure_id,
                    'destination_id' => $flight->data->attributes->destination_id,
                    'departure_time' => $flight->data->attributes->departure_time,
                    'arrival_time' => $flight->data->attributes->arrival_time,
                ],
                'links' => [
                    'self' => route('api.v1.flights.show', ['flight' => $flight->data->id])
                ]
            ]
        ]);
    }
}
