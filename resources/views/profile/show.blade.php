@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Profil > Show
			</div>
			<div class="panel-body">
				<dl class="dl-horizontal">
					<dt>Nama</dt>
					<dd>{{ $user->name }}</dd>
					<dt>E-mail</dt>
					<dd>{{ $user->email }}</dd>
					<dt>Updated</dt>
					<dd>{{ $user->updated_at->diffForHumans() }}</dd>
				</dl>
			</div>

			<div class="panel-footer">
				<div class="text-right">
					<a href="{{ route('profile.edit') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> Edit</a>
				</div>				
			</div>
		</div>
	</div>
@endsection