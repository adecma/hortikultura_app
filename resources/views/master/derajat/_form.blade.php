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

<div class="form-group {{ $errors->has('ket_rendah') ? 'has-error' : '' }}">
	{{ Form::label('ket_rendah', 'Keterangan Rendah') }}
	{{ Form::text('ket_rendah', null, ['class' => 'form-control', 'placeholder' => 'Nilai keterangan rendah', 'autocomplete' => 'off']) }}

	@if($errors->has('ket_rendah'))
		<span class="help-block">
			<strong>{{ $errors->first('ket_rendah') }}</strong>
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

<div class="form-group {{ $errors->has('ket_sedang') ? 'has-error' : '' }}">
	{{ Form::label('ket_sedang', 'Keterangan Sedang') }}
	{{ Form::text('ket_sedang', null, ['class' => 'form-control', 'placeholder' => 'Nilai keterangan sedang', 'autocomplete' => 'off']) }}

	@if($errors->has('ket_sedang'))
		<span class="help-block">
			<strong>{{ $errors->first('ket_sedang') }}</strong>
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

<div class="form-group {{ $errors->has('ket_tinggi') ? 'has-error' : '' }}">
	{{ Form::label('ket_tinggi', 'Keterangan Tinggi') }}
	{{ Form::text('ket_tinggi', null, ['class' => 'form-control', 'placeholder' => 'Nilai keterangan tinggi', 'autocomplete' => 'off']) }}

	@if($errors->has('ket_tinggi'))
		<span class="help-block">
			<strong>{{ $errors->first('ket_tinggi') }}</strong>
		</span>
	@endif
</div>