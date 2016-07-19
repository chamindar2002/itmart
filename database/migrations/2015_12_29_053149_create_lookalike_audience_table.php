<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookalikeAudienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_audience_lookalike', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->comment('lookalike audience name');
            
            $table->bigInteger('lookalike_audience_id')->comment('returned from facebook');
            $table->string('country_code', 10)->comment('country code');
            
            $table->integer('custom_audience_id')->unsigned();
            $table->integer('fb_profile_id')->unsigned();
            $table->integer('ad_account_id')->unsigned();
            
            $table->bigInteger('approx_audience_size')->comment('audience size returned from facebook');
            
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('ad_account_id')
                    ->references('id')
                    ->on('fb_ad_account')
                    ->onDelete('cascade');
            
            $table->foreign('fb_profile_id')
                    ->references('id')
                    ->on('facebook_profiles')
                    ->onDelete('cascade');
            
            $table->foreign('custom_audience_id')
                    ->references('id')
                    ->on('fb_audience_custom')
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
        Schema::drop('fb_audience_lookalike');
    }
}
