<?php

use App\FileDownloadLog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileDownloadLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_download_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fdx')->default(FileDownloadLog::DEFAULT);
            $table->integer('udx')->default(FileDownloadLog::DEFAULT);
            $table->string('ip', 20)->default("");
            $table->timestamp('created_at');

            $table->foreign('fdx')->references('fdx')->on('files')->onUpdate('cascade');
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
        Schema::dropIfExists('file_download_logs');
    }
}
