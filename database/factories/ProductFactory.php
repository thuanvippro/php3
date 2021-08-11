<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imgFake = $this->faker->image(storage_path('app/public/uploads/products'), $width = 680, $height = 680, 'cats', false);
        return [
            "name" => $this->faker->name(),
            "cate_id" => Category::all()->random()->id,
            "image" => "uploads/products/" . $imgFake,
            "price" => rand(10, 100),
            "quantity" => rand(50, 100),
            "weight" => rand(50, 100),
            "short_description" => $this->faker->text(),
            "detailed_description" => $this->faker->text(),
        ];
    }
}
