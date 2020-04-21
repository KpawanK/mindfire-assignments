<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //as slug can not be accessed directly so we are defining this function
    public function getRouteKeyName(){
        return 'slug';
    }

    //relationship with company(i.e many jobs belong to same company)
    public function company(){
        return $this->belongsTo('App\Company');
    }
}
