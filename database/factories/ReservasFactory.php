<?php

namespace Database\Factories;

use App\Models\Habitacione;
use App\Models\Huespede;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class ReservasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fehac_entrada = $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
        $fecha_salida = Carbon::createFromFormat('Y-m-d H:i:s', $fehac_entrada)->addMonth();


       $habi = DB::table('habitaciones')->select()->get();
       $habiArray = $habi->toArray();

       $hues = DB::table('huespedes')->select()->get();
       $huesArray = $hues->toArray();


        return [
            'id'=>$this->faker->Unique()->numerify('cod_Reser ###'),
            'fecha_entrada'=>$fehac_entrada,
            'fecha_salida'=> $fecha_salida,
            'Habitacion_id'=> $habiArray[array_rand($habiArray)]->id,
            'Huespedes_id'=>  $huesArray[array_rand($huesArray)]->id,
            'Numero_de_huespedes'=>$this->faker->numberBetween($min = 1, $max = 5)
        ];
    }
}
