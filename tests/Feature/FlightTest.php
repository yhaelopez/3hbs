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

    public $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYmU5MjViY2IyNzZlNDg5OWMwNTNhNDNiMTAxNDg3ZTRlZjBhYmQzMDJkMzgzYjAyZGZmYzAzM2Y4MTFjMzk2NTA5MWZkZTcwN2ZmNmYxNGEiLCJpYXQiOjE2NDM4NjIzNzAuODU4ODEsIm5iZiI6MTY0Mzg2MjM3MC44NTg4MTIsImV4cCI6MTY3NTM5ODM3MC44NDY5MjksInN1YiI6IjEiLCJzY29wZXMiOltdfQ.X9UBgDXL6doUbK8rOwe1tRe-al0oWPz9-MGFfnul4NXWJMdF3BDUmVl4f350TDs2ZWo-ifNJBDX7hzbqmovgl8yPvUDLNAqBIB-sIr8NbBJpopI2rLMg-8L5L96KrjvvMkkC2xBIl01QDDJ3tLSNuL0zG4hd5LwctpgwQrEzdT7R90pV74P9ISC9BKH1f-Sc6jAloHUOCSHN0VXHTXlKWP3UupNzu7qpx0g-vd9EHqoKkVfmt5qQf8Lj0doU5dGsd8PStV-Bo4CrNKsJlzpyZuTrUvTzc2KDhhl2DTC42Na2SL9AF1o_QwDUdNevcL2LaG1yIu8WQHnrsBtUge4lz_iF5vh-HJEtPZwtIjwYaUvivfA6B_FGfPp7coMWw2MNNGBnY1KuFfG0vV_wbHTtB3jK3f0FvSl1HQNgBdp8slxirl7dqS-1LtJ1QSCTzCo0s94O5n2WuTBcSnrwg_Sv1WtBFy1_R9xriubrXfK8oqfxq5g2EbR_ZgT-Ye_pMVi6FzTX1tA4lBK94pOrAS8iC3Graipa-yCFASEJv7IyB0R9GmVUQZ_RDyvK5tq-4r52aUdLktTCkW0WEMFoK1NBbvOcCKHzuThxKrf0tcDPrHuI8kxkt3zPx0wzgxrbjku-25ueWfzmpq1eZJA2mNGPwibGx1GhQHu3-PE-QpF9q90";

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
