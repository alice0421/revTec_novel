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
        Novel::create([
            'title' => 'Title02',
            'body' => 'Body02',
            'user_id' => 2,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => 'Title03',
            'body' => 'Body03',
            'user_id' => 1,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => 'Title04',
            'body' => 'Body04',
            'user_id' => 2,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => 'Title05',
            'body' => 'Body05',
            'user_id' => 1,
            'output_setting_template_id' => 1,
        ]);
    }
}
