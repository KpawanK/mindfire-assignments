<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');//it automatically appends the extension to the string passed
// });

//we will go through controller and get required data from database and then redirect to the view page
Route::get('/','JobController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Job show controller 
Route::get('/jobs/{id}/{job}','JobController@show')->name('jobs.show');

//Company Controller
Route::get('/company/{id}/{company}','CompanyController@index')->name('company.index');

//user profile
Route::get('user/profile','UserController@index');
Route::post('user/profile/create','UserController@store')->name('profile.create');
Route::post('user/avatar','UserController@avatar')->name('avatar');
Route::post('user/coverletter','UserController@coverletter')->name('cover.letter');
Route::post('user/resume','UserController@resume')->name('resume');