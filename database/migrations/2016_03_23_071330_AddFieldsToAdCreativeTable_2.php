<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdCreativeTable2 extends Migration
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
            $table->text('thumb_image_url')->after('ldf_url');
            $table->string('video_id')->after('page_id');

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
            $table->dropColumn('thumb_image_url');
            $table->dropColumn('video_id');

        });
    }
}
