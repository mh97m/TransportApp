<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProvinceSeeder::class);
        $this->call(CitySeeder::class);

        $this->call(CarTypeSeeder::class);
        $this->call(CargoTypeSeeder::class);
        $this->call(OrderStatusSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
