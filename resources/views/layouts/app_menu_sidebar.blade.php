<div class="list-group">
    <a href="#" class="list-group-item disabled"><strong>Menu Master</strong></a>
    <a href="{{ route('hortikultura.index') }}" class="list-group-item {!! substr(Route::currentRouteName(), 0, 12) == 'hortikultura' ? 'active' : '' !!}">Hortikultura</a>
    <a href="{{ route('variable.index') }}" class="list-group-item {!! substr(Route::currentRouteName(), 0, 8) == 'variable' ? 'active' : '' !!}">Variable</a>
    <a href="{{ route('derajat.index') }}" class="list-group-item {!! substr(Route::currentRouteName(), 0, 7) == 'derajat' ? 'active' : '' !!}">Derajat</a>
</div>

<div class="list-group">
    <a href="#" class="list-group-item disabled"><strong>Menu Lainnya</strong></a>
    <a href="{{ route('analisa.variable') }}" class="list-group-item {!! substr(Route::currentRouteName(), 0, 16) == 'analisa.variable' ? 'active' : '' !!}">Analisa Data</a>
    <a href="#" class="list-group-item">Histori Konsultasi</a>
</div>