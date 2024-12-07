<?php

namespace Database\Seeders;

use App\Models\CargoType;
use App\Models\User;
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

        $user = User::factory()->create([
            'name' => 'Admin',
            'mobile' => '09364036152',
        ]);

        $user->assignRole('admin');

        $user = User::factory()->create([
            'name' => 'Driver',
            'mobile' => '09364036150',
        ]);

        $user->assignRole('driver');

        $user = User::factory()->create([
            'name' => 'Owner',
            'mobile' => '09364036151',
        ]);

        $user->assignRole('owner');
    }
}
