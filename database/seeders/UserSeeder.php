<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\CargoType;
use App\Models\CarType;
use App\Models\City;
use App\Models\DriverDetail;
use App\Models\OwnerDetail;
use App\Models\Plan;
use App\Models\Province;
use App\Models\User;
use App\Services\LocationServiceFacade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $items = [
            [
                'call_counts' => 50,
                'price' => 100000,
            ],
            [
                'call_counts' => 100,
                'price' => 190000,
            ],
            [
                'call_counts' => 200,
                'price' => 350000,
            ],
        ];

        foreach ($items as $item) {
            Plan::create($item);
        }

        $user = User::factory()->create([
            'name' => 'Admin',
            'mobile' => '09364036152',
        ]);

        $user->assignRole('admin');

        $user = User::factory()->create([
            'name' => 'Driver',
            'mobile' => '09364036150',
        ]);
        DriverDetail::create([
            'user_id' => $user->id,
            'car_type_id' => 1,
            'loader_type_id' => 1,
            'plaque' => '59H788',
            'license' => '59H788',
        ]);
        $user->assignRole('driver');

        $user = User::factory()->create([
            'name' => 'Owner',
            'mobile' => '09364036151',
        ]);
        OwnerDetail::create([
            'user_id' => $user->id,
            'plan_id' => 1,
        ]);
        $user->assignRole('owner');
        for ($i=0; $i < 10; $i++) {
            $originCity = City::inRandomOrder()->first();
            $destinationCity = City::inRandomOrder()->first();
            $carType = CarType::inRandomOrder()->first();
            Cargo::create([
                'mobile' => $user->mobile,

                'origin_province_id' => $originCity->province_id,
                'origin_city_id' => $originCity->id,

                'destination_province_id' => $destinationCity->province_id,
                'destination_city_id' => $destinationCity->id,

                'distance' => LocationServiceFacade::getDistance(
                    $originCity,
                    $destinationCity,
                ),

                'car_type_id' => $carType->id,
                'loader_type_id' => $carType->loaderTypes()->first()->id,

                'cargo_type_id' => CargoType::inRandomOrder()->first()->id,

                'weight' => rand(20, 100),

                'price' => rand(1000000, 10000000),

                'description' => fake()->address(),

                'user_id' => $user->id,
            ]);
        }
    }
}
