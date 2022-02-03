<?php

namespace Tests\Feature;

use App\Models\Airport;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AirportTest extends TestCase
{

    use WithFaker;

    public $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYmU5MjViY2IyNzZlNDg5OWMwNTNhNDNiMTAxNDg3ZTRlZjBhYmQzMDJkMzgzYjAyZGZmYzAzM2Y4MTFjMzk2NTA5MWZkZTcwN2ZmNmYxNGEiLCJpYXQiOjE2NDM4NjIzNzAuODU4ODEsIm5iZiI6MTY0Mzg2MjM3MC44NTg4MTIsImV4cCI6MTY3NTM5ODM3MC44NDY5MjksInN1YiI6IjEiLCJzY29wZXMiOltdfQ.X9UBgDXL6doUbK8rOwe1tRe-al0oWPz9-MGFfnul4NXWJMdF3BDUmVl4f350TDs2ZWo-ifNJBDX7hzbqmovgl8yPvUDLNAqBIB-sIr8NbBJpopI2rLMg-8L5L96KrjvvMkkC2xBIl01QDDJ3tLSNuL0zG4hd5LwctpgwQrEzdT7R90pV74P9ISC9BKH1f-Sc6jAloHUOCSHN0VXHTXlKWP3UupNzu7qpx0g-vd9EHqoKkVfmt5qQf8Lj0doU5dGsd8PStV-Bo4CrNKsJlzpyZuTrUvTzc2KDhhl2DTC42Na2SL9AF1o_QwDUdNevcL2LaG1yIu8WQHnrsBtUge4lz_iF5vh-HJEtPZwtIjwYaUvivfA6B_FGfPp7coMWw2MNNGBnY1KuFfG0vV_wbHTtB3jK3f0FvSl1HQNgBdp8slxirl7dqS-1LtJ1QSCTzCo0s94O5n2WuTBcSnrwg_Sv1WtBFy1_R9xriubrXfK8oqfxq5g2EbR_ZgT-Ye_pMVi6FzTX1tA4lBK94pOrAS8iC3Graipa-yCFASEJv7IyB0R9GmVUQZ_RDyvK5tq-4r52aUdLktTCkW0WEMFoK1NBbvOcCKHzuThxKrf0tcDPrHuI8kxkt3zPx0wzgxrbjku-25ueWfzmpq1eZJA2mNGPwibGx1GhQHu3-PE-QpF9q90";

    public function test_can_fetch_single_airport()
    {
        $this->withoutExceptionHandling();

        $airport = Airport::factory()->create();

        $response = $this->getJson(route('api.v1.airports.show', $airport), [
            'Authorization' => $this->token
        ]);

        $response->assertJson([
            'data' => [
                'type' => 'airports',
                'id' => $airport->id,
                'attributes' => [
                    'name' => $airport->name,
                    'code' => $airport->code,
                    'city' => $airport->city,
                ],
                'links' => [
                    'self' => route('api.v1.airports.show', $airport)
                ]
            ]
        ]);
    }

    public function test_can_fetch_all_airports()
    {
        $this->withoutExceptionHandling();

        $response = $this->getJson(route('api.v1.airports.index'), [
            'Authorization' => $this->token
        ]);

        $airports = json_decode($response->getContent());

        $response->assertOk();
    }

    public function test_can_create_airport()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.airports.store'), [
            'name' => $this->faker->name(),
            'code' => $this->faker->word(),
            'city' => $this->faker->city(),
        ], [
            'Authorization' => $this->token
        ]);

        $airport = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'airports',
                'id' => $airport->data->id,
                'attributes' => [
                    'name' => $airport->data->attributes->name,
                    'code' => $airport->data->attributes->code,
                    'city' => $airport->data->attributes->city,
                ],
                'links' => [
                    'self' => route('api.v1.airports.show', $airport->data->id)
                ]
            ]
        ]);
    }

    public function test_can_update_airport()
    {
        $this->withoutExceptionHandling();

        $airport = Airport::first();

        $response = $this->postJson(route('api.v1.airports.update', ['airport' => $airport]), [
            '_method' => 'PATCH',
            'name' => $this->faker->name(),
            'code' => $this->faker->word(),
            'city' => $this->faker->city(),
        ], [
            'Authorization' => $this->token
        ]);

        $airport = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'airports',
                'id' => $airport->data->id,
                'attributes' => [
                    'name' => $airport->data->attributes->name,
                    'code' => $airport->data->attributes->code,
                    'city' => $airport->data->attributes->city,
                ],
                'links' => [
                    'self' => route('api.v1.airports.show', $airport->data->id)
                ]
            ]
        ]);
    }

    public function test_can_delete_airport()
    {
        $this->withoutExceptionHandling();

        $airport = Airport::first();

        $response = $this->postJson(route('api.v1.airports.destroy', ['airport' => $airport]), [
            '_method' => 'DELETE',
        ], [
            'Authorization' => $this->token
        ]);

        $airport = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'airports',
                'id' => $airport->data->id,
                'attributes' => [
                    'name' => $airport->data->attributes->name,
                    'code' => $airport->data->attributes->code,
                    'city' => $airport->data->attributes->city,
                ],
                'links' => [
                    'self' => route('api.v1.airports.show', $airport->data->id)
                ]
            ]
        ]);
    }

}
