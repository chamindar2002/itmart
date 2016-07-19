<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiedlsToAdTargetSearchCachesTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('fb_ad_target_search_caches', function (Blueprint $table) {
            
            $table->Integer('search_limit')->after('search_results');
            
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
           
            $table->dropColumn('search_limit');
                       
        });
    }
}
