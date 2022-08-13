<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shortcut;

class ShortcutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shortcut::create([
            'name' => '元に戻す(アンドゥ)',
            'function' => 'Ctrl+z',
            'user_id' => 1,
        ]);
    }
}
