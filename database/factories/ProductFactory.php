<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $productName = $this->faker->unique()->words($nb = 2, $asText = true);
        $slug = Str::slug($productName);
        return [
            'name' => $productName,
            'slug' => $slug,
            'shortDesc' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regularPrice' => $this->faker->numberBetween(100, 200),
            'SKU' => 'DIGI' . $this->faker->unique()->numberBetween(100, 500),
            'stockStatus' => 'instock',
            'quantity' => $this->faker->numberBetween(100, 200),
            'image' => 'digital_' . $this->faker->unique()->numberBetween(1, 22) . '.jpg',
            'categoryId' => $this->faker->numberBetween(1, 10)
        ];
    }
}
