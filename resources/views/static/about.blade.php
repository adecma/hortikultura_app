@extends('layouts.app')

@section('content')
	<div class="panel panel-success">
		<div class="panel-body">
			<h3>About</h3>
			<p class="text-justify">
				Mekanisme dalam pemberian rekomendasi jenis tanaman sayur hortikultura yang cocok untuk ditaman pada lahan yang dimiliki petani sebagai berikut : <br>
				Pelaku pertanian dapat melihat rekomendasi jenis tanaman sayur hortikultura yang cocok ditanam pada lahan yang dimiliki dengan memasukan nilai ketinggian tanah, curah hujan, suhu udara, kapasitas tukar kation tanah, kejenuhan basa dan ph tanah pada lahan yang dimiliki pelaku pertanian pada berada konsultasi setelah itu maka akan diproses oleh sistem dan akan muncul jenis rekomendasi tanaman sayur hortikultura yang paling cocok ditanami pada lahan tersebut sampai tanaman yang kurang cocok ditanaman pada lahan tersebut. Data ketinggian tanah dapat diperoleh dengan menggunkan mapcoordinates, data curah hujan dan suhu udara dapat diperoleh dari BMKG (Badan Meteorologi, Klimatologi dan Geofisika), sedangkan kapsitas tukar kation, kejenuhan basa dan ph tanah dapat dicek pada laboratorium tanah.
			</p>
		</div>
	</div>
@endsection