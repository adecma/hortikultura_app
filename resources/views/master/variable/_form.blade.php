<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
	{{ Form::label('name', 'Nama') }}
	{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama variabel', 'autocomplete' => 'off']) }}

	@if($errors->has('name'))
		<span class="help-block">
			<strong>{{ $errors->first('name') }}</strong>
		</span>
	@endif
</div>