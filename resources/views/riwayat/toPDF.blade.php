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
                        <center><h3>Laporan Riwayat Konsultasi</h3></center>
                    </div>
                    
                    <div class="">
                            <table class="tg">
                                <thead>
                                    <tr>
                                        <th class="tg-3wr7" width="3%">No</th>
                                        <th class="tg-3wr7" colspan="3" width="97%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayats as $r)
                                        @php
                                            $variable = unserialize($r->variable);
                                            $rekomendasi = unserialize($r->rekomendasi);
                                        @endphp
                                        <tr>
                                            <td class="tg-ti5e" width="3%">{{ $no++ }}</td> 
                                            <td class="tg-rv4w" width="5%">Nama</td>
                                            <td class="tg-rv4w" width="92%" colspan="2">{{ $r->name}}</td>                   
                                        </tr>
                                        <tr>
                                            <td class="tg-ti5e" width="3%"></td>
                                            <td class="tg-rv4w" width="5%">Tanggal</td>
                                            <td class="tg-rv4w" width="92%" colspan="2">
                                                @php
                                                    if ($r->created_at->format('n') == 1) {
                                                        $bulan = 'Januari';
                                                    }elseif ($r->created_at->format('n') == 2) {
                                                        $bulan = 'Februari';
                                                    }elseif ($r->created_at->format('n') == 3) {
                                                        $bulan = 'Maret';
                                                    }elseif ($r->created_at->format('n') == 4) {
                                                        $bulan = 'April';
                                                    }elseif ($r->created_at->format('n') == 5) {
                                                        $bulan = 'Mei';
                                                    }elseif ($r->created_at->format('n') == 6) {
                                                        $bulan = 'Juni';
                                                    }elseif ($r->created_at->format('n') == 7) {
                                                        $bulan = 'Juli';
                                                    }elseif ($r->created_at->format('n') == 8) {
                                                        $bulan = 'Agustus';
                                                    }elseif ($r->created_at->format('n') == 9) {
                                                        $bulan = 'September';
                                                    }elseif ($r->created_at->format('n') == 10) {
                                                        $bulan = 'Oktober';
                                                    }elseif ($r->created_at->format('n') == 11) {
                                                        $bulan = 'November';
                                                    }else{
                                                        $bulan = 'Desember';
                                                    }
                                                @endphp
                                                
                                                {{ $r->created_at->format('d').' '.$bulan.' '.$r->created_at->format('Y') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="tg-ti5e" width="3%"></td>
                                            <td class="tg-rv4w" width="5%"></td>
                                            <td class="tg-rv4w" width="46%">
                                                <center><strong>Variabel Yang Dipilih</strong></center>
                                                <ul>
                                                    @foreach($variable as $var)
                                                        <li>{{ $var['nameVar'] }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="tg-rv4w" width="46%">
                                                <center><strong>Hasil Rekomendasi</strong></center>
                                                <ul>
                                                    @foreach($rekomendasi as $rekom)
                                                        @if($rekom['strength'] != 0)
                                                            <li>{{ $rekom['nameHorti'] }} ({{ $rekom['strength'] }})</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
