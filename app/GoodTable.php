<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodTable extends Model
{
    //
    public function good()
    {
        return $this->belongsTo('App\Good','good_id');
    }
}
