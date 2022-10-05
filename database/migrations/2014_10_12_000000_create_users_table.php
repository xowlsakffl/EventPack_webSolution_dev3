<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('udx');
            $table->string('uid', 50)->unique();
            $table->string('password')->default("")->nullable();
            $table->string('name', 150)->default("");
            $table->string('email')->unique()->default("");
            $table->char('email_auth', 1)->default(User::UNVERIFIED);
            $table->string('cell', 30)->default("");
            $table->char('cell_auth', 1)->default(User::UNVERIFIED);
            $table->string('tel', 30)->default("");
            $table->string('country', 2)->default("");
            $table->string('join_from')->default("home");
            $table->string('super')->default(User::REGULAR);
            $table->unsignedTinyInteger('state')->default(User::NORMAL);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
