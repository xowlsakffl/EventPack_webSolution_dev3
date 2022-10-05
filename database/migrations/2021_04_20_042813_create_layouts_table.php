<?php

use App\Layout;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layouts', function (Blueprint $table) {
            $table->bigIncrements('lodx');
            $table->unsignedTinyInteger('category')->default(Layout::DEFAULT);
            $table->string('name_ko', 100)->default("템플릿명");
            $table->string('name_en', 100)->default("Template");
            $table->text('descript_ko')->default("템플릿명");
            $table->text('descript_en')->default("Template");
            $table->unsignedInteger('lotdx')->default(Layout::DEFAULT);
            $table->unsignedInteger('londx')->default(Layout::DEFAULT);
            $table->unsignedInteger('lomdx')->default(Layout::DEFAULT);
            $table->unsignedInteger('lobdx')->default(Layout::DEFAULT);
            $table->unsignedInteger('loedx')->default(Layout::DEFAULT);
            $table->boolean('default')->default(true);
            $table->unsignedTinyInteger('state')->default(Layout::NORMAL);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('lotdx')->references('lotdx')->on('layout_tops')->onUpdate('cascade');
            $table->foreign('londx')->references('londx')->on('layout_navigations')->onUpdate('cascade');
            $table->foreign('lomdx')->references('lomdx')->on('layout_middles')->onUpdate('cascade');
            $table->foreign('lobdx')->references('lobdx')->on('layout_bottoms')->onUpdate('cascade');
            $table->foreign('loedx')->references('loedx')->on('layout_etcs')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layouts');
    }
}
