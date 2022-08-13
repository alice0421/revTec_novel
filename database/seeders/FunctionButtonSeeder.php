<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FunctionButton;

class FunctionButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FunctionButton::create([
            'name' => 'ルビtest',
            'function' => '[[rb:ルビを振りたい文字 > ルビ]]',
            'user_id' => 1,
        ]);
    }
}
