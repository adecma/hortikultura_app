@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Analisa Data Variable
			</div>
			<div class="panel-body">
				<p>
					<a href="{{ route('analisa.topdf', time()) }}" class="btn btn-xs btn-warning"><i class="fa fa-print"></i> Cetak</a>
				</p>
				<div class="panel-group" id="accordion">
				@foreach($variables as $var)
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $numA++ }}"><strong>{{ $var->name }}</strong></a>
							</div>
						</div>

						<div class="panel-collapse collapse" id="collapse{{ $numB++ }}">
							<div class="panel-body">
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
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
		</div>				
	</div>
@endsection