<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTargetSearchCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('fb_ad_target_search_caches', function (Blueprint $table) {
            $table->bigInteger('search_target_id')->after('search_results');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fb_ad_target_search_caches', function (Blueprint $table) {
            $table->dropColumn('search_target_id');
        });
    }
}
