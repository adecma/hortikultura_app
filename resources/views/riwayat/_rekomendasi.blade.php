<ul class="list-inline">
	@foreach($rekomendasi as $rekom)
		@if($rekom['strength'] != 0)
			<li>{{ $rekom['nameHorti'] }} ({{ $rekom['strength'] }})</li>
		@endif
	@endforeach
</ul>