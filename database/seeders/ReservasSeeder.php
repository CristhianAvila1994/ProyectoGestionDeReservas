<?php

namespace Database\Seeders;

use App\Models\Reservas;
use Illuminate\Database\Seeder;

class ReservasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservas::factory(500)->create();
    }
}
