<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
        .tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
        .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
        .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
        .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
        .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div style="font-family:Arial; font-size:12px;">
                        <center><h3>Laporan Analisa Data</h3></center>
                    </div>
                    
                    <ol type="A">
                    @foreach($variables as $var)
                        <li>
                        <strong>{{ $var->name }}</strong>
                            <br><br>
                            <table class="tg">
                                <thead>
                                    <tr>
                                        <th class="tg-3wr7">No</th>
                                        <th class="tg-3wr7">Tanaman Hortikultura</th>
                                        <th class="tg-3wr7">{{ $var->name }}</th>
                                        <th class="tg-3wr7">Rendah</th>
                                        <th class="tg-3wr7">Sedang</th>
                                        <th class="tg-3wr7">Tinggi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($var->variable as $horti)
                                        <tr>
                                            <td class="tg-rv4w" width="10%">{{ $no++ }}</td>
                                            <td class="tg-rv4w" width="30%">{{ $horti->name }}</td>
                                            <td class="tg-ti5e" width="20%">{{ $horti->pivot->nilai }}</td>
                                            <td class="tg-ti5e" width="20%">{{ round($horti->hit_rendah,2) }}</td>
                                            <td class="tg-ti5e" width="20%">{{ round($horti->hit_sedang,2) }}</td>
                                            <td class="tg-ti5e" width="20%">{{ round($horti->hit_tinggi,2) }}</td>
                                        </tr>

                                        @if($loop->last)
                                            @php
                                                $no = 1
                                            @endphp
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <br><br>
                        </li>
                    @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
