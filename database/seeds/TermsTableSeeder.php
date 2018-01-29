<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d');
        $school_year_now = \DB::table('school_years')->first();

        DB::table('terms')->insert(array(
             array('school_year_id'=>$school_year_now->id, 'term'=>'1st Term','start_date'=>$now,'end_date'=>$now,'show_until'=>$now),
             array('school_year_id'=>$school_year_now->id, 'term'=>'2nd Term','start_date'=>$now,'end_date'=>$now,'show_until'=>$now),
             array('school_year_id'=>$school_year_now->id, 'term'=>'3rd Term','start_date'=>$now,'end_date'=>$now,'show_until'=>$now),
             

          ));
    }
}
