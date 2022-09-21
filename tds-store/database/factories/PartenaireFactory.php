<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Partenaire;

class PartenaireFactory extends Factory
{

    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Partenaire::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->lastName(),
            'image' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),

        ];
    }
}
