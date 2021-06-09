<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert(['id' => 1, 'nama' => 'Tanah', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 2, 'nama' => 'Properti', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 3, 'nama' => 'Mobil', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 4, 'nama' => 'Motor', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 5, 'nama' => 'Bongkaran', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 6, 'nama' => 'Besi Tua', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 7, 'nama' => 'Elektronik', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 8, 'nama' => 'Furniture', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 9, 'nama' => 'Kayu', 'created_at' => now(), 'updated_at' => now()]);
        DB::table('kategori')->insert(['id' => 10, 'nama' => 'UMKM', 'created_at' => now(), 'updated_at' => now()]);
    }
}
