<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #source: https://gist.github.com/kamermans/1441495
        
        #run seeder : php artisan db:seed --class=CountriesTableSeeder
        
         DB::table('countries')->insert([
            'code' => 'US',
            'name' => 'United States of America',
            'full_name' => 'United States of America',
            'iso_3' => 'USA',
            'number' => 840,
            'continent_code' => 'NA',
            'display_order' => 1,
        ]);
         
        DB::table('countries')->insert([
            'code' => 'GB',
            'name' => 'United Kingdom',
            'full_name' => 'United Kingdom of Great Britain & Northern Ireland',
            'iso_3' => 'GBR',
            'number' => 826,
            'continent_code' => 'EU',
            'display_order' => 2,
        ]);
        
        DB::table('countries')->insert([
            'code' => 'LK',
            'name' => 'Sri Lanka',
            'full_name' => 'Democratic Socialist Republic of Sri Lanka',
            'iso_3' => 'LKA',
            'number' => 144,
            'continent_code' => 'AS',
            'display_order' => 3,
        ]);
    }
}

