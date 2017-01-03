@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-plus"></i> Master Variable > Tambah</div>
			
			{!! Form::open(['route' => 'variable.store']) !!}
				<div class="panel-body">
					@include('master.variable._form')
				</div>
				
				<div class="panel-footer">
					<a href="{{ route('variable.index') }}" class="btn btn-default btn-xs"><i class="fa fa-arrow-left"></i> Batal</a>

					<div class="pull-right">
						<button class="btn btn-xs btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection