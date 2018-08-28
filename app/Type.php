<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function goods()
    {
        return $this->hasMany('App\Good','type_id','id');
    }
}
