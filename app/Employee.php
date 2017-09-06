<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function marketingGroup(){
        return $this->belongTo('App\MarketingGroup');
    }
}
