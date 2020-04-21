<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //
    public function index(){
        $jobs = Job::all()->take(10);//fetches randomly 10 records
        return view('welcome',compact('jobs'));
    }

    public function show($id,Job $job){
        //we will be showing jobs using slug not by id so need to create a getRouteKeyName()
        //you can do alternate to writing Job class inside the paramater is inside the function $job =Job::find($id)
        return view('jobs.show',compact('job'));
    }
}
 