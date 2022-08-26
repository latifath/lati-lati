<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;
use Illuminate\Support\Str;


class ProduitFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Produit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nom = $this->faker->city();
        $slug= Str::slug($nom . $this->faker->time($format = 's', $max = 'now'));
        return [
            'nom' => $nom,
            'slug' => $slug,
            'description' => $this->faker->sentence($nbWords = 8, $variableNbWords = true) ,
            'quantite' => $this->faker->biasedNumberBetween($min = 5, $max = 50),
            'prix' => $this->faker->numberBetween($min = 10000, $max = 10000),
            'sous_categorie_id' => $this->faker->randomElement($array = array ('1','2','3','4','5','6','7','8','9','10')),
            'prix_achat' => $this->faker->numberBetween($min = 10000, $max = 1000000),
            'prix_vente_500000' => $this->faker->numberBetween($min = 10000, $max = 5000000),
            'prix_vente_1000000' => $this->faker->numberBetween($min = 10000, $max = 1000000),
            'prix_vente_5000000' => $this->faker->numberBetween($min = 10000, $max = 5000000),
            'prix_vente_10000000' => $this->faker->numberBetween($min = 10000, $max = 10000000),
            'prix_vente_10000000_+' => $this->faker->numberBetween($min = 10000, $max = 20000000),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
