<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SchoolyearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('school_years')->insert(array(
             array(
                    'school_year'=>'2016/2017', 
                    'start_date'=>Carbon::create('2016', '09', '12'),
                    'end_date'=>Carbon::create('2017', '07', '21')
                  ),

             array(
                    'school_year'=>'2017/2018', 
                    'start_date'=>Carbon::create('2017', '09', '11'),
                    'end_date'=>Carbon::create('2018', '07', '20')
                 ),
             
          ));
    }
}
