<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            AirportSeeder::class,
            AirlineSeeder::class,
            FlightSeeder::class,
            RemarkSeeder::class,
        ]);
    }
}
