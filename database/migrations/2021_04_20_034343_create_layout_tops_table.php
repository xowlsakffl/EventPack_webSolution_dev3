<?php

use App\LayoutTop;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutTopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_tops', function (Blueprint $table) {
            $table->bigIncrements('lotdx');
            $table->unsignedTinyInteger('category')->default(LayoutTop::DEFAULT);
            $table->string('name_ko', 100)->default("레이아웃 상단");
            $table->string('name_en', 100)->default("Layout Top");
            $table->string('code', 100)->default("");
            $table->text('html')->default("");
            $table->text('css')->default("");
            $table->unsignedTinyInteger('state')->default(LayoutTop::NORMAL);
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
        Schema::dropIfExists('layout_tops');
    }
}
