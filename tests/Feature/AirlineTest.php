<?php

namespace Tests\Feature;

use App\Models\Airline;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AirlineTest extends TestCase
{
    use WithFaker;

    public $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYWFlNTRhMjhiYTA3ZWIzZjRiOWVmMjJhOTEyOGQ4NTUwOTIzNzk5NjM4OGYwZjk4ZGMyZjI0YmVjNDdiNDkwOTg5OThkNWY4ZTBlYTVlMWEiLCJpYXQiOjE2NDM4NTg5NjkuMzg2NDE2LCJuYmYiOjE2NDM4NTg5NjkuMzg2NDIyLCJleHAiOjE2NzUzOTQ5NjkuMzc2MzUxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Z2aWEJDyDhqDyZb3jMDpGwTIeKKmGd8EgL0bgYd5vVPhWHrK_atWNSbWlNYNS6hCTmG8os0A5WqqQvizoAfFu6cuoNDhoYpzunfGa3hY8HYW0yeBPz7EGrNI-KrQCPboKn4a5ggw7vqMO5c14p5Ob-2EJGjwpr9FaUmRP4aedVFFPh6UBqzcd724s3d9LjrryKeEqwZw6x-3SFa_hDws4ObBy9eRg0z8IL0CQTSss7_gAlCF7hfLtDthXSww92q4ivN996pFC8OMVyRWI6-rkqYPzo8metPpQOYjP_XnHE3Qhw1H4ePjfS_xHheXrhGKnXYEnkcV67vpQaOy4U2_ekkkIl60AwxGh93f4Rk9K0fbgHVWeR0pZeiBpC5n4ZnWGkbm4cWgylactqS0_dE-NfAFfjBLBKVgVlv_SO5ZPGFF7bgkNZBvsk7g2FrImMWaHneB-VWvhk9zjxB_pmzRgioNzFmV_4mh7WBTOPmMzc3scVgSASUFaM1N6nn3v77hKOp9aZqKVIH6Zp3eEaJ1JVyMt3nzYyj2M-bgcorPsMCkvNt4BCcW1GHh3TpSFZ2unwfKXlBw4xxzvg-Zk6fc2sDJZ422Wf2bLkCYjoqxLj4QPSjaiGFN8q04AyiDgMAhrPLpFRFt0AIeq8ngBYGMH3TOEHDu5eTkL8JCOZmV2BY";

    public function test_can_fetch_single_airline()
    {
        $this->withoutExceptionHandling();

        $airline = Airline::factory()->create();

        $response = $this->getJson(route('api.v1.airlines.show', $airline), [
            'Authorization' => $this->token
        ]);

        $response->assertJson([
            'data' => [
                'type' => 'airlines',
                'id' => $airline->id,
                'attributes' => [
                    'name' => $airline->name,
                    'code' => $airline->code,
                ],
                'links' => [
                    'self' => route('api.v1.airlines.show', $airline)
                ]
            ]
        ]);
    }

    public function test_can_fetch_all_airlines()
    {
        $this->withoutExceptionHandling();

        $response = $this->getJson(route('api.v1.airlines.index'), [
            'Authorization' => $this->token
        ]);

        $airlines = json_decode($response->getContent());

        $response->assertOk();
    }

    public function test_can_create_airline()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.airlines.store'), [
            'name' => $this->faker->name(),
            'code' => $this->faker->word(),
        ], [
            'Authorization' => $this->token
        ]);

        $airline = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'airlines',
                'id' => $airline->data->id,
                'attributes' => [
                    'name' => $airline->data->attributes->name,
                    'code' => $airline->data->attributes->code,
                ],
                'links' => [
                    'self' => route('api.v1.airlines.show', $airline->data->id)
                ]
            ]
        ]);
    }

    public function test_can_update_airline()
    {
        $this->withoutExceptionHandling();

        $airline = Airline::first();

        $response = $this->postJson(route('api.v1.airlines.update', ['airline' => $airline]), [
            '_method' => 'PATCH',
            'name' => $this->faker->name(),
            'code' => $this->faker->word(),
        ], [
            'Authorization' => $this->token
        ]);

        $airline = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'airlines',
                'id' => $airline->data->id,
                'attributes' => [
                    'name' => $airline->data->attributes->name,
                    'code' => $airline->data->attributes->code,
                ],
                'links' => [
                    'self' => route('api.v1.airlines.show', $airline->data->id)
                ]
            ]
        ]);
    }

    public function test_can_delete_airline()
    {
        $this->withoutExceptionHandling();

        $airline = Airline::first();

        $response = $this->postJson(route('api.v1.airlines.destroy', ['airline' => $airline]), [
            '_method' => 'DELETE',
        ], [
            'Authorization' => $this->token
        ]);

        $airline = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'airlines',
                'id' => $airline->data->id,
                'attributes' => [
                    'name' => $airline->data->attributes->name,
                    'code' => $airline->data->attributes->code,
                ],
                'links' => [
                    'self' => route('api.v1.airlines.show', $airline->data->id)
                ]
            ]
        ]);
    }
}
