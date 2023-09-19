<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    public function definition()
    {
        $address = ['yangon','mandalay','pyin oo lwing', 'monywa','yeu'];
        return [
            'title'=> $this->faker->sentence(8),
            'description'=> $this->faker->text(200),
            'price'=>rand(3000,4500),
            'address'=>$address[array_rand($address)],
            'rating'=>rand(1,5)
        ];
    }
}
