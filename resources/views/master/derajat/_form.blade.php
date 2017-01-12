<div class="form-group {{ $errors->has('variable') ? 'has-error' : '' }}">
	{{ Form::label('variable', 'variable') }}
	{{ Form::select('variable_list', $variables, null, ['id' => 'variable', 'class' => 'form-control', 'placeholder' => 'Pilih variable']) }}

	@if($errors->has('variable'))
		<span class="help-block">
			<strong>{{ $errors->first('variable') }}</strong>
		</span>
	@endif
</div>

<div class="form-group {{ $errors->has('rendah') ? 'has-error' : '' }}">
	{{ Form::label('rendah', 'Rendah') }}
	{{ Form::text('rendah', null, ['class' => 'form-control', 'placeholder' => 'Nilai rendah', 'autocomplete' => 'off']) }}

	@if($errors->has('rendah'))
		<span class="help-block">
			<strong>{{ $errors->first('rendah') }}</strong>
		</span>
	@endif
</div>

<div class="form-group {{ $errors->has('sedang') ? 'has-error' : '' }}">
	{{ Form::label('sedang', 'Sedang') }}
	{{ Form::text('sedang', null, ['class' => 'form-control', 'placeholder' => 'Nilai sedang', 'autocomplete' => 'off']) }}

	@if($errors->has('sedang'))
		<span class="help-block">
			<strong>{{ $errors->first('sedang') }}</strong>
		</span>
	@endif
</div>

<div class="form-group {{ $errors->has('tinggi') ? 'has-error' : '' }}">
	{{ Form::label('tinggi', 'Tinggi') }}
	{{ Form::text('tinggi', null, ['class' => 'form-control', 'placeholder' => 'Nilai tinggi', 'autocomplete' => 'off']) }}

	@if($errors->has('tinggi'))
		<span class="help-block">
			<strong>{{ $errors->first('tinggi') }}</strong>
		</span>
	@endif
</div>