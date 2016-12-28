<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hortikultura;

use Yajra\Datatables\Html\Builder;
use Datatables;
use DB;

use PDF;

class HortikulturaController extends Controller
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

            $hortikulturas = Hortikultura::select([DB::raw('@nomor := @nomor+1 as nomor'), 'id', 'name', 'updated_at']);

            $dataHortikulturas = Datatables::of($hortikulturas)
                ->addColumn('action', function($hortikulturas){
                    return view('master.hortikultura._aksi', [
                        'form_url' => route('hortikultura.destroy', $hortikulturas->id),
                        'edit_url' => route('hortikultura.edit', $hortikulturas->id),
                    ]);
                })
                ->editColumn('updated_at', function($hortikulturas){
                    return $hortikulturas->updated_at->diffForHumans();
                });

            if ($keyword = $request->get('search')['value']) {
                $dataHortikulturas->filterColumn('nomor', 'whereRaw', '@nomor + 1 like ?', ["%{$keyword}%"]);
            }

            return $dataHortikulturas->make(true);
        }

        $html = $htmlBuilder
            ->addcolumn(['data' => 'nomor', 'name' => 'nomor', 'title' => 'No.'])
            ->addcolumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
            ->addcolumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated'])
            ->addcolumn(['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false]);

        return view('master.hortikultura.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.hortikultura.create');
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
            'name' => 'required',
        ]);

        $hortikultura = new Hortikultura;
        $hortikultura->name = $request->input('name');
        $hortikultura->save(); 

        flash()->success('Tanaman hortikultura '.$request->input('name').' tersimpan');

        return redirect()->route('hortikultura.index');
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
        $hortikultura = Hortikultura::findOrFail($id);

        return view('master.hortikultura.edit', compact('hortikultura'));
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
        $hortikultura = Hortikultura::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $hortikultura->name = $request->input('name');
        $hortikultura->save();

        flash()->success('Tanaman hortikultura '.$request->input('name').' diperbaharui');

        return redirect()->route('hortikultura.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hortikultura = Hortikultura::findOrFail($id);

        $hortikultura->delete();

        flash()->success('Tanaman hortikultura '.$hortikultura->name.' telah di hapus');

        return redirect()->route('hortikultura.index');
    }

    public function toPDF($time)
    {
        $hortikulturas = Hortikultura::orderBy('name', 'asc')->get();

        $no = 1;

        $pdf = PDF::loadView('master.hortikultura.toPDF',compact('hortikulturas', 'no'))
            ->setPaper('a4', 'potrait');
 
        return $pdf->stream('report_hortikultura-'.$time.'.pdf');
    }
}
