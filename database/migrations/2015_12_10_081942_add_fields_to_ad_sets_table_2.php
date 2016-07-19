<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdSetsTable_2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('fb_ad_sets', function (Blueprint $table) {
            $table->text('geo_locations')->after('target_name');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fb_ad_sets', function (Blueprint $table) {
            $table->dropColumn('geo_locations');
        });
    }
}
