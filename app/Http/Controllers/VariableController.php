<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variable;

use Yajra\Datatables\Html\Builder;
use Datatables;
use DB;

use PDF;

class VariableController extends Controller
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

            $variables = Variable::select([DB::raw('@nomor := @nomor+1 as nomor'), 'id', 'name', 'updated_at']);

            $dataVariables = Datatables::of($variables)
                ->addColumn('action', function($variables){
                    return view('master.variable._aksi', [
                        'form_url' => route('variable.destroy', $variables->id),
                        'edit_url' => route('variable.edit', $variables->id),
                    ]);
                })
                ->editColumn('updated_at', function($variables){
                    return $variables->updated_at->diffForHumans();
                });

            if ($keyword = $request->get('search')['value']) {
                $dataVariables->filterColumn('nomor', 'whereRaw', '@nomor + 1 like ?', ["%{$keyword}%"]);
            }

            return $dataVariables->make(true);
        }

        $html = $htmlBuilder
            ->addcolumn(['data' => 'nomor', 'name' => 'nomor', 'title' => 'No.'])
            ->addcolumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
            ->addcolumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated'])
            ->addcolumn(['data' => 'action', 'name' => 'action', 'title' => 'action', 'orderable' => false, 'searchable' => false]);

        return view('master.variable.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.variable.create');
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

        $variable = new Variable;
        $variable->name = $request->input('name');
        $variable->save(); 

        flash()->success('Variable  '.$request->input('name').' tersimpan');

        return redirect()->route('variable.index');
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
        $variable = Variable::findOrFail($id);

        return view('master.variable.edit', compact('variable'));
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
        $variable = Variable::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);
        
        $variable->name = $request->input('name');
        $variable->save();

        flash()->success('Variable  '.$request->input('name').' diperbaharui');

        return redirect()->route('variable.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $variable = Variable::findOrFail($id);

        $variable->delete();

        flash()->success('Variable  '.$variable->name.' telah di hapus');

        return redirect()->route('variable.index');
    }

    public function toPDF($time)
    {
        $variables = Variable::orderBy('name', 'asc')->get();

        $no = 1;

        $pdf = PDF::loadView('master.variable.toPDF',compact('variables', 'no'))
            ->setPaper('a4', 'potrait');
 
        return $pdf->stream('report_variable-'.$time.'.pdf');
    }
}
