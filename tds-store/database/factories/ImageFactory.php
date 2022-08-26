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
        $nom = $this->faker->lastName();
        $slug= Str::slug($nom . $this->faker->time($format = 's', $max = 'now'));
        return [
            'nom' =>$nom,
            'slug' =>$slug,
           'path' =>$this->faker->randomElement($array = [
               'https://cdn.pixabay.com/photo/2022/05/05/14/57/rice-7176354__340.jpg',
               'https://cdn.pixabay.com/photo/2022/05/10/11/12/tree-7186835__480.jpg',
               'https://cdn.pixabay.com/photo/2022/05/13/16/22/lake-7194103__340.jpg',
               'https://cdn.pixabay.com/photo/2022/05/14/06/12/leaves-7194981__340.jpg',
               'https://cdn.pixabay.com/photo/2022/05/07/06/35/candle-7179556__340.jpg',
               'https://cdn.pixabay.com/photo/2020/01/06/10/16/train-4745050__340.jpg',
               'https://cdn.pixabay.com/photo/2022/05/10/11/12/tree-7186835__480.jpg',
               'https://cdn.pixabay.com/photo/2022/05/13/16/22/lake-7194103__340.jpg',
               'https://cdn.pixabay.com/photo/2022/05/14/06/12/leaves-7194981__340.jpg',
               'https://cdn.pixabay.com/photo/2022/05/07/06/35/candle-7179556__340.jpg',
               'https://cdn.pixabay.com/photo/2020/01/06/10/16/train-4745050__340.jpg',
               'https://images.ctfassets.net/hrltx12pl8hq/3j5RylRv1ZdswxcBaMi0y7/b84fa97296bd2350db6ea194c0dce7db/Music_Icon.jpg'
           ]),
           'produit_id' => $this->faker->randomElement($array = array ('1','2','3','4','5','6','7','8','9','10')),
           'created_at' => $this->faker->date(),
           'updated_at' => $this->faker->date(),



        ];
    }
}
