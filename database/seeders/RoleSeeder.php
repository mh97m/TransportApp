<?php

namespace Database\Seeders;

use App\Models\CargoType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();

        $items = [
            'admin',
            'owner',
            'driver',
        ];

        foreach ($items as $item) {
            Role::create(['name' => $item]);
        }
    }
}
