<?php

use Illuminate\Database\Seeder;

class SaffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $groups = DB::table('groups')->first();

        DB::table('staffers')->insert([
            'registration_code' => 'SA45RT71987',
            'title' => 'Mr',
            'first_name' => 'Super',
            'last_name' => 'Admin',
        ]);
    }
}
