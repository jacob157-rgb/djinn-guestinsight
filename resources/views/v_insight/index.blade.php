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
    <a href="/insight"><button>Reset</button></a>


    <p>tegal total : {{ $region['tegal']['count'] }} = {{ $region['tegal']['persen'] }} % dari keseluruhan data =
        {{ $sum }}</p>
    <p>slawi total : {{ $region['slawi']['count'] }} = {{ $region['slawi']['persen'] }} % dari keseluruhan data =
        {{ $sum }}</p>
    <p>pemalang total : {{ $region['pemalang']['count'] }} = {{ $region['pemalang']['persen'] }} % dari keseluruhan data
        = {{ $sum }}</p>
    <p>brebes total : {{ $region['brebes']['count'] }} = {{ $region['brebes']['persen'] }} % dari keseluruhan data =
        {{ $sum }}</p>
    <p>jateng total : {{ $region['jateng']['count'] }} = {{ $region['jateng']['persen'] }} % dari keseluruhan data =
        {{ $sum }}</p>
    <p>luar jateng total : {{ $region['luarJateng']['count'] }} = {{ $region['luarJateng']['persen'] }} % dari
        keseluruhan data = {{ $sum }}</p>


</body>
</html>
