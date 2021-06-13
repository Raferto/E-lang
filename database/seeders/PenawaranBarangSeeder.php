<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenawaranBarang;

class PenawaranBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PenawaranBarang::factory()
                ->count(10)
                ->create();
    }
}
