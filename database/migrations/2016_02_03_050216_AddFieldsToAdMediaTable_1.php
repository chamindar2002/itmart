<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdMediaTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('fb_ad_media', function (Blueprint $table) {
            $table->string('ad_account',100)->after('fb_profile_id');
            $table->text('url')->after('size');
            $table->text('url_128')->after('size');
            $table->string('status',20);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fb_ad_media', function (Blueprint $table) {
            $table->dropColumn('ad_account');
            $table->dropColumn('url')->comment('full image remote url');
            $table->dropColumn('url_128')->comment('small image remote url');
            $table->dropColumn('status');
            
        });
    }
}
