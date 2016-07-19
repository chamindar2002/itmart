<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdCreativeAdProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_creative_ad_product', function (Blueprint $table) {
            $table->integer('ad_creative_id')->unsigned()->index();
            $table->foreign('ad_creative_id')->references('id')->on('fb_ad_creative')->onDelete('cascade');

            $table->integer('ad_product_id')->unsigned()->index();
            $table->foreign('ad_product_id')->references('id')->on('fb_ad_products')->onDelete('cascade');
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
        //Schema::drop('fb_ad_creative');
        Schema::drop('ad_creative_ad_products');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
