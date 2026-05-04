<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleSuperAdmin = Role::where('role_kode', 'superAdmin')->first();
        $roleAdmin = Role::where('role_kode', 'admin')->first();

        User::updateOrCreate(
            ['email' => 'superAdmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
                'role_id' => $roleSuperAdmin->id ?? null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin Denhaag',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
                'role_id' => $roleAdmin->id ?? null,
            ]
        );
    }
}
