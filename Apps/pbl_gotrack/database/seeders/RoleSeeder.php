<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::updateOrCreate(
            ['role_kode' => 'superAdmin'],
            ['role_nama' => 'Superadmin']
        );

        Role::updateOrCreate(
            ['role_kode' => 'admin'],
            ['role_nama' => 'Admin']
        );
    }
}
