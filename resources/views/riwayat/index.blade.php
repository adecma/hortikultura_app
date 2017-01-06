@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Riwayat Konsultasi
			</div>
			<div class="panel-body">
				<p>
					<a href="{{ route('riwayat.topdf', time()) }}" class="btn btn-xs btn-warning"><i class="fa fa-print"></i> Cetak</a>
				</p>
				<div class="table-responsive">
					{!! $html->table() !!}
				</div>
			</div>
		</div>				
	</div>
@endsection

@push('js')
	{!! $html->scripts() !!}
@endpush