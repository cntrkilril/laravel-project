<?php

namespace Database\Factories;

use App\Models\Thing;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Thing::class;
    public function definition()
    {
        return [
            'name' => $this -> faker -> word(),
            'description' => $this -> faker -> sentence(),
            'master_id' => "1",
            'wrnt' => '20/10/2022'
        ];
    }
}
