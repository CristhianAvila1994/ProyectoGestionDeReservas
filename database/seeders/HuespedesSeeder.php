<?php

namespace Database\Seeders;

use App\Models\Huespede;
use Illuminate\Database\Seeder;

class HuespedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Huespede::factory(500)->create();
    }
}
