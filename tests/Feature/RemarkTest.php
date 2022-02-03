<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\Flight;
use App\Models\Remark;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RemarkTest extends TestCase
{
    use WithFaker;

    public $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGRhYzg4NDFhNmQ0YjVlZGY0MTdiZGM3ZjBkNjBiYzQ5Y2YwMzdlOTEzMWMxYmY2YTVmOTkxMzU4OGM2MzYyMmVlODIwNzNiMzg4M2EwZjAiLCJpYXQiOjE2NDM4NzI2NjkuNzEwNDksIm5iZiI6MTY0Mzg3MjY2OS43MTA0OTUsImV4cCI6MTY3NTQwODY2OS42OTczNDQsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.h789OkkBXHhoVkBG7RUT5Z4X8KGyE7L2n21EkWAHkHnArO-tfl9e2N_PcWzy-ztwSvSqW3znRniS91VtuCiSMWx7a_DIJ_K_pP1Pqsa7lrLFGfIIK1dF_GfaWIT5KUQsXJpM5arxrnyjN0YvKVQg7RIRFVQLcatv7_CZcxyMsGzknx9OnVbtPJ3sLbKW8bBZlQp1aQNH883Zry7bSk9JPTf9GH1KcEL0adrijfFBZ4_lZvhzLo-enawWOx8z4-gAKRc-AVvxUqVMsqwdL5mvDfUigiPX1p9X_Pd-i92toL52PuWB4oyRH6sOV_VjzjzT5KkH1cBuqBWtbg8Wll1P6uwQJAxAh8NEXkDUjSbJYC7PA2cbFYvdlvkLrInX767j7PYRXX6Tg6BMlFUn0J_UT-rEdnm1w2-_PBWh3WyqjAYspJh0H2-TL4ow7qJcCWIdv4uV2ENkVPD2bQ_XXHZ7jHnUEMijsWnmBnSS2K8yZAS0GrW_5OxCQFwFifrx3OFGfy1Rjeyq_txO-GET9jjHvhw8WHV3LMCBNngZZ1o4s4bIXDOJbFvm7br0-_f09GkHYCFb_3x2j8CKNqdRY_MO0SGx287XfxWWFGRQgoWV__S6D35gMavuY8BngyswNAsy55gzpSMG4-ZHwUWFGI52YBYmkJevp_FxjajgXttKCUw";

    public function test_can_fetch_single_remark()
    {
        $this->withExceptionHandling();

        $remark = Remark::factory()->create();

        $response = $this->getJson(route('api.v1.remarks.show', ['remark' => $remark]), [
            'Authorization' => $this->token
        ]);

        $response->assertJson([
            'data' => [
                'type' => 'remarks',
                'id' => $remark->id,
                'attributes' => [
                    'remarkable_id' => $remark->remarkable_id,
                    'remarkable_type' => $remark->remarkable_type,
                    'comment' => $remark->comment,
                ],
                'links' => [
                    'self' => route('api.v1.remarks.show', ['remark' => $remark])
                ]
            ]
        ]);
    }

    public function test_can_fetch_all_remarks()
    {
        $this->withExceptionHandling();

        $response = $this->getJson(route('api.v1.remarks.index'), [
            'Authorization' => $this->token
        ]);

        $remarks = json_decode($response->getContent());

        $response->assertOk();
    }

    public function test_can_create_remark()
    {
        $this->withExceptionHandling();

        $response = $this->postJson(route('api.v1.remarks.store'), [
            'remarkable_id' => Flight::factory()->create()->id,
            'remarkable_type' => Flight::class,
            'comment' => $this->faker->text(),
        ], [
            'Authorization' => $this->token
        ]);

        $remark = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'remarks',
                'id' => $remark->data->id,
                'attributes' => [
                    'remarkable_id' => $remark->data->attributes->remarkable_id,
                    'remarkable_type' => $remark->data->attributes->remarkable_type,
                    'comment' => $remark->data->attributes->comment,
                ],
                'links' => [
                    'self' => route('api.v1.remarks.show', ['remark' => $remark->data->id])
                ]
            ]
        ]);
    }

    public function test_can_update_remark()
    {
        $this->withoutExceptionHandling();

        $remark = Remark::first();

        $response = $this->postJson(route('api.v1.remarks.update', ['remark' => $remark]), [
            '_method' => 'PATCH',
            'remarkable_id' => Airline::factory()->create()->id,
            'remarkable_type' => Airline::class,
            'comment' => $this->faker->text(),
        ], [
            'Authorization' => $this->token
        ]);

        $remark = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'remarks',
                'id' => $remark->data->id,
                'attributes' => [
                    'remarkable_id' => $remark->data->attributes->remarkable_id,
                    'remarkable_type' => $remark->data->attributes->remarkable_type,
                    'comment' => $remark->data->attributes->comment,
                ],
                'links' => [
                    'self' => route('api.v1.remarks.show', ['remark' => $remark->data->id])
                ]
            ]
        ]);
    }

    public function test_can_delete_remark()
    {
        $this->withoutExceptionHandling();

        $remark = Remark::first();

        $response = $this->postJson(route('api.v1.remarks.destroy', ['remark' => $remark]), [
            '_method' => 'DELETE',
        ], [
            'Authorization' => $this->token
        ]);

        $remark = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'remarks',
                'id' => $remark->data->id,
                'attributes' => [
                    'remarkable_id' => $remark->data->attributes->remarkable_id,
                    'remarkable_type' => $remark->data->attributes->remarkable_type,
                    'comment' => $remark->data->attributes->comment,
                ],
                'links' => [
                    'self' => route('api.v1.remarks.show', ['remark' => $remark->data->id])
                ]
            ]
        ]);
    }

}
