<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourouselProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_ad_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name',255);
            $table->text('product_description');
            $table->integer('fb_profile_id')->unsigned();
            $table->string('ad_account',100);
            $table->integer('media_id')->unsigned();
            $table->text('product_url')->comment('path to product page');
            $table->string('video_id');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('fb_profile_id')
                ->references('id')
                ->on('facebook_profiles')
                ->onDelete('cascade');

            $table->foreign('media_id')
                ->references('id')
                ->on('fb_ad_media')
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
        Schema::drop('fb_ad_products');
    }
}
