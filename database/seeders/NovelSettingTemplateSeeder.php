<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NovelSettingTemplate;

class NovelSettingTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NovelSettingTemplate::create([
            'writing_size' => 50,
            'preview_size' => 50,
            'font_size' => 'small',
            'user_id' => 1,
        ]);
    }
}
