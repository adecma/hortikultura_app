@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Analisa Data Variable
			</div>
			<div class="panel-body">
				<p>
					<a href="{{ route('analisa.topdf', time()) }}" class="btn btn-xs btn-warning"><i class="fa fa-print"></i> Print</a>
				</p>
				<ol type="A">
				@foreach($variables as $var)
					<li>
						<strong>{{ $var->name }}</strong>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanaman Hortikultura</th>
										<th>{{ $var->name }}</th>
										<th>Rendah</th>
										<th>Sedang</th>
										<th>Tinggi</th>
									</tr>
								</thead>

								<tbody>
									@foreach($var->variable as $horti)
										<tr>
											<td width="5%">{{ $no++ }}</td>
											<td width="30%">{{ $horti->name }}</td>
											<td width="20%">{{ $horti->pivot->nilai }}</td>
											<td>{{ round($horti->hit_rendah,2) }}</td>
											<td>{{ round($horti->hit_sedang,2) }}</td>
											<td>{{ round($horti->hit_tinggi,2) }}</td>
										</tr>

										@if($loop->last)
											@php
												$no = 1
											@endphp
										@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</li>
				@endforeach
				</ol>
			</div>
		</div>				
	</div>
@endsection