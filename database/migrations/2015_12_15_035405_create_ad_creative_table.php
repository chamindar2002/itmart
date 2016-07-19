<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdCreativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_ad_creative', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fb_profile_id')->unsigned();
            $table->biginteger('ad_creative_id')->comment('ad creative id return from fb');
            $table->string('name', 150)->comment('ad creative name');
            $table->string('title', 150)->comment('ad creative title');
            $table->text('body')->comment('body/description');
            $table->text('object_url')->comment('fb page/website url');
            $table->string('ad_account',100);
            $table->softDeletes();
            $table->timestamps();
            
            
            $table->foreign('fb_profile_id')
                    ->references('id')
                    ->on('facebook_profiles')
                    ->onDelete('cascade');
            
            
        });
        
        
        Schema::create('ad_creative_ad_media', function (Blueprint $table) {
            $table->integer('ad_creative_id')->unsigned()->index();
            $table->foreign('ad_creative_id')->references('id')->on('fb_ad_creative')->onDelete('cascade');
            
            $table->integer('ad_media_id')->unsigned()->index();
            $table->foreign('ad_media_id')->references('id')->on('fb_ad_media')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('fb_ad_creative');
        Schema::drop('ad_creative_ad_media');
         DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
