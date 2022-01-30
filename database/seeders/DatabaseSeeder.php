<?php

namespace Database\Seeders;

use App\Models\UseModel;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ThingSeeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ThingSeeder::class,
            PlaceSeeder::class,
            UseModelSeeder::class
        ]);
    }
}
