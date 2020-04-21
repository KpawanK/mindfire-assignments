<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //Relationship with job (i.e a company can have many jobs)
    public function jobs(){
        return $this->hasMany('App\Job');
    }

    //as slug can not be accessed directly so we are defining this function
    public function getRouteKeyName(){
        return 'slug';
    }
}
