<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Html\Builder;
use Datatables;
use DB;
use PDF;

use App\Riwayat;

class RiwayatController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw('set @nomor = 0'));

            $riwayats = Riwayat::select([DB::raw('@nomor := @nomor+1 as nomor'), 'id', 'name', 'variable', 'rekomendasi', 'created_at']);

            $dataRiwayats = Datatables::of($riwayats)
            	->editColumn('variable', function($riwayats){
            		$variable = unserialize($riwayats->variable);

            		return view('riwayat._variable', compact('variable'));
            	})
            	->editColumn('rekomendasi', function($riwayats){
            		$rekomendasi = unserialize($riwayats->rekomendasi);
            		
            		return view('riwayat._rekomendasi', compact('rekomendasi'));
            	})
            	->editColumn('created_at', function($riwayats){
            		if ($riwayats->created_at->format('n') == 1) {
                        $bulan = 'Januari';
                    }elseif ($riwayats->created_at->format('n') == 2) {
                        $bulan = 'Februari';
                    }elseif ($riwayats->created_at->format('n') == 3) {
                        $bulan = 'Maret';
                    }elseif ($riwayats->created_at->format('n') == 4) {
                        $bulan = 'April';
                    }elseif ($riwayats->created_at->format('n') == 5) {
                        $bulan = 'Mei';
                    }elseif ($riwayats->created_at->format('n') == 6) {
                        $bulan = 'Juni';
                    }elseif ($riwayats->created_at->format('n') == 7) {
                        $bulan = 'Juli';
                    }elseif ($riwayats->created_at->format('n') == 8) {
                        $bulan = 'Agustus';
                    }elseif ($riwayats->created_at->format('n') == 9) {
                        $bulan = 'September';
                    }elseif ($riwayats->created_at->format('n') == 10) {
                        $bulan = 'Oktober';
                    }elseif ($riwayats->created_at->format('n') == 11) {
                        $bulan = 'November';
                    }else{
                        $bulan = 'Desember';
                    }
                    
            		return $riwayats->created_at->format('d').' '.$bulan.' '.$riwayats->created_at->format('Y');
            	})
                ->addColumn('action', function($riwayats){
                    return view('riwayat._aksi', [
                        'form_url' => route('riwayat.destroy', $riwayats->id),
                    ]);
                });

            if ($keyword = $request->get('search')['value']) {
                $dataRiwayats->filterColumn('nomor', 'whereRaw', '@nomor + 1 like ?', ["%{$keyword}%"]);
            }

            return $dataRiwayats->make(true);
        }

        $html = $htmlBuilder
            ->addcolumn(['data' => 'nomor', 'name' => 'nomor', 'title' => 'No.'])
            ->addcolumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
            ->addcolumn(['data' => 'variable', 'name' => 'variable', 'title' => 'Variabel dipilih', 'orderable' => false, 'searchable' => false])
            ->addcolumn(['data' => 'rekomendasi', 'name' => 'rekomendasi', 'title' => 'Rekomendasi', 'orderable' => false, 'searchable' => false])
            ->addcolumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Tanggal', 'searchable' => false])
            ->addcolumn(['data' => 'action', 'name' => 'action', 'title' => 'Aksi', 'orderable' => false, 'searchable' => false]);

        return view('riwayat.index', compact('html'));
    }

    public function destroy($id)
    {
    	$riwayat = Riwayat::findOrFail($id);

        $riwayat->delete();

        flash()->success('Riwayat konsultasi dari '.$riwayat->name.' telah di hapus');

        return redirect()->route('riwayat.index');
    }

    public function toPDF($time)
    {
        $riwayats = Riwayat::orderBy('created_at', 'desc')->get();

        $no = 1;

        $pdf = PDF::loadView('riwayat.toPDF',compact('riwayats', 'no'))
            ->setPaper('a4', 'potrait');
 
        return $pdf->stream('report_riwayat-'.$time.'.pdf');
        //return view('riwayat.toPDF',compact('riwayats', 'no'));
    }
}
