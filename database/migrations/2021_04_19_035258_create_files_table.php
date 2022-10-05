<?php

use App\File;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('fdx');
            $table->integer('udx')->default(File::DEFAULT);
            $table->text('url')->default("");
            $table->text('up_name')->default("");
            $table->string('real_name')->default("");
            $table->unsignedInteger('size')->default(File::DEFAULT);
            $table->string('extension', 10)->default("");
            $table->unsignedSmallInteger('download')->default(File::DEFAULT);
            $table->unsignedSmallInteger('width')->default(File::DEFAULT);
            $table->unsignedSmallInteger('height')->default(File::DEFAULT);
            $table->unsignedTinyInteger('state')->default(File::TEMPORARY);
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('files');
    }
}
