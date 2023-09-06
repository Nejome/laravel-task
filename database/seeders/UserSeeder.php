<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\UserRoleEnum;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'علي احمد',
            'email' => 'ali@gmail.com',
            'role' => UserRoleEnum::MANAGER,
            'password' => '123',
        ]);

        User::create([
            'name' => 'سامي عمر',
            'email' => 'sami@gmail.com',
            'role' => UserRoleEnum::COORDINATOR,
            'password' => '123',
        ]);
    }
}
