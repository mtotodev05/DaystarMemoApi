<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'name' => 'me',
            'email' => 'me@me.com',
            'password' => bcrypt('me')
        ]]);
        DB::table('groups')->insert([[
            'name' => 'me',
            'type' => 'academic',
            'privacy' => 'open',
            'interaction' => 'informative'
        ]]);
    }
}
