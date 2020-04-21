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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Job controller
Route::get('/','JobController@index');
Route::get('/jobs/create','JobController@create')->name('job.create');
Route::post('/jobs/store','JobController@store')->name('job.store');
Route::get('/jobs/{id}/edit','JobController@edit')->name('job.edit');
Route::post('/jobs/{id}/edit','JobController@update')->name('job.update');
Route::get('/jobs/my-job','JobController@myjob')->name('my.job');

Route::get('/jobs/{id}/{job}','JobController@show')->name('jobs.show');

//Company Controller
Route::get('/company/{id}/{company}','CompanyController@index')->name('company.index');
Route::get('company/create','CompanyController@create')->name('company.view');
Route::post('company/store','CompanyController@store')->name('company.store');
Route::post('company/coverphoto','CompanyController@coverPhoto')->name('cover.photo');
Route::post('company/logo','CompanyController@companyLogo')->name('company.logo');

//user profile
Route::get('user/profile','UserController@index');
Route::post('user/profile/create','UserController@store')->name('profile.create');
Route::post('user/avatar','UserController@avatar')->name('avatar');
Route::post('user/coverletter','UserController@coverletter')->name('cover.letter');
Route::post('user/resume','UserController@resume')->name('resume'); 

//Employer view
Route::view('employer/register','auth.employer-register')->name('employer.register');
Route::post('employer/register','EmployerRegisterController@employerRegister')->name('emp.register');
