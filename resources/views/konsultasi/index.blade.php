@extends('layouts.app')

@section('content')
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-success">
			<div class="panel-heading">
				Konsultasi
			</div>
			{!! Form::open(['route' => ['konsultasi.result', md5(time())]]) !!}
				<div class="panel-body">
					<div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
						{{ Form::label('nama', 'Nama') }}
						{{ Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama lengkap', 'autocomplete' => 'off']) }}

						@if($errors->has('nama'))
							<span class="help-block">
								<strong>{{ $errors->first('nama') }}</strong>
							</span>
						@endif
					</div>
					
					<hr>

					<p class="text-center">Pilih Variable</p>

					@foreach($variables as $var)
						<div class="form-group {{ $errors->has('V-'.$var->id) ? ' has-error' : '' }}">
							<label>{{ $var->name }}</label> <br>
							<label class="radio-inline">
								{{ Form::radio('V-'.$var->id, 'rendah') }} Rendah
							</label>
							<label class="radio-inline">
								{{ Form::radio('V-'.$var->id, 'sedang') }} Sedang
							</label>
							<label class="radio-inline">
								{{ Form::radio('V-'.$var->id, 'tinggi') }} Tinggi
							</label>

							@if ($errors->has('V-'.$var->id))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('V-'.$var->id) }}</strong>
		                        </span>
		                    @endif
						</div>
					@endforeach
				</div>
				<div class="panel-footer">
					<button type="submit" class="btn btn-xs btn-primary"><i class="fa fa-save"></i> Proses</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endsection