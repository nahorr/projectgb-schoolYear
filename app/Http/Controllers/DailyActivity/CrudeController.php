<?php

namespace App\Http\Controllers\DailyActivity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DailyActivity;



class CrudeController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function showActivities()
    {
        

       $daily_activities = DailyActivity::orderBy('created_at', 'desc')->paginate(10);
       
       return view('dailyactivity.activities', compact('daily_activities'));
    }

}
