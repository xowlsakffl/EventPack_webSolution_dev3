<?php

use App\SiteUserCondition;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteUserConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_user_conditions', function (Blueprint $table) {
            $table->bigIncrements('sucdx');
            $table->integer('sdx');
            $table->string('name', 50)->default("사용자상태");
            $table->text('explain')->default("");
            $table->unsignedTinyInteger('state')->default(SiteUserCondition::NORMAL);
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
        Schema::dropIfExists('site_user_conditions');
    }
}
