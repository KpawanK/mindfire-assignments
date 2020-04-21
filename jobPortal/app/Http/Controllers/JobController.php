<?php

namespace App\Http\Controllers;

use App\Company;
use App\Job;
use Illuminate\Http\Request;
use App\Http\Requests\JobPostRequest;//this contains the validation rules for the job form if we follow this method of validation the pass jobpostrequest as a parameter inside store method

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

    public function myjob(){
        $jobs = Job::where('user_id',auth()->user()->id)->get();
        return view('jobs.myjob',compact('jobs'));
    }

    public function edit($id){
        $job = Job::findOrFail($id);
        return view('jobs.edit',compact('job'));
    }

    public function update(Request $request,$id){
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return redirect()->back()->with('message','Job successfully updated');
    }
    
    public function create(){
        return view('jobs.create');
    }

    public function store(JobPostRequest $request){
        $user_id = auth()->user()->id;
        $company = Company::where('user_id',$user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug' => str_slug(request('title')),
            'description' => request('description'),
            'roles' => request('roles'),
            'category_id' => request('category'),
            'position' => request('position'),
            'address' => request('address'),
            'type' => request('type'), 
            'status' => request('status'), 
            'last_date' => request('last_date'), 
        ]);
        return redirect()->back()->with('message','Job posted successfully!');
    }
}
 