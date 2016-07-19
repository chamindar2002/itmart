<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAdSetTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fb_ad_sets', function (Blueprint $table) {
            
            $table->text('target_groups')->after('target_name');
            
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
           
            $table->dropColumn('target_groups');
                       
        });
    }
}
