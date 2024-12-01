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
        User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'Admin',
            'mobile' => '09364036152',
        ]);

        $admin->assignRole('admin');
    }
}
