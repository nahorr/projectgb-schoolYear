<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class YearOneTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school_year_one = \DB::table('school_years')->where('id', '=', 1)->first();

        DB::table('terms')->insert(array(
             array(
                    'school_year_id'=>$school_year_one->id, 
                    'term'=>'1st Term',
                    'start_date'=>Carbon::create('2016', '09', '12'),
                    'end_date'=>Carbon::create('2016', '12', '16'),
                    'show_until'=>Carbon::create('2017', '01', '08')
                 ),

             array(
                    'school_year_id'=>$school_year_one->id, 
                    'term'=>'2nd Term',
                    'start_date'=>Carbon::create('2017', '01', '09'),
                    'end_date'=>Carbon::create('2017', '04', '07'),
                    'show_until'=>Carbon::create('2017', '04', '16')
                  ),

             array(
                    'school_year_id'=>$school_year_one->id, 
                    'term'=>'3rd Term',
                    'start_date'=>Carbon::create('2017', '04', '17'),
                    'end_date'=>Carbon::create('2017', '07', '21'),
                    'show_until'=>Carbon::create('2027', '01', '01')
                  ),

             

          ));
    }
}
