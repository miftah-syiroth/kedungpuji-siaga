<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('windmill/public/assets/css/tailwind.output.css') }}" />
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ibu</th>
                <th>RT/RT</th>
                <th>Umur Ibu</th>
                <th>HPHT</th>
                <th>Umur Kandungan</th>
                <th>Waktu Kelahiran</th>
                <th>Status Partus</th>
                <th>Kondisi Ibu</th>
                <th>Jumlah anak</th>
                <th>Penolong Persalinan</th>
                <th>Cara Persalinan</th>
                <th>Keterangan Ibu</th>
                <th>Suami Ibu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pregnancies as $key => $pregnancy)
            <tr>
                <td>
                    {{ $key + 1 . '.' }}
                </td>
                <td>
                    {{ $pregnancy->person->name }}
                </td>
                <td>
                    {{ $pregnancy->person->rt }}/{{ $pregnancy->person->rw }}
                </td>
                <td>
                    {{ $pregnancy->person->date_of_birth->age }}
                </td>
                <td>
                    {{ $pregnancy->hpht->isoFormat('DD MMMM YYYY') }}
                </td>
                <td>
                    {{ $pregnancy->gestational_age ?? $pregnancy->hpht->diffInWeeks(now()) . ' minggu' }}
                </td>
                <td>
                    {{ $pregnancy->childbirth_date ? $pregnancy->childbirth_date->isoFormat('D MMM YYYY, hh:mm') : '-' }}
                </td>
                <td>
                    {{ $pregnancy->parturition->type ?? '-' }}
                </td>
                <td>
                    {{ $pregnancy->motherCondition->condition ?? '-' }}
                </td>
                <td>
                    {{ $pregnancy->childbirths->count() }}
                </td>
                <td>
                    {{ $pregnancy->childbirth_attendant ?? '-' }}
                </td>
                <td>
                    {{ $pregnancy->childbirth_method ?? '-' }}
                </td>
                <td>
                    {{ $pregnancy->additional_information ?? '-' }}
                </td>
                <td>
                    {{ $pregnancy->person->husband->husband->name ?? '-' }}
                </td>
            </tr>
            @endforeach
            
            </tbody>
    </table>
</body>
</html>