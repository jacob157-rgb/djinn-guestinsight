<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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



</body>
</html>
