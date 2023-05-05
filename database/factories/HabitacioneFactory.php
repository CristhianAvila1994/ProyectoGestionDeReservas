<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HabitacioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->Unique()->numerify('cod_Habit ####'),
            'numero'=>$this->faker->numberBetween($min = 1, $max = 100),
            'Tipo'=>$this->faker->randomElement($array = array ('Individual','Doble','Suite','Economica')),
            'precio'=>$this->faker->numerify('LPS ###')
        ];
    }
}
