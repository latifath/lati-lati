<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SousCategorie;
use Illuminate\Support\Str;

class SousCategorieFactory extends Factory
{

    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = SousCategorie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()

      {
          $nom = 'sous_cat-' . $this->faker->firstName();
          $slug= Str::slug($nom . $this->faker->time($format = 's', $max = 'now'));
        return [
            'categorie_id' => $this->faker->randomElement($array = array ('1','2','3','4','5','6','7','8','9','10')),
            'nom' => $nom,
            'slug' => $slug,
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
