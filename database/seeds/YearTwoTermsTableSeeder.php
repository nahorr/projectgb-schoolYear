<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class YearTwoTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school_year_two = \DB::table('school_years')->where('id', '=', 2)->first();

        DB::table('terms')->insert(array(
             array(
                    'school_year_id'=>$school_year_two->id, 
                    'term'=>'1st Term',
                    'start_date'=>Carbon::create('2017', '09', '11'),
                    'end_date'=>Carbon::create('2017', '12', '15'),
                    'show_until'=>Carbon::create('2018', '01', '07')
                 ),

             array(
                    'school_year_id'=>$school_year_two->id, 
                    'term'=>'2nd Term',
                    'start_date'=>Carbon::create('2018', '01', '08'),
                    'end_date'=>Carbon::create('2018', '04', '06'),
                    'show_until'=>Carbon::create('2018', '04', '15')
                  ),

             array(
                    'school_year_id'=>$school_year_two->id, 
                    'term'=>'3rd Term',
                    'start_date'=>Carbon::create('2018', '04', '16'),
                    'end_date'=>Carbon::create('2018', '07', '20'),
                    'show_until'=>Carbon::create('2028', '01', '01')
                  ),

             

          ));
    }
}
