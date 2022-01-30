<?php

namespace Database\Factories;

use App\Models\UseModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UseModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = UseModel::class;
    public function definition()
    {
        return [
            'thing_id' => $this -> faker -> unique() -> numberBetween(1,5),
            'place_id' => $this -> faker -> numberBetween(1,5),
            'user_id' => $this -> faker -> numberBetween(1,3),
            'amount' => $this -> faker -> numberBetween(1,5),
        ];
    }
}
