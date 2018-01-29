<?php

namespace App\Http\Controllers\Discipline;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DisciplinaryRecord;

class CrudeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showDRecords()
    {
        

       $drecords = DisciplinaryRecord::orderBy('created_at', 'desc')->paginate(10);
       
       return view('discipline.records', compact('drecords'));
    }
}
