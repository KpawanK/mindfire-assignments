<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];
    
    // the user id and comppany id are not coming from form so they need to be placed in fillable if it would have came from form then the gurded would have worked fine
    // protected $fillable = [
    //     'user_id',
    //     'company_id',
    // ];

    //as slug can not be accessed directly so we are defining this function
    public function getRouteKeyName(){
        return 'slug';
    }

    //relationship with company(i.e many jobs belong to same company)
    public function company(){
        return $this->belongsTo('App\Company');
    }

    //Relationship for users
    public function users(){
        return $this->belongsToMany(User::class)->withTimeStamps();
    }
    
    //helper function to check the user is already applied for the particular job or not 
    public function checkApplication(){
        return \DB::table('job_user')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
    }
}