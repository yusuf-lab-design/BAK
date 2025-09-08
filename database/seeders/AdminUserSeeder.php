<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $admin = User::updateOrCreate(
            ['email' => 'jeje.yusuf@yahoo.com'],
            [
                'name' => 'Jeje',
                'email' => 'jeje.yusuf@yahoo.com',
                'password' => Hash::make('121314qw'),
                'level' => 'head_office'
            ],
            
        );
    }
}
