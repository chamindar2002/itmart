<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdCreativeTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * https://developers.facebook.com/docs/marketing-api/reference/ad-creative/
     */
    public function up()
    {
       Schema::table('fb_ad_creative', function (Blueprint $table) {
            $table->text('link_url')->after('object_url');
            $table->string('ad_type')->comment('link ad with call to action, carousel ad, link ad,  link ad (not connected to a Page),  Video Page Like ad, ad from an existing page post')->after('ad_account');
            $table->string('ldf_message')->comment('Link Data Fields(Link Ad with a call to action) message')->after('ad_account');
            $table->string('ldf_caption')->comment('Link Data Fields(Link Ad with a call to action) caption')->after('ad_account');
            $table->string('ldf_call_to_action_type')->comment('Link Data Fields(Link Ad with a call to action) call_to_action_type')->after('ad_account');
            $table->string('ldf_link_caption')->comment('Link Data Fields(Link Ad with a call to action) link caption')->after('ad_account');
            $table->string('ldf_link_description')->comment('Link Data Fields(Link Ad with a call to action) link description')->after('ad_account');
            $table->string('page_id')->comment('Link Data Fields(Link Ad with a call to action) link caption')->after('ad_account');
            
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
            $table->dropColumn('link_url');
            $table->dropColumn('ad_type');
            $table->dropColumn('ldf_message');
            $table->dropColumn('ldf_caption');
            $table->dropColumn('ldf_call_to_action_type');
            $table->dropColumn('ldf_link_caption');
            $table->dropColumn('ldf_link_description');
            $table->dropColumn('page_id');
            
            
        });
    }
}
