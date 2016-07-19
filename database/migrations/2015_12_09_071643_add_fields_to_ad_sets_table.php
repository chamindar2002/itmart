<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('fb_ad_sets', function (Blueprint $table) {
            $table->bigInteger('ad_set_id')->after('name');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('fb_ad_sets', function (Blueprint $table) {
//            $table->dropColumn('ad_set_id');
//        });
        if (Schema::hasColumn('fb_ad_sets', 'ad_set_id'))
        {
            $table->dropColumn('ad_set_id');
        }
    }
}
