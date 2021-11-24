<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Laporan keluarga Berencana RW {{ $rw }}, {{ $periode->isoFormat('MMMM YYYY') }}</p>
    <table border="1">
        <thead>
            <tr>
                <th rowspan="3">RT</th>
                <th rowspan="3">JUMLAH PUS</th>
                <th colspan="14">PESERTA KB</th>
                <th rowspan="2" colspan="2">JUMLAH PUS KB</th>
                <th rowspan="2" colspan="4">PESERTA BUKAN KB</th>
                <th rowspan="3">JUMLAH PUS NON KB</th>
                <th rowspan="2" colspan="2">TAHAPAN KS</th>
            </tr>
            <tr>
                <th colspan="2">IUD</th>
                <th colspan="2">MOW</th>
                <th colspan="2">MOP</th>
                <th colspan="2">KOND</th>
                <th colspan="2">IMP</th>
                <th colspan="2">SUNTIK</th>
                <th colspan="2">PIL</th>
            </tr>
            <tr>
                <th>P</th>
                <th>S</th>
                <th>P</th>
                <th>S</th>
                <th>P</th>
                <th>S</th>
                <th>P</th>
                <th>S</th>
                <th>P</th>
                <th>S</th>
                <th>P</th>
                <th>S</th>
                <th>P</th>
                <th>S</th>
                <th>P</th>
                <th>S</th>
                <th>H</th>
                <th>IAS</th>
                <th>IAT</th>
                <th>TIAL</th>
                <th>Seluruh KS</th>
                <th>KPS dan KS 1</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_rt as $key => $rt)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $rt['jumlah_pus'] }}</td>
                <td>{{ $rt['iud']['p'] }}</td>
                <td>{{ $rt['iud']['s'] }}</td>
                <td>{{ $rt['mow']['p'] }}</td>
                <td>{{ $rt['mow']['s'] }}</td>
                <td>{{ $rt['mop']['p'] }}</td>
                <td>{{ $rt['mop']['s'] }}</td>
                <td>{{ $rt['kond']['p'] }}</td>
                <td>{{ $rt['kond']['s'] }}</td>
                <td>{{ $rt['imp']['p'] }}</td>
                <td>{{ $rt['imp']['s'] }}</td>
                <td>{{ $rt['suntik']['p'] }}</td>
                <td>{{ $rt['suntik']['s'] }}</td>
                <td>{{ $rt['pil']['p'] }}</td>
                <td>{{ $rt['pil']['s'] }}</td>
                <td>{{ $rt['total_pus_kb']['p'] }}</td>
                <td>{{ $rt['total_pus_kb']['s'] }}</td>
                <td>{{ $rt['non_kb']['h'] }}</td>
                <td>{{ $rt['non_kb']['ias'] }}</td>
                <td>{{ $rt['non_kb']['iat'] }}</td>
                <td>{{ $rt['non_kb']['tial'] }}</td>
                <td>{{ $rt['total_pus_non_kb'] }}</td>
                <td>{{ $rt['tahapan_ks']['seluruh_ks'] }}</td>
                <td>{{ $rt['tahapan_ks']['kps'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>