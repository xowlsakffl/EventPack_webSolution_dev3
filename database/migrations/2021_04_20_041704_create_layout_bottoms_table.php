<?php

use App\LayoutBottom;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutBottomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_bottoms', function (Blueprint $table) {
            $table->bigIncrements('lobdx');
            $table->unsignedTinyInteger('category')->default(LayoutBottom::DEFAULT);
            $table->string('name_ko', 100)->default("레이아웃 하단");
            $table->string('name_en', 100)->default("Layout Bottom");
            $table->string('code', 100)->default("");
            $table->text('html')->default("");
            $table->text('css')->default("");
            $table->unsignedTinyInteger('state')->default(LayoutBottom::NORMAL);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_bottoms');
    }
}
