<?php

use App\Pack;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->bigIncrements('pdx');
            $table->string('kor_name', 100)->default("이벤츠팩");
            $table->text('kor_explain')->default("이벤츠팩");
            $table->string('eng_name', 100)->default("Events Pack");
            $table->text('eng_explain')->default("Events Pack");
            $table->string('path', 100)->default("path");
            $table->json('readable_actions')->nullable();
            $table->json('editable_actions')->nullable();
            $table->unsignedTinyInteger('state')->default(Pack::NORMAL);
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
        Schema::dropIfExists('packs');
    }
}
