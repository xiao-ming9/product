<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondType extends Model
{
    public function thirdType()
    {
        return $this->hasMany('App\ThirdType','secondtype_id');
    }
}
