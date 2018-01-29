<?php

namespace App\Http\ViewComposers;
use Illuminate\Http\Request;

use Illuminate\View\View;
use App\Repositories\UserRepository;


use Carbon\Carbon;
use Auth;
use App\Student;
use App\Group;
use App\School_year;
use App\Term;
use App\Staffer;
use App\Fee;
use App\Feetype;
use App\School;



Class HeadAdminSidebarComposer {

	
	
	public function compose (View $view)
    {
        
    	//get term
        $terms = Term::get();
        $groups = Group::get();
        $school = School::first();

        //put variables in views
        $view->with('terms', $terms )->with('groups', $groups)->with('school', $school);
       
    }
}



