<?php

namespace Tests\Feature;

use App\Models\Airport;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AirportTest extends TestCase
{

    use WithFaker;

    public $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGRhYzg4NDFhNmQ0YjVlZGY0MTdiZGM3ZjBkNjBiYzQ5Y2YwMzdlOTEzMWMxYmY2YTVmOTkxMzU4OGM2MzYyMmVlODIwNzNiMzg4M2EwZjAiLCJpYXQiOjE2NDM4NzI2NjkuNzEwNDksIm5iZiI6MTY0Mzg3MjY2OS43MTA0OTUsImV4cCI6MTY3NTQwODY2OS42OTczNDQsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.h789OkkBXHhoVkBG7RUT5Z4X8KGyE7L2n21EkWAHkHnArO-tfl9e2N_PcWzy-ztwSvSqW3znRniS91VtuCiSMWx7a_DIJ_K_pP1Pqsa7lrLFGfIIK1dF_GfaWIT5KUQsXJpM5arxrnyjN0YvKVQg7RIRFVQLcatv7_CZcxyMsGzknx9OnVbtPJ3sLbKW8bBZlQp1aQNH883Zry7bSk9JPTf9GH1KcEL0adrijfFBZ4_lZvhzLo-enawWOx8z4-gAKRc-AVvxUqVMsqwdL5mvDfUigiPX1p9X_Pd-i92toL52PuWB4oyRH6sOV_VjzjzT5KkH1cBuqBWtbg8Wll1P6uwQJAxAh8NEXkDUjSbJYC7PA2cbFYvdlvkLrInX767j7PYRXX6Tg6BMlFUn0J_UT-rEdnm1w2-_PBWh3WyqjAYspJh0H2-TL4ow7qJcCWIdv4uV2ENkVPD2bQ_XXHZ7jHnUEMijsWnmBnSS2K8yZAS0GrW_5OxCQFwFifrx3OFGfy1Rjeyq_txO-GET9jjHvhw8WHV3LMCBNngZZ1o4s4bIXDOJbFvm7br0-_f09GkHYCFb_3x2j8CKNqdRY_MO0SGx287XfxWWFGRQgoWV__S6D35gMavuY8BngyswNAsy55gzpSMG4-ZHwUWFGI52YBYmkJevp_FxjajgXttKCUw";

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
