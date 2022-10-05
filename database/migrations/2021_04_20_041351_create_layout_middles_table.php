<?php

use App\LayoutMiddle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutMiddlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_middles', function (Blueprint $table) {
            $table->bigIncrements('lomdx');
            $table->unsignedTinyInteger('category')->default(LayoutMiddle::DEFAULT);
            $table->string('name_ko', 100)->default("레이아웃 중단");
            $table->string('name_en', 100)->default("Layout Middle");
            $table->string('code', 100)->default("");
            $table->text('html')->default("");
            $table->text('css')->default("");
            $table->unsignedTinyInteger('state')->default(LayoutMiddle::NORMAL);
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
        Schema::dropIfExists('layout_middles');
    }
}
