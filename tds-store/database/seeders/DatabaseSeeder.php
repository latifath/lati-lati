<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CategorieSeeder::class);
        $this->call(SousCategorieSeeder::class);
        $this->call(ProduitSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(PartenaireSeeder::class);
        $this->call(PanierSeeder::class);
        $this->call(StockSeeder::class);
        $this->call(PromotionSeeder::class);

    }
}
