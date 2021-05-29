<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([

                "nama" => "Admin Keren",
                "email" => "admin@email.com",
                "password" => Hash::make("adminkeren123"),

        ]);
    }
}
