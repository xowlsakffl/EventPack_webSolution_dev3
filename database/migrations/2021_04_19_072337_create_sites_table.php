<?php

use App\Site;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->bigIncrements('sdx');
            $table->bigInteger('wdx');
            $table->string('name', 100)->default("웹사이트 호칭");
            $table->string('domain')->default("");
            $table->string('email_name', 50)->default("");
            $table->string('email_address', 150)->default("");
            $table->string('phone_name', 50)->default("");
            $table->string('phone_address', 50)->default("");
            $table->string('title')->default("");
            $table->text('description')->default("설명");
            $table->text('keyword')->default("키워드");
            $table->bigInteger('favicon_fdx')->unsigned()->nullable();
            $table->string('og_title')->default("");
            $table->text('og_url')->default("SNS 설명");
            $table->text('og_description')->default("SNS 키워드");
            $table->bigInteger('og_images')->unsigned()->nullable();
            $table->text('meta')->default("");
            $table->boolean('saving_events_pack')->default(true);
            $table->boolean('use_email_auth')->default(true);
            $table->boolean('main_user_policy')->default(true);
            $table->boolean('seperate_user_policy')->default(true);
            $table->unsignedTinyInteger('state')->default(Site::NORMAL);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('wdx')->references('wdx')->on('works')->onUpdate('cascade');
            $table->foreign('favicon_fdx')->references('fdx')->on('files')->onDelete('set null');
            $table->foreign('og_images')->references('fdx')->on('files')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
