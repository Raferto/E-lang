<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'nama' => 'nama barang_' . Str::random(10),
            'harga_awal' => '100000',
            'photo' => 'foto_nama-barang_' . Str::random(10),
            'deskripsi' => $this->faker->text(200, 3),
            'lelang_start' => now(),
            'lelang_finished' => now(),
        ];
    }
}
