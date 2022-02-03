<?php

namespace Tests\Feature;

use App\Models\Airport;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AirportTest extends TestCase
{

    use WithFaker;

    public $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzkxOTZhMGNhYWRjMDRmNWI5YTRiYmIyZjJhMDIzYjVlZGUzNjk1NTcwODlkZjM0NTNjYmJmOWRlZTBhNjU5YzI2YmVhMjE3ZTRlM2ZjMjUiLCJpYXQiOjE2NDM4NTM5NzYuNTE2MDY0LCJuYmYiOjE2NDM4NTM5NzYuNTE2MDY5LCJleHAiOjE2NzUzODk5NzYuNTA0NjYsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.ZZli6DCCXtlC_FIjwuZI99xtAHlq5wTcxa3QvUz_XsY-MQzvBz3gNfdjuu19eVBSO1Jph5Ammx_iMlFUz0DQ_fv8LPL0BOUOjTF1oc18zYt5YLFH66X3CoEkdvjRjiMECQlwwvLb6fbi0fcWlLcMFnqhlS0vuWx3C-5clWXWIOc9qplRWPjBZiKQgG8VPIBx-eapr9sS_yK7cG1j3ApIvRyHd6BdQ0p-1TRKjcA485R_jyuwH6Py5PORcSFpv7F48PFaKvWq9iqtbvvLnxz7se3Fb0reTdrPmXO3q3f5QW71vzactsuGcemG7A5Em-7hS5yHpue-vlBpP_I-V5YnWI1Fvx_JekdA5gw2HfQi-ibzoRNBwXFonkqy87PHa4Wftn1NDyi8SOOBdmQpekrZty9w-PHvIf7nDmzu5_NcLdnu-3tfHsuVwJ_M-cvVic2hNqIWbuGSwPOJQQ1LIBlUfkxEzWLRAaPBB20JGImW2bel_v5OTkFBFoDWuEOJFDdKIv_98UF55r2nmBmqDbBKuemkDJYSnRgo_lx8HCvOKRZGQG4iCvFcwTzrEscAPpnq7w1O-zsuPqDHHoFncW93wuLYTESBfW_AxsvxynBUVVuf28y5X7Hb7IVRoyfEqNY3iwQ9iNYJdgIUqfzRw0Zcor64wuntC0NsZ1EZEhEvT4Y";

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
