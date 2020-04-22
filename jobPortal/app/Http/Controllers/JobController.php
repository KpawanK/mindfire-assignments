<?php

namespace App\Http\Controllers;

use App\Job;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\JobPostRequest;//this contains the validation rules for the job form if we follow this method of validation the pass jobpostrequest as a parameter inside store method

class JobController extends Controller
{
    //to use middleware for protecting the routes by writing this we cant access any of the methods written by we need to access the index function in seeker profile to view all the jobs so we write except which accepts array as parameter that avoids checking of routes
    public function __construct(){
        $this->middleware('employer',['except'=>array('index','show','apply','allJobs')]);
    }

    //lists all job in the home page i.e welcome page
    public function index(){
        //$jobs = Job::all()->take(10);//fetches randomly 10 records
        $jobs = Job::latest()->limit(10)->where('status',1)->get();//fetches latest 10 records
        $companies = Company::get()->random(12);
        return view('welcome',compact('jobs','companies'));
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

    public function apply(Request $request,$id){
        $jobId = Job::find($id);
        //attach the logged in user id
        $jobId->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message','Application sent!');
    }

    public function applicant(){
        //it checks wether the joib has users or not if there then it fetched only that data otherwise it wont fetch any data
        $applicants = Job::has('users')->where('user_id',auth()->user()->id)->get();
        return view('jobs.applicants',compact('applicants'));
    }

    public function allJobs(Request $request){
        
        $keyword = $request->get('title');
        $type = $request->get('type');
        $category = $request->get('catrgory_id');
        $address = $request->get('address');

        //if the user has clicked the search button then perform this search
        if($keyword || $type || $category || $address){
            $jobs = Job::where('title','LIKE','%'.$keyword.'%')
                       ->orWhere('type',$type)
                       ->orWhere('category_id',$category)
                       ->orWhere('address',$address)
                       ->paginate(10);
        } else{
                //paginate and display
                $jobs = Job::latest()->paginate(10);
        }
        return view('jobs.alljobs',compact('jobs'));
    }
}
 