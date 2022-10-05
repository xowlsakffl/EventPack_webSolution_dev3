<?php

use App\PackPage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('stdx');
            $table->string('title')->default("");
            $table->text('content')->default("");
            $table->text('files')->default("");
            $table->integer('udx');
            $table->string('name', 150)->default("");
            $table->string('ip')->default("");
            $table->boolean('show_this')->default(false);
            $table->unsignedTinyInteger('state')->default(PackPage::NORMAL);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('stdx')->references('stdx')->on('site_tasks')->onUpdate('cascade');
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
        Schema::dropIfExists('pack_pages');
    }
}
