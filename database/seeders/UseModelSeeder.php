<?php

namespace Database\Seeders;

use App\Models\UseModel;
use Illuminate\Database\Seeder;

class UseModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UseModel::factory()->count(3)->create();
    }
}
