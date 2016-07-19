<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomAudienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_audience_custom', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->comment('pixel name');
            $table->string('description')->comment('description');
            $table->bigInteger('audience_id')->comment('returned from facebook');
            $table->integer('pixel_id')->unsigned();
            $table->integer('fb_profile_id')->unsigned();
            $table->integer('ad_account_id')->unsigned();
            $table->string('sub_type', 50)->comment('sub type');
            $table->integer('retention_days')->comment('retention days');
            $table->string('website_traffic', 150);
            $table->string('rule_definer', 50);
            $table->text('url_key_words');
            $table->text('rule')->comment('Audience rules to be applied on the referrer URL');
            $table->string('prefill', 10)->comment('true - Include website traffic recorded prior to the audience creation. false - Only include website traffic beginning at the time of the audience creation.');
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
            
            
        });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
        Schema::drop('fb_audience_custom');
         
    }
    
}
