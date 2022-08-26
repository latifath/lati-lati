<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categorie;
use Illuminate\Support\Str;


class CategorieFactory extends Factory
{

        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categorie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $nom = 'cat-' . $this->faker->lastName();
        $slug= Str::slug($nom . $this->faker->time($format = 's', $max = 'now'));
        return [
           'nom' => $nom ,
           'slug' => $slug,
           'created_at' => $this->faker->date(),
           'updated_at' => $this->faker->date(),
        ];
    }

}
