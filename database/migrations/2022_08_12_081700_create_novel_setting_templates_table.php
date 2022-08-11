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
        Schema::create('novel_setting_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('writing_size');
            $table->unsignedInteger('preview_size');
            $table->unsignedInteger('font_size');
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
        Schema::dropIfExists('novel_setting_templates');
    }
};
