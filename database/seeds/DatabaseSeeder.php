<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(SchoolyearsTableSeeder::class);
		 $this->call(TermsTableSeeder::class);
		 $this->call(GroupsTableSeeder::class);
		 $this->call(SaffersTableSeeder::class);
         $this->call(AdminsTableSeeder::class);
         $this->call(StafferRegistrationsTableSeeder::class);
    }
}
