<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fb_ad_media', function (Blueprint $table) {

            $table->renameColumn('media_type', 'media_extension');
            $table->enum('type', array('image', 'video'))->after('image_hash');
            $table->string('video_id')->after('image_hash');

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

            $table->renameColumn('media_extension', 'media_type');
            $table->dropColumn('type');
            $table->dropColumn('video_id');

        });
    }
}
