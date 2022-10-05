<?php

use App\SiteNavigation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_navigations', function (Blueprint $table) {
            $table->bigIncrements('sndx');
            $table->integer('sdx')->default(SiteNavigation::DEFAULT);
            $table->integer('parent')->default(SiteNavigation::DEFAULT);
            $table->string('sequence', 10)->default("A");
            $table->string('name', 100)->default("MENU");
            $table->integer('destination_stdx')->default(SiteNavigation::DEFAULT);
            $table->text('destination_url')->default("");
            $table->boolean('new_window')->default(false);
            $table->unsignedTinyInteger('state')->default(SiteNavigation::NORMAL);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('sdx')->references('sdx')->on('sites')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_navigations');
    }
}
