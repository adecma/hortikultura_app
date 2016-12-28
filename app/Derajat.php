<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Derajat extends Model
{
    public function variable()
    {
    	return $this->belongsTo('App\Variable', 'variable_id');
    }

    public function getVariableListAttribute()
    {
    	return $this->variable->id;
    }
}
