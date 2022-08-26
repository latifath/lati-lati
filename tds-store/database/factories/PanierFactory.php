<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Panier;

class PanierFactory extends Factory
{
     /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Panier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => $this->faker->date(),
           'updated_at' => $this->faker->date(),
        ];
    }
}
