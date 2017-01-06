@extends('layouts.app')

@section('content')
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-success">
			<div class="panel-heading">
				Konsultasi > Hasil
			</div>

			<div class="panel-body">
				<p>
					<a href="{{ route('konsultasi.index') }}" class="btn btn-xs btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
					<a href="{{ route('konsultasi.topdf', $riwayat->id) }}" class="btn btn-xs btn-warning"><i class="fa fa-print"></i> Cetak</a>
				</p>
				<h4>Detail</h4>
				<dl class="dl-horizontal">
					<dt>Nama</dt>
					<dd>{{ $nama }}</dd>
					<dt>Variable yang dipilih</dt>
					<dd>
						<ul class="list-inline">
							@foreach($selectVar as $var)
								<li>{{ $var['nameVar'] }}</li>
							@endforeach
						</ul>
					</dd>
				</dl>

				<h4>Hasil Rekomendasi</h4>

				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Hortikultura</th>
								<th>Nilai</th>
							</tr>
						</thead>
						<tbody>
							@foreach($resultSortDesc as $horti)
								@if($horti['strength'] != 0)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $horti['nameHorti'] }}</td>
										<td>{{ $horti['strength'] }}</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection