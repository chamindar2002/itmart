<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_ad_media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fb_profile_id')->unsigned();
            $table->string('media_file', 100)->comment('file name');
            $table->string('original_file_name', 150)->comment('original_file name');
            $table->string('media_type', 100)->comment('.jpg, .gif, etc');
            $table->string('image_hash', 150)->comment('hash key received from fb api after successfull upload');
            $table->string('size', 50)->comment('file size');
            $table->softDeletes();
            $table->timestamps();
            
            
            $table->foreign('fb_profile_id')
                    ->references('id')
                    ->on('facebook_profiles')
                    ->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fb_ad_media');
    }
}
