<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\User\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Create user admin.
         */
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => RoleEnum::ADMIN->value,
        ]);

        /**
         * Create user user.
         */
        User::create([
            'name' => 'Client',
            'email' => 'client@client.com',
            'password' => Hash::make('password'),
            'role' => RoleEnum::CLIENT->value,
        ]);
    }
}
