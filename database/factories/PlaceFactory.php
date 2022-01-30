<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $repair = random_int(0, 1);
        if ($repair == 0 ) {
            $work = "1";
            $repair = "0";
        }
        else {
            $work = "0";
            $repair = "1";
        }
        return [
            'name' => $this -> faker -> word(),
            'description' => $this -> faker -> sentence(),
            'repair' => $repair,
            'work' => $work
        ];
    }
}
