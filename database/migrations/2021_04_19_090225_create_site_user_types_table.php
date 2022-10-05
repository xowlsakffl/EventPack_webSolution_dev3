<?php

use App\SiteUserType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_user_types', function (Blueprint $table) {
            $table->bigIncrements('sutdx');
            $table->integer('sdx');
            $table->string('name', 50)->default("사용자분류");
            $table->string('explain')->default("");
            $table->unsignedTinyInteger('state')->default(SiteUserType::NORMAL);
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
        Schema::dropIfExists('site_user_types');
    }
}
