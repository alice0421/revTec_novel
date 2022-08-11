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
        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('body');
            $table->unsignedBigInteger('user_id'); /* usesテーブルのリレーション */
            $table->unsignedBigInteger('series_id'); /* seriesテーブルのリレーション */
            $table->unsignedBigInteger('output_setting_template_id'); /* output_setting_templatesテーブルのリレーション */
            $table->string('image');
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
        Schema::dropIfExists('novels');
    }
};
