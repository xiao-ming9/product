<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThirdType extends Model
{
    public function secondType()
    {
        return $this->belongsTo('App\SecondType','secondtype_id');
    }
}
