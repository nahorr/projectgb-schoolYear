<?php

use Illuminate\Database\Seeder;

class SchoolyearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$now = date('Y-m-d');

        DB::table('school_years')->insert([
            'school_year' => '2017/2018',
            'start_date' => $now,
            'end_date' => $now,
        ]);
    }
}
