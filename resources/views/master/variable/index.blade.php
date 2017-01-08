@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Master Variabel
			</div>
			<div class="panel-body">
				<p>
					<a href="{{ route('variable.topdf', time()) }}" class="btn btn-xs btn-warning"><i class="fa fa-print"></i> Cetak</a>
					<a href="{{ route('variable.create') }}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Tambah</a>
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