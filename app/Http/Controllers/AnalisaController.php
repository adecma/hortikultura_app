<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hortikultura;
use App\Variable;
use App\Derajat;
use App\Riwayat;

use DB;
use PDF;

class AnalisaController extends Controller
{
    public function variable()
    {
    	$variables = Variable::join('derajats', 'variables.id', '=', 'derajats.variable_id')
    		->with('variable')->get();
   	
    	return view('analisa.variable', compact('variables'))->with(['no' => 1, 'numA' => 1, 'numB' => 1]);
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

    public function konsultasi()
    {
        $variables = Variable::all();
        return view('konsultasi.index', compact('variables'));
    }

    public function result(Request $request, $tag)
    {
        $variables = Variable::all();

        foreach ($variables as $var) {
            $rules['V-'.$var->id] = 'required';

            $selectVar[$var->id]['nameVar'] = $var->name.' '.$request->input('V-'.$var->id);
        }

        $nama = $request->input('nama');

        $rules['nama'] = 'required';

        $this->validate($request, $rules);

        $hortikulturas = Hortikultura::with(['variables' => function($v){
                $v->with('derajat');
            }])
            ->get();

        $result = collect([]);

        foreach ($hortikulturas as $key1 => $value1) {
            for ($i=0; $i < count($value1->variables); $i++) { 
                $set2[$i]['idVar'] = $value1->variables[$i]->id;
                $set2[$i]['nameVar'] = $value1->variables[$i]->name;
                $set2[$i]['nilai'] = $value1->variables[$i]->pivot->nilai;
                $set2[$i]['rendah'] = $value1->variables[$i]->derajat->rendah;
                $set2[$i]['sedang'] = $value1->variables[$i]->derajat->sedang;
                $set2[$i]['tinggi'] = $value1->variables[$i]->derajat->tinggi;

                if($request->input('V-'.$variables[$i]->id) == 'rendah'){
                    if ($value1->variables[$i]->pivot->nilai <= $value1->variables[$i]->derajat->rendah) {
                        $set2[$i]['hitNilai'] = 1;
                        $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }elseif ($value1->variables[$i]->pivot->nilai >= $value1->variables[$i]->derajat->rendah AND $value1->variables[$i]->pivot->nilai <= $value1->variables[$i]->derajat->sedang) {
                        $set2[$i]['hitNilai'] = ($value1->variables[$i]->derajat->sedang - $value1->variables[$i]->pivot->nilai)/($value1->variables[$i]->derajat->sedang - $value1->variables[$i]->derajat->rendah);
                        $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }else{
                       $set2[$i]['hitNilai'] = 0; 
                       $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }                 
                }elseif($request->input('V-'.$variables[$i]->id) == 'sedang'){
                    if ($value1->variables[$i]->pivot->nilai <= $value1->variables[$i]->derajat->rendah OR $value1->variables[$i]->pivot->nilai >= $value1->variables[$i]->derajat->tinggi) {
                        $set2[$i]['hitNilai'] = 0;
                        $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }elseif ($value1->variables[$i]->pivot->nilai >= $value1->variables[$i]->derajat->rendah AND $value1->variables[$i]->pivot->nilai <= $value1->variables[$i]->derajat->sedang) {
                        $set2[$i]['hitNilai'] = ($value1->variables[$i]->pivot->nilai - $value1->variables[$i]->derajat->rendah)/($value1->variables[$i]->derajat->sedang - $value1->variables[$i]->derajat->rendah);
                        $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }else{
                       $set2[$i]['hitNilai'] = ($value1->variables[$i]->derajat->tinggi - $value1->variables[$i]->pivot->nilai)/($value1->variables[$i]->derajat->tinggi - $value1->variables[$i]->derajat->sedang); 
                       $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }
                }else{
                    if ($value1->variables[$i]->pivot->nilai <= $value1->variables[$i]->derajat->sedang) {
                        $set2[$i]['hitNilai'] = 0;
                        $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }elseif ($value1->variables[$i]->pivot->nilai >= $value1->variables[$i]->derajat->sedang AND $value1->variables[$i]->pivot->nilai <= $value1->variables[$i]->derajat->tinggi) {
                        $set2[$i]['hitNilai'] = ($value1->variables[$i]->pivot->nilai - $value1->variables[$i]->derajat->sedang)/($value1->variables[$i]->derajat->tinggi - $value1->variables[$i]->derajat->sedang);
                        $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }else{
                       $set2[$i]['hitNilai'] = 1; 
                       $set2[$i]['jenis'] = $request->input('V-'.$variables[$i]->id);
                    }
                }
            }

            for ($i=1; $i < count($value1->variables); $i++) { 
                $interseksi['X'.$set2[0]['idVar'].'-X'.$set2[$i]['idVar']] = min($set2[0]['hitNilai'], $set2[$i]['hitNilai']);
            }

            $result->push([
                    'id' => $value1->id,
                    'nameHorti' => $value1->name,
                    'variable' => $set2,
                    'interseksi' => $interseksi,
                    'strength' => max($interseksi),
                ]);
        }

        $resultSortDesc = $result->sortByDesc('strength')->values()->toArray();

        $riwayat = Riwayat::where('tag', '=', $tag)->first();

        if (!count($riwayat)) {
            $riwayat = new Riwayat;
            $riwayat->name = $nama;
            $riwayat->variable = serialize($selectVar);
            $riwayat->rekomendasi = serialize($resultSortDesc);
            $riwayat->tag = $tag;
            $riwayat->save();
        }        
        
        $no = 1;

        //dd($result);

        return view('konsultasi.result', compact('resultSortDesc', 'no', 'nama', 'selectVar', 'riwayat'));
    }

    public function resultToPDF($id)
    {
        $riwayat = Riwayat::findOrFail($id);

        $no = 1;

        $pdf = PDF::loadView('konsultasi.toPDF',compact('riwayat', 'no'))
            ->setPaper('a4', 'potrait');
 
        return $pdf->stream('report_konsultasi-'.$id.'.pdf');

        //return view('konsultasi.toPDF',compact('riwayat', 'no'));
    }
}
