<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerRegisterController extends Controller
{
    //
    public function employerRegister(){
        $user = User::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'user_type' => request('user_type'),
        ]);
        
        // request is used to retrieve the value from the form
        Company::create([
            'user_id' => $user->id,
            'cname' => request('cname'),
            // we use str_slug to convert anything to slug in laravel
            'slug' => str_slug(request('cname')),
        ]);
        // redirect to login page to login 
        return redirect()->to('login');
    }
}
