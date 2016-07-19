<?php

use Illuminate\Database\Seeder;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'first_name' => 'Allison',
            'last_name' => 'Dev',
            'email' => 'allisondev782@gmail.com',
            'password' => '$2y$10$TowaYjXpskHcfXXp9QLY9.XUHXliG6UwbTeyJ43GRh6efpDkvugMa',
            
        ]);
        
        DB::table('roles')->insert([
            'name' => 'admin',
            'label' => 'Administrator',
           
        ]);
    }
}
