@extends('layouts.app')
@section('content')
    <form class="flex items-center py-3 mt-5 space-x-3 bg-white rounded-full ms-10 w-fit pe-3 ps-1" action=""
        method="post">
        @csrf
        <input class="px-3 py-1 bg-white rounded-full drop-shadow-2xl" type="date" name="start_date"
            value="{{ $startDate }}">
        <span>to</span>
        <input class="px-3 py-1 bg-white rounded-full drop-shadow-2xl" type="date" name="end_date"
            value="{{ $endDate }}">
        <button class="flex justify-center px-3 py-1 bg-white rounded-full drop-shadow-2xl" type="reset">
            <span class="material-symbols-outlined">
                restart_alt
            </span> Reset
        </button>
        <button
            class="flex justify-center px-5 py-1 font-medium text-white rounded-full text-md bg-gradient-red drop-shadow-2xl"
            type="submit"><span class="text-base font-bold material-symbols-outlined pe-2">
                filter_alt
            </span> Filter</button>
        <button
            class="flex justify-center px-5 py-1 font-medium text-white rounded-full text-md bg-gradient-green drop-shadow-2xl"
            type="button"><span class="text-base font-bold material-symbols-outlined pe-2">
                ios_share
            </span> Export</button>
    </form>


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
@endsection
