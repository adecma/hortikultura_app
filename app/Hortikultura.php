<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hortikultura extends Model
{
    public function variables()
    {
    	return $this->belongsToMany('App\Variable', 'hortikultura_variable', 'hortikultura_id', 'variable_id')
    		->withPivot('id', 'nilai');
    }
}
