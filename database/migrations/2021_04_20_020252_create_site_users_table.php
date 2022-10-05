<?php

use App\SiteUser;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_users', function (Blueprint $table) {
            $table->bigIncrements('sudx');
            $table->integer('sdx');
            $table->integer('udx');
            $table->string('name', 50)->default("");
            $table->string('email')->default("");
            $table->char('email_auth', 1)->default(SiteUser::UNVERIFIED);
            $table->string('cell', 30)->default("");
            $table->char('cell_auth', 1)->default(SiteUser::UNVERIFIED);
            $table->char('admin_level', 1)->default(SiteUser::UNVERIFIED);
            $table->unsignedTinyInteger('state')->default(SiteUser::NORMAL);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('sdx')->references('sdx')->on('sites')->onUpdate('cascade');
            $table->foreign('udx')->references('udx')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_users');
    }
}
