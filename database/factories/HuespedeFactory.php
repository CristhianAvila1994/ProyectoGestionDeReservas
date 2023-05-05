<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HuespedeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'=>$this->faker->Unique()->bothify('cod_Huesp ##??'),
            'nombre'=>$this->faker->firstNameFemale(),
            'apellido'=>$this->faker->lastName(),
            'correo_electronico'=>$this->faker->email(),
            'telefono'=>$this->faker->tollFreePhoneNumber()
        ];
    }
}


