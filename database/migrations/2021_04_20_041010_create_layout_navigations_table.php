<?php

use App\LayoutNavigation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_navigations', function (Blueprint $table) {
            $table->bigIncrements('londx');
            $table->unsignedTinyInteger('category')->default(LayoutNavigation::DEFAULT);
            $table->string('name_ko', 100)->default("레이아웃 네비");
            $table->string('name_en', 100)->default("Layout Navi");
            $table->string('code', 100)->default("");
            $table->text('html')->default("");
            $table->text('css')->default("");
            $table->unsignedTinyInteger('state')->default(LayoutNavigation::NORMAL);
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
        Schema::dropIfExists('layout_navigations');
    }
}
