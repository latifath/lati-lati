<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Stock;

class StockFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()

    {
        return [
           'quantite' =>$this->faker->biasedNumberBetween($min = 5, $max = 50),
           'produit_id' =>$this->faker->randomElement($array = array ('1','2','3','4','5','6','7','8','9','10')),
           'prix_unitaire' => $this->faker->numberBetween($min = 10000, $max = 10000),
           'montant' => $this->faker->numberBetween($min = 100000, $max = 100000),
           'nom_produit' => $this->faker->city(),
           'created_at' => $this->faker->date(),
           'updated_at' => $this->faker->date(),
        ];
    }
}
