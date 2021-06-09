<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermasukSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        for ($i=1; $i<=10; $i++) {
            DB::table('termasuk')->insert([
                'barang_id' => $i,
                'kategori_id' => rand(1, 10)
            ]);
        }

    }
}
