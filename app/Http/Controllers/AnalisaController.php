<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hortikultura;
use App\Variable;
use App\Derajat;

use DB;
use PDF;

class AnalisaController extends Controller
{
    public function variable()
    {
    	$variables = Variable::join('derajats', 'variables.id', '=', 'derajats.variable_id')
    		->with('variable')->get();
   	
    	return view('analisa.variable', compact('variables'))->with(['no' => 1]);
    }

    public function toPDF($time)
    {
        $variables = Variable::join('derajats', 'variables.id', '=', 'derajats.variable_id')
    		->with('variable')->get();

        $no = 1;

        $pdf = PDF::loadView('analisa.toPDF',compact('variables', 'no'))
            ->setPaper('a4', 'potrait');
 
        return $pdf->stream('report_analisa-data-'.$time.'.pdf');
    }
}
