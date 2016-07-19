<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('fb_ad_campaigns', function($table)
        {
            $table->increments('id');
            $table->biginteger('campaign_id');
            $table->string('name',100);
            $table->integer('fb_profile_id')->unsigned();
            $table->string('ad_account',100);
            $table->string('objective',50)->comment('e.g LINK_CLICK');
            $table->string('status',20)->comment('paused or active');
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
       Schema::drop('fb_ad_campaigns');
    }
}
