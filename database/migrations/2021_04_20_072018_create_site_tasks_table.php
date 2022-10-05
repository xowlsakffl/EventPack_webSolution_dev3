<?php

use App\SiteTask;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_tasks', function (Blueprint $table) {
            $table->bigIncrements('stdx');
            $table->bigInteger('rstdx')->default(0);
            $table->integer('sdx')->default(SiteTask::DEFAULT);
            $table->integer('pdx')->default(SiteTask::DEFAULT);
            $table->string('language', 3)->default('kor');
            $table->bigInteger('sndx');
            $table->integer('parent');
            $table->string('sequence', 10)->default("A");
            $table->string('name', 100)->default("MENU");
            $table->boolean('use_layout')->default(true);
            $table->string('rewrite')->default("");
            $table->json('readable_admins')->nullable();
            $table->json('editable_admins')->nullable();
            $table->json('permissions')->nullable();
            $table->unsignedTinyInteger('state')->default(SiteTask::NORMAL);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('sdx')->references('sdx')->on('sites')->onUpdate('cascade');
            $table->foreign('pdx')->references('pdx')->on('packs')->onUpdate('cascade');
            $table->foreign('sndx')->references('sndx')->on('site_navigations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_tasks');
    }
}
