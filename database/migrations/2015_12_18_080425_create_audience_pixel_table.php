<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiencePixelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('fb_audience_pixel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->comment('pixel name');
            $table->integer('user_id')->unsigned();
            $table->integer('ad_account_id')->unsigned();
            $table->biginteger('pixel_id')->comment('returned from fb');
            $table->text('pixel_code');
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('ad_account_id')
                    ->references('id')
                    ->on('fb_ad_account')
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
       
        Schema::drop('fb_audience_pixel');
         
    }
}
