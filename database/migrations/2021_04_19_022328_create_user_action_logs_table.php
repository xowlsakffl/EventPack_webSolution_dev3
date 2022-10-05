<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_action_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('udx');
            $table->string('action' ,20)->default("");
            $table->text('content')->default("");
            $table->string('ip', 20)->default("");
            $table->text('ua')->default("");
            $table->unsignedTinyInteger('state')->default(User::NORMAL);
            $table->timestamp('created_at');

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
        Schema::dropIfExists('user_action_logs');
    }
}
