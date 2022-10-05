<?php

use App\SiteLayoutSet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteLayoutSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_layout_sets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sdx')->default(SiteLayoutSet::DEFAULT);
            $table->integer('lodx')->default(SiteLayoutSet::DEFAULT);
            $table->integer('lotdx')->default(SiteLayoutSet::DEFAULT);
            $table->text('top_html')->default("");
            $table->text('top_css')->default("");
            $table->integer('londx')->default(SiteLayoutSet::DEFAULT);
            $table->text('navigation_html')->default("");
            $table->text('navigation_css')->default("");
            $table->boolean('use_site_menu')->default(true);
            $table->integer('lomdx')->default(SiteLayoutSet::DEFAULT);
            $table->text('middle_html')->default("");
            $table->text('middle_css')->default("");
            $table->integer('lobdx')->default(SiteLayoutSet::DEFAULT);
            $table->text('bottom_html')->default("");
            $table->text('bottom_css')->default("");
            $table->integer('loedx')->default(SiteLayoutSet::DEFAULT);
            $table->string('display_type', 20)->default("");
            $table->unsignedTinyInteger('display_duration')->default(SiteLayoutSet::DEFAULT);
            $table->string('font_default')->default("");
            $table->text('font_resource')->default("");
            $table->unsignedTinyInteger('state')->default(SiteLayoutSet::NORMAL);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('sdx')->references('sdx')->on('sites')->onUpdate('cascade');
            $table->foreign('lodx')->references('lodx')->on('layouts')->onUpdate('cascade');
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
        Schema::dropIfExists('site_layout_sets');
    }
}
