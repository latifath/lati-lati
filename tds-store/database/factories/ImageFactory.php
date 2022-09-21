<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
use Illuminate\Support\Str;


class ImageFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'filename' =>$this->faker->randomElement($array = [
               'https://cdn.pixabay.com/photo/2022/05/05/14/57/rice-7176354__340.jpg',
               'https://cdn.pixabay.com/photo/2022/05/10/11/12/tree-7186835__480.jpg'
           ]),
           'created_at' => $this->faker->date(),
           'updated_at' => $this->faker->date(),

        ];
    }
}
