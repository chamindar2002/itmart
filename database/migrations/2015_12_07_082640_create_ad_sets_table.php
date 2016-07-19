<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_ad_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campaign_id')->unsigned();
            $table->integer('fb_profile_id')->unsigned();
            $table->string('name', 100);
            $table->biginteger('target_id');
            $table->string('target_name');
            $table->biginteger('custom_audience_id');
            $table->string('custom_audience_name');
            $table->string('optimization_goals', 20)->comment('e.g REACH, IMPRESSIONS');
            $table->decimal('bid_amount', 6, 2);
            $table->decimal('daily_budget', 6, 2);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('status',20)->comment('paused, active, deleted, etc');
            $table->softDeletes();
            $table->timestamps();
            
            
            $table->foreign('fb_profile_id')
                    ->references('id')
                    ->on('facebook_profiles')
                    ->onDelete('cascade');
            
            $table->foreign('campaign_id')
                    ->references('id')
                    ->on('fb_ad_campaigns')
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
        Schema::drop('fb_ad_sets');
    }
}
