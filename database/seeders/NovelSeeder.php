<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Novel;

class NovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Novel::create([
            'title' => 'Title01',
            'body' => 'Body01',
            'user_id' => 1,
            'output_setting_template_id' => 1,
        ]);
    }
}
