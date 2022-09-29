<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SousCategorie;

class SousCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SousCategorie:: factory()->count(5)->create();
    }
}
