<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('output_setting_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('paper_size_height');
            $table->unsignedInteger('paper_size_width');
            $table->unsignedDecimal('font_size', $precision = 4, $scale = 1);
            $table->unsignedDecimal('between_line_size', $precision = 4, $scale = 1);
            $table->unsignedInteger('row_num_per_page');
            $table->unsignedInteger('font_num_per_row');
            $table->unsignedInteger('margin_inner');
            $table->unsignedInteger('margin_outer');
            $table->unsignedInteger('margin_top');
            $table->unsignedInteger('margin_bottom');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('output_setting_templates');
    }
};
