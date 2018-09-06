<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //与分类表存在一对多的关系
    public function type()
    {
        return $this->belongsTo('App\Type','type_id');
    }
    public function secondType()
    {
        return $this->belongsTo('App\SecondType','secondtype_id');
    }
    public function thirdType()
    {
        return $this->belongsTo('App\ThirdType','thirdtype_id');
    }
    public function table()
    {
        return $this->hasMany('App\GoodTable','good_id');
    }
}
