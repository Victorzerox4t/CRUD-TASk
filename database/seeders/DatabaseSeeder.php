<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('drink')->insert([
            'Drink_Name' => 'Fanta',
            'Qty' => 20,
            'Price' => 7000.00, // pastikan nilai ini sesuai dengan tipe data decimal
            'Description' => 'little alcohol',
            'Image' => 'fanta.jpg'
        ]);
    }
}
