<?php

namespace Database\Factories;

use App\Models\PenawaranBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenawaranBarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PenawaranBarang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'barang_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
            'harga' => $this->faker->numberBetween(150000, 500000)
        ];
    }
}
