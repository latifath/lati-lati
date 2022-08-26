<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Promotion;

class PromotionFactory extends Factory
{
     /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Promotion::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'code' =>$this->faker->ean8,
        'type' =>$this->faker->lastName,
        'valeur' =>$this->faker->numberBetween($min = 1000, $max = 10000),
        'status' =>$this->faker->lastName,
        ];

    }
}
