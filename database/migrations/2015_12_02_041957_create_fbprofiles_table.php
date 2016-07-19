<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook_profiles', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('email')->unique();
            $table->biginteger('facebook_id')->unique();
            $table->string('name');
            $table->string('gender');
            $table->string('access_token');
            $table->string('access_token_secret');
            $table->softDeletes();
            $table->timestamps();
            
             $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('facebook_profiles');
    }
}
