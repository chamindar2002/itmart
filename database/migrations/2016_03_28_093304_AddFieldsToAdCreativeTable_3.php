<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdCreativeTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fb_ad_creative', function (Blueprint $table) {
            
            $table->string('post_id')->after('video_id');
            
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fb_ad_creative', function (Blueprint $table) {
           
            $table->dropColumn('post_id');
                       
        });
    }
}
