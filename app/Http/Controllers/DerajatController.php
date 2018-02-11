<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Derajat;
use App\Variable;

use Yajra\Datatables\Html\Builder;
use Datatables;
use DB;

use PDF;

class DerajatController extends Controller
{
    
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @nomor = 0'));

            $derajats = Derajat::select([DB::raw('@nomor := @nomor+1 as nomor'), 'derajats.id', 'derajats.rendah', 'derajats.sedang', 'derajats.tinggi', 'derajats.updated_at', 'variables.name as variable'])
                ->join('variables', 'derajats.variable_id', '=', 'variables.id');

            $dataderajats = Datatables::of($derajats)
                ->addColumn('action', function($derajats){
                    return view('master.derajat._aksi', [
                        'form_url' => route('derajat.destroy', $derajats->id),
                        'edit_url' => route('derajat.edit', $derajats->id),
                    ]);
                });

            if ($keyword = $request->get('search')['value']) {
                $dataderajats->filterColumn('nomor', 'whereRaw', '@nomor + 1 like ?', ["%{$keyword}%"]);
            }

            return $dataderajats->make(true);
        }

        $html = $htmlBuilder
            ->addcolumn(['data' => 'nomor', 'name' => 'nomor', 'title' => 'No.', 'searchable' => false])
            ->addcolumn(['data' => 'variable', 'name' => 'variables.name', 'title' => 'Variable'])
            ->addcolumn(['data' => 'rendah', 'name' => 'rendah', 'title' => 'Rendah'])
            ->addcolumn(['data' => 'sedang', 'name' => 'sedang', 'title' => 'Sedang'])
            ->addcolumn(['data' => 'tinggi', 'name' => 'tinggi', 'title' => 'Tinggi'])
            ->addcolumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false]);

        return view('master.derajat.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$variables = Variable::orderBy('name', 'asc')->pluck('name', 'id');

        return view('master.derajat.create', compact('variables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rendah' => 'required|min:1|max:7',
            'ket_rendah' => 'required|min:1|max:150',
            'sedang' => 'required|min:1|max:7',
            'ket_sedang' => 'required|min:1|max:150',
            'tinggi' => 'required|min:1|max:7',
            'ket_tinggi' => 'required|min:1|max:150',
            'variable_list' => 'required|numeric|exists:variables,id'
        ]);

        $derajat = new Derajat;
        $derajat->rendah = $request->input('rendah');
        $derajat->ket_rendah = $request->input('ket_rendah');
        $derajat->sedang = $request->input('sedang');
        $derajat->ket_sedang = $request->input('ket_sedang');
        $derajat->tinggi = $request->input('tinggi');
        $derajat->ket_tinggi = $request->input('ket_tinggi');
        $derajat->variable_id = $request->input('variable_list');
        $derajat->save(); 

        flash()->success('Derajat tersimpan');

        return redirect()->route('derajat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $derajat = Derajat::findOrFail($id);

        $variables = Variable::orderBy('name', 'asc')->pluck('name', 'id');

        return view('master.derajat.edit', compact('derajat', 'variables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $derajat = Derajat::findOrFail($id);

        $this->validate($request, [
            'rendah' => 'required|min:1|max:7',
            'ket_rendah' => 'required|min:1|max:150',
            'sedang' => 'required|min:1|max:7',
            'ket_sedang' => 'required|min:1|max:150',
            'tinggi' => 'required|min:1|max:7',
            'ket_tinggi' => 'required|min:1|max:150',
            'variable_list' => 'required|numeric|exists:variables,id'
        ]);
        
        $derajat->rendah = $request->input('rendah');
        $derajat->ket_rendah = $request->input('ket_rendah');
        $derajat->sedang = $request->input('sedang');
        $derajat->ket_sedang = $request->input('ket_sedang');
        $derajat->tinggi = $request->input('tinggi');
        $derajat->ket_tinggi = $request->input('ket_tinggi');
        $derajat->variable_id = $request->input('variable_list');
        $derajat->save();

        flash()->success('Derajat diperbaharui');

        return redirect()->route('derajat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $derajat = Derajat::findOrFail($id);

        $derajat->delete();

        flash()->success('Derajat telah di hapus');

        return redirect()->route('derajat.index');
    }

    public function toPDF($time)
    {
        $derajats = Derajat::select(['derajats.id', 'derajats.rendah', 'derajats.sedang', 'derajats.tinggi', 'derajats.updated_at', 'variables.name as namavariable'])
                ->join('variables', 'derajats.variable_id', '=', 'variables.id')
                ->orderBy('namavariable', 'asc')->get();

        $no = 1;

        $pdf = PDF::loadView('master.derajat.toPDF',compact('derajats', 'no'))
            ->setPaper('a4', 'potrait');
 
        return $pdf->stream('report_derajat-'.$time.'.pdf');
    }
}
