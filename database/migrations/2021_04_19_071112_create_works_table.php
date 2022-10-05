<?php

use App\Work;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->bigIncrements('wdx');
            $table->bigInteger('udx');
            $table->string('name', 100)->default("프로젝트");
            $table->string('participant', 100)->default("");
            $table->string('duration', 100)->default("0000.00.00~0000.00.00");
            $table->unsignedTinyInteger('state')->default(Work::NORMAL);
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
        Schema::dropIfExists('works');
    }
}
