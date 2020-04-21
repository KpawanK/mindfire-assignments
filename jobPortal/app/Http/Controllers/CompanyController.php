<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //the $name parameter is route model binding the advantage is no need to find the company detail we can get it directly by skipping one line
    public function index($id , Company $company){
        return view('company.index',compact('company'));   
    }
}
