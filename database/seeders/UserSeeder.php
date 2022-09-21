<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test2022'),
            'author' => "有栖",
        ]);
        User::create([
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('test2022'),
        ]);
    }
}
