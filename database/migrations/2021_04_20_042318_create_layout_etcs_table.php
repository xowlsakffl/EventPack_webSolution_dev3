<?php

use App\LayoutEtc;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutEtcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_etcs', function (Blueprint $table) {
            $table->bigIncrements('loedx');
            $table->unsignedTinyInteger('category')->default(LayoutEtc::DEFAULT);
            $table->string('name_ko', 100)->default("레이아웃 기타");
            $table->string('name_en', 100)->default("Layout Etc");
            $table->string('code', 100)->default("");
            $table->string('display_type', 20)->default("direct");
            $table->unsignedSmallInteger('display_duration')->default(LayoutEtc::DEFAULT);
            $table->string('font_default')->default(LayoutEtc::FONTDEFAULT);
            $table->text('font_resource')->default(LayoutEtc::FONTRESOURCE);
            $table->unsignedTinyInteger('state')->default(LayoutEtc::NORMAL);
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
        Schema::dropIfExists('layout_etcs');
    }
}
