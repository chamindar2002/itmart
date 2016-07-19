<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 4)->comment('Two-letter country code (ISO 3166-1 alpha-2)');
            $table->string('name', 50)->comment('English country name');
            $table->string('full_name', 150)->comment('Full English country name');
            $table->char('iso_3', 4)->comment('Three-letter country code (ISO 3166-1 alpha-3)');
            $table->integer('number')->comment('Three-digit country number (ISO 3166-1 numeric)');
            $table->char('continent_code')->comment('continent_code');
            $table->integer('display_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('countries');
    }
}
