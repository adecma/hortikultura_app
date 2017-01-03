{!! Form::open(['url' => $form_url, 'method' => 'delete', 'class' => 'ask-delete']) !!}
	<div class="btn-group">
		<a href="{{ $edit_url }}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</a>

		<button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Hapus</button>
	</div>
{!! Form::close() !!}