<?php

use Illuminate\Database\Seeder;

class StafferRegistrationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffer = DB::table('staffers')->first();
        $school_year = DB::table('school_years')->first();
        $group = DB::table('groups')->first();
        $term = DB::table('terms')->first();

        DB::table('staffer_registrations')->insert([
            'staffer_id' => $staffer->id,
            'school_year_id' => $school_year->id,
            'group_id' => $group->id,
            'term_id' => $term->id,
        ]);
    }
}
