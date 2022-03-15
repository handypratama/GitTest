<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ItemSeeder::class);

        User::create([
            'name' => "Russell",
            "email" => "russell@gmail.com",
            "password" => bcrypt("russell"),
            "address" => "Kebon Jeruk",
            "gender" => "Male",
        ]);

        User::create([
            'name' => "Kevin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("admin"),
            "address" => "Ciledug",
            "gender" => "Male",
            "role" => "Admin"
        ]);
    }
}
