<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAstrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('astros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date');
            $table->string('astro_name')->comment('星座名稱');
            $table->string('type')->comment('評分類別');
            $table->integer('score')->comment('運勢分數');
            $table->string('img_url')->comment('運勢分數圖片');
            $table->string('score_text')->comment('運勢分數文字');
            $table->string('content')->comment('運勢內容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('astros');
    }
}
