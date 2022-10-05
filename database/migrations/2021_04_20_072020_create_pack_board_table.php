<?php

use App\PackBoard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackBoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_board', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stdx')->default(PackBoard::DEFAULT);
            $table->string('title')->default("");
            $table->text('content')->default("");
            $table->text('files')->default("");
            $table->integer('udx');
            $table->string('name', 100)->default("");
            $table->string('password', 200)->default("");
            $table->string('ip')->default("");
            $table->boolean('show_this')->default(false);
            $table->boolean('secret')->default(false);
            $table->boolean('notice')->default(false);
            $table->unsignedTinyInteger('state')->default(PackBoard::NORMAL);
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
        Schema::dropIfExists('pack_boards');
    }
}
