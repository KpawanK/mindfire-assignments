<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //middleware controller
    public function __construct(){
        $this->middleware('employer',['except'=>array('index')]);
    }

    //the $name parameter is route model binding the advantage is no need to find the company detail we can get it directly by skipping one line
    public function index($id , Company $company){
        return view('company.index',compact('company'));   
    }

    public function create(){
        return view('company.create');
    }

    public function store(){
        //$request->get('address') and request('address') are both same
        //to get information of current logged in user is using auth 
        $user_id = auth()->user()->id;
        Company::where('user_id',$user_id)->update([
            'address' => request('address'),
            'phone'=> request('phone'),
            'website'=> request('website'),
            'slogan'=> request('slogan'),
            'description'=> request('description'),
          
        ]);
        return redirect()->back()->with('message','Company successfully Updated!');
    }

    public function coverPhoto(Request $request){
        $user_id = auth()->user()->id;
        if($request->hasfile('cover_photo')){
            $file = $request->file('cover_photo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/coverphoto/',$filename);
            Company::where('user_id',$user_id)->update([
                'cover_photo' => $filename,
            ]);
            return redirect()->back()->with('message','Company cover photo successfully Updated!');
        }
    }

    public function companyLogo(Request $request){
        $user_id = auth()->user()->id;
        if($request->hasfile('company_logo')){
            $file = $request->file('company_logo');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/logo/',$filename);
            Company::where('user_id',$user_id)->update([
                'logo' => $filename,
            ]);
            return redirect()->back()->with('message','Company logo successfully Updated!');
        }
    }
}
