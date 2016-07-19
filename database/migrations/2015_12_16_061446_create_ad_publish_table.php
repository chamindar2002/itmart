<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdPublishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_ad_publish', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fb_profile_id')->unsigned();
            $table->string('ad_account',100);
            $table->bigInteger('ad_id')->comment('ad id returned from facebook');;
            $table->string('name', 150)->comment('ad creative name');
            $table->integer('ad_creative_id')->unsigned();
            $table->integer('ad_set_id')->unsigned();
            $table->string('status',20)->comment('paused, active, deleted, etc');
            
            $table->softDeletes();
            $table->timestamps();
            
            
            $table->foreign('fb_profile_id')
                    ->references('id')
                    ->on('facebook_profiles')
                    ->onDelete('cascade');
            
            $table->foreign('ad_creative_id')
                    ->references('id')
                    ->on('fb_ad_creative')
                    ->onDelete('cascade');
            
            $table->foreign('ad_set_id')
                    ->references('id')
                    ->on('fb_ad_sets')
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
       
        Schema::drop('fb_ad_publish');
         
    }
}
