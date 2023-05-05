<?php

namespace Database\Seeders;

use App\Models\Habitacione;
use Illuminate\Database\Seeder;

class HabitacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Habitacione::factory(500)->create();
    }
}
