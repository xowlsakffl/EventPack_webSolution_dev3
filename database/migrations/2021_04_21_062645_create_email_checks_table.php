<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_checks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default("");
            $table->string('email')->default("");
            $table->string('check_number')->default("");
            $table->string('token')->default("");         
            $table->timestamp('created_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_checks');
    }
}
