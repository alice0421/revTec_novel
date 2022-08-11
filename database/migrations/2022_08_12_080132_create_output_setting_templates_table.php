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
            $table->unsignedInteger('font_size');
            $table->unsignedInteger('row_num');
            $table->unsignedInteger('font_num');
            $table->unsignedInteger('margin_inner');
            $table->unsignedInteger('margin_outer');
            $table->unsignedInteger('margin_top');
            $table->unsignedInteger('margin_bottom');
            $table->unsignedBigInteger('user_id'); /* usesテーブルのリレーション */
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
