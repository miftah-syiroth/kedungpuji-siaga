<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
</head>
<body>
    <p>Laporan Kehamilan Desa Kedungpuji Berdasarkan HPHT Tahun {{ $year_hpht }} </p>
    <table border="1">
        <thead>
            <tr>
                <th rowspan="2">Bulan</th>
                <th rowspan="2">IBU HAMIL</th>
                <th colspan="2">IBU BERSALIN</th>
                <th rowspan="2">ABORTUS</th>
                <th colspan="2">BAYI LAHIR HIDUP</th>
                <th colspan="2">BAYI LAHIR MATI</th>
                <th rowspan="2"> -2kg</th>
                <th rowspan="2"> 2 - 2.4kg </th>
                <th rowspan="2">2.4 - 3.7kg</th>
                <th rowspan="2"> +3.7kg</th>
                <th colspan="2">BAYI NIFAS HIDUP</th>
                <th colspan="2">BAYI NIFAS MATI</th>
                <th rowspan="2">IBU NIFAS HIDUP</th>
                <th rowspan="2">IBU NIFAS MATI</th>
            </tr>
            <tr>
                <th>Hidup</th>
                <th>Mati</th>
                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>
                <th>L</th>
                <th>P</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Januari</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $januari['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $januari['ibu_bersalin']['mati'] }}</td>
                <td>{{ $januari['abortus'] }}</td>
                <td>{{ $januari['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $januari['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $januari['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $januari['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $januari['level_1'] }}</td>
                <td>{{ $januari['level_2'] }}</td>
                <td>{{ $januari['level_3'] }}</td>
                <td>{{ $januari['level_4'] }}</td>
                <td>{{ $januari['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $januari['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $januari['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $januari['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $januari['ibu_nifas_hidup'] }}</td>
                <td>{{ $januari['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>Februari</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $februari['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $februari['ibu_bersalin']['mati'] }}</td>
                <td>{{ $februari['abortus'] }}</td>
                <td>{{ $februari['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $februari['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $februari['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $februari['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $februari['level_1'] }}</td>
                <td>{{ $februari['level_2'] }}</td>
                <td>{{ $februari['level_3'] }}</td>
                <td>{{ $februari['level_4'] }}</td>
                <td>{{ $februari['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $februari['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $februari['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $februari['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $februari['ibu_nifas_hidup'] }}</td>
                <td>{{ $februari['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>Maret</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $maret['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $maret['ibu_bersalin']['mati'] }}</td>
                <td>{{ $maret['abortus'] }}</td>
                <td>{{ $maret['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $maret['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $maret['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $maret['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $maret['level_1'] }}</td>
                <td>{{ $maret['level_2'] }}</td>
                <td>{{ $maret['level_3'] }}</td>
                <td>{{ $maret['level_4'] }}</td>
                <td>{{ $maret['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $maret['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $maret['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $maret['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $maret['ibu_nifas_hidup'] }}</td>
                <td>{{ $maret['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>April</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $april['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $april['ibu_bersalin']['mati'] }}</td>
                <td>{{ $april['abortus'] }}</td>
                <td>{{ $april['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $april['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $april['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $april['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $april['level_1'] }}</td>
                <td>{{ $april['level_2'] }}</td>
                <td>{{ $april['level_3'] }}</td>
                <td>{{ $april['level_4'] }}</td>
                <td>{{ $april['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $april['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $april['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $april['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $april['ibu_nifas_hidup'] }}</td>
                <td>{{ $april['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>Mei</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $mei['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $mei['ibu_bersalin']['mati'] }}</td>
                <td>{{ $mei['abortus'] }}</td>
                <td>{{ $mei['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $mei['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $mei['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $mei['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $mei['level_1'] }}</td>
                <td>{{ $mei['level_2'] }}</td>
                <td>{{ $mei['level_3'] }}</td>
                <td>{{ $mei['level_4'] }}</td>
                <td>{{ $mei['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $mei['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $mei['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $mei['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $mei['ibu_nifas_hidup'] }}</td>
                <td>{{ $mei['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>Juni</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $juni['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $juni['ibu_bersalin']['mati'] }}</td>
                <td>{{ $juni['abortus'] }}</td>
                <td>{{ $juni['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $juni['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $juni['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $juni['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $juni['level_1'] }}</td>
                <td>{{ $juni['level_2'] }}</td>
                <td>{{ $juni['level_3'] }}</td>
                <td>{{ $juni['level_4'] }}</td>
                <td>{{ $juni['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $juni['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $juni['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $juni['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $juni['ibu_nifas_hidup'] }}</td>
                <td>{{ $juni['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>Juli</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $juli['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $juli['ibu_bersalin']['mati'] }}</td>
                <td>{{ $juli['abortus'] }}</td>
                <td>{{ $juli['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $juli['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $juli['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $juli['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $juli['level_1'] }}</td>
                <td>{{ $juli['level_2'] }}</td>
                <td>{{ $juli['level_3'] }}</td>
                <td>{{ $juli['level_4'] }}</td>
                <td>{{ $juli['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $juli['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $juli['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $juli['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $juli['ibu_nifas_hidup'] }}</td>
                <td>{{ $juli['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>Agustus</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $agustus['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $agustus['ibu_bersalin']['mati'] }}</td>
                <td>{{ $agustus['abortus'] }}</td>
                <td>{{ $agustus['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $agustus['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $agustus['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $agustus['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $agustus['level_1'] }}</td>
                <td>{{ $agustus['level_2'] }}</td>
                <td>{{ $agustus['level_3'] }}</td>
                <td>{{ $agustus['level_4'] }}</td>
                <td>{{ $agustus['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $agustus['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $agustus['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $agustus['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $agustus['ibu_nifas_hidup'] }}</td>
                <td>{{ $agustus['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>September</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $september['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $september['ibu_bersalin']['mati'] }}</td>
                <td>{{ $september['abortus'] }}</td>
                <td>{{ $september['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $september['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $september['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $september['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $september['level_1'] }}</td>
                <td>{{ $september['level_2'] }}</td>
                <td>{{ $september['level_3'] }}</td>
                <td>{{ $september['level_4'] }}</td>
                <td>{{ $september['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $september['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $september['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $september['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $september['ibu_nifas_hidup'] }}</td>
                <td>{{ $september['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>Oktober</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $oktober['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $oktober['ibu_bersalin']['mati'] }}</td>
                <td>{{ $oktober['abortus'] }}</td>
                <td>{{ $oktober['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $oktober['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $oktober['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $oktober['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $oktober['level_1'] }}</td>
                <td>{{ $oktober['level_2'] }}</td>
                <td>{{ $oktober['level_3'] }}</td>
                <td>{{ $oktober['level_4'] }}</td>
                <td>{{ $oktober['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $oktober['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $oktober['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $oktober['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $oktober['ibu_nifas_hidup'] }}</td>
                <td>{{ $oktober['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>November</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $november['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $november['ibu_bersalin']['mati'] }}</td>
                <td>{{ $november['abortus'] }}</td>
                <td>{{ $november['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $november['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $november['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $november['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $november['level_1'] }}</td>
                <td>{{ $november['level_2'] }}</td>
                <td>{{ $november['level_3'] }}</td>
                <td>{{ $november['level_4'] }}</td>
                <td>{{ $november['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $november['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $november['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $november['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $november['ibu_nifas_hidup'] }}</td>
                <td>{{ $november['ibu_nifas_mati'] }}</td>
            </tr>
            <tr>
                <td>Desember</td>
                <td>{{ $januari['ibu_hamil'] }}</td>
                <td>{{ $desember['ibu_bersalin']['hidup'] }}</td>
                <td>{{ $desember['ibu_bersalin']['mati'] }}</td>
                <td>{{ $desember['abortus'] }}</td>
                <td>{{ $desember['bayi_lahir_hidup']['l'] }}</td>
                <td>{{ $desember['bayi_lahir_hidup']['p'] }}</td>
                <td>{{ $desember['bayi_lahir_mati']['l'] }}</td>
                <td>{{ $desember['bayi_lahir_mati']['p'] }}</td>
                <td>{{ $desember['level_1'] }}</td>
                <td>{{ $desember['level_2'] }}</td>
                <td>{{ $desember['level_3'] }}</td>
                <td>{{ $desember['level_4'] }}</td>
                <td>{{ $desember['bayi_nifas_hidup']['l'] }}</td>
                <td>{{ $desember['bayi_nifas_hidup']['p'] }}</td>
                <td>{{ $desember['bayi_nifas_mati']['l'] }}</td>
                <td>{{ $desember['bayi_nifas_mati']['p'] }}</td>
                <td>{{ $desember['ibu_nifas_hidup'] }}</td>
                <td>{{ $desember['ibu_nifas_mati'] }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>