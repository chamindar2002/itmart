<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCustomAudienceTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('fb_audience_custom', function (Blueprint $table) {
            $table->string('data_type')->after('prefill')->comment('data type = email, phone numbers, app users and mobile advertiser ids');
            $table->text('data')->after('data_type')->comment('emails, phone numbers, etc');
            $table->biginteger('audience_size')->after('data_type')->comment('estimated audience size');
            $table->integer('delivery_status_code');
            $table->string('delivery_status_description');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('fb_audience_custom', 'data_type'))
        {
            Schema::table('fb_audience_custom', function (Blueprint $table) {
                $table->dropColumn('data_type');
                $table->dropColumn('data');
                $table->dropColumn('audience_size');
                $table->dropColumn('delivery_status_code');
                $table->dropColumn('delivery_status_description');
            });
        }
       
        
    }
}
