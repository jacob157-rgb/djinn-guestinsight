<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- @vite('resources/css/app.css')
    @vite('resources/js/app.js') --}}

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>


    <form action="" method="post">
        @csrf
        <input type="date" name="start_date" value="{{ $startDate }}">
        <input type="date" name="end_date" value="{{ $endDate }}">
        <button type="submit">filter</button>
    </form>
    <a href="/akumulasi"><button>Reset</button></a>


    <p>total tamu : {{ $sum }}</p>
    <p>Laki laki total : {{ $gender['male']['count'] }} = {{ $gender['male']['persen'] }} % dari keseluruhan data =
        {{ $sum }}</p>
    <p>Perempuan total : {{ $gender['female']['count'] }} = {{ $gender['female']['persen'] }} % dari keseluruhan data =
        {{ $sum }}</p>
    <p>None total : {{ $gender['none']['count'] }} = {{ $gender['none']['persen'] }} % dari keseluruhan data
        = {{ $sum }}</p>

    <div style="display: flex; margin: 5px">
        <table border="2">
            <tr>
                <th>Name</th>
                <th>Gender</th>
            </tr>
            @foreach ($gender['male']['datas'] as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->gender }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Jumlah</th>
                <td>{{ $gender['male']['count'] }}</td>
            </tr>
            <tr>
                <th>persentasi</th>
                <td>{{ $gender['male']['persen'] }} %</td>
            </tr>
        </table>
        <br>
        <table border="2" style="margin-left: 5px; margin-right: 5px">
            <tr>
                <th>Name</th>
                <th>Gender</th>
            </tr>
            @foreach ($gender['female']['datas'] as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->gender }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Jumlah</th>
                <td>{{ $gender['female']['count'] }}</td>
            </tr>
            <tr>
                <th>persentasi</th>
                <td>{{ $gender['female']['persen'] }} %</td>
            </tr>
        </table>
        <br>
        <table border="2">
            <tr>
                <th>Name</th>
                <th>Gender</th>
            </tr>
            @foreach ($gender['none']['datas'] as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->gender }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Jumlah</th>
                <td>{{ $gender['none']['count'] }}</td>
            </tr>
            <tr>
                <th>persentasi</th>
                <td>{{ $gender['none']['persen'] }} %</td>
            </tr>
        </table>
    </div>

    {{-- JS --}}
    <script src="{{ asset('resources/js/scripts.js') }}"></script>

</body>

</html>
