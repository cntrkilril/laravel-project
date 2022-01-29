<?php

namespace Database\Seeders;

use App\Models\Thing;
use Illuminate\Database\Seeder;

class ThingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thing::factory()->count(10)->create();
    }
}
