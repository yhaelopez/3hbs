<?php

namespace Database\Seeders;

use App\Models\Remark;
use Illuminate\Database\Seeder;

class RemarkSeeder extends Seeder
{
    public function run()
    {
        Remark::factory(10)->create();
    }
}
