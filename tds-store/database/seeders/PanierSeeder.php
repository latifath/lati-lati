<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Panier;

class PanierSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Panier:: factory()->count(10)->create();
    }
}
