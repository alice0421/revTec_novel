<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OutputSettingTemplate;

class OutputSettingTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OutputSettingTemplate::create([
            /* 文庫本(A6, 300p以上)設定 */
            'paper_size_height' => 148,
            'paper_size_width' => 105,
            'font_size' => 9.0,
            'between_line_size' => 8.0,
            'row_num_per_page' => 17,
            'font_num_per_row' => 37,
            'margin_inner' => 16,
            'margin_outer' => 9,
            'margin_top' => 13,
            'margin_bottom' => 13,
            'user_id' => 1,
        ]);
    }
}
