<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbTargetGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_target_interest_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('group name');
            $table->bigInteger('group_id')->comment('returned from facebook');
            $table->integer('search_cache_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            
             $table->foreign('search_cache_id')
                    ->references('id')
                    ->on('fb_ad_target_search_caches')
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
        Schema::drop('fb_target_interest_groups');
    }
}
