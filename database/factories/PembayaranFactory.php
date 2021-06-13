<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PembayaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'penawaran_id' => $this->faker->unique()->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
            'bukti_pembayaran' => "http://e-lang.com/storage/35db856c4-92e1-45b2-b652-062070360f3e.jpg"
        ];
    }
}
