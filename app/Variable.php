<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class Variable extends Model
{
    public function derajat()
    {
    	return $this->hasOne('App\Derajat', 'variable_id');
    }

    public function hortikulturas()
    {
    	return $this->belongsToMany('App\Hortikultura', 'hortikultura_variable', 'variable_id', 'hortikultura_id')
    		->withPivot('id', 'nilai');
    }

    public function variable()
    {
    	return $this->hortikulturas()
    		->select(['hortikulturas.id', 
    			'hortikulturas.name', 
    			'var.name as namavariable', 
    			'hortikultura_variable.nilai', 
    			DB::raw("CASE WHEN hortikultura_variable.nilai <= var.rendah 
    							THEN 1
    						WHEN hortikultura_variable.nilai >= var.rendah AND hortikultura_variable.nilai <= var.sedang 
    							THEN (var.sedang - hortikultura_variable.nilai) / (var.sedang - var.rendah) 
    						ELSE 0 END as hit_rendah"), 
    			DB::raw("CASE WHEN hortikultura_variable.nilai <= var.rendah OR hortikultura_variable.nilai >= var.tinggi
    							THEN 0
    						WHEN hortikultura_variable.nilai >= var.rendah AND hortikultura_variable.nilai <= var.sedang 
    							THEN (hortikultura_variable.nilai - var.rendah) / (var.sedang - var.rendah)
    						ELSE (var.tinggi - hortikultura_variable.nilai) / (var.tinggi - var.rendah)
    						END as hit_sedang"), 
    			DB::raw("CASE WHEN hortikultura_variable.nilai <= var.sedang 
    							THEN 0
    						WHEN hortikultura_variable.nilai >= var.sedang AND hortikultura_variable.nilai <= var.tinggi 
    							THEN (hortikultura_variable.nilai - var.sedang) / (var.tinggi - var.sedang) 
    						ELSE 1 END as hit_tinggi"), ])
    		->join(DB::raw("(SELECT variables.id, variables.name, variables.created_at, variables.updated_at, derajats.rendah, derajats.sedang, derajats.tinggi FROM variables INNER JOIN derajats ON variables.id = derajats.variable_id) as var"), 'var.id', '=', 'hortikultura_variable.variable_id');
    }
}
