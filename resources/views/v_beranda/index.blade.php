@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

    <div class="flex flex-col w-full px-3 mt-8 space-x-0 space-y-3 md:space-y-0 md:space-x-2 md:flex-row h-28">
        <div class="w-full h-full rounded-lg shadow-inner md:w-1/2 bg-gradient-red"></div>
        <div class="w-full h-full rounded-lg shadow-inner md:w-1/2 bg-gradient-blue"></div>
    </div>

    <table id="example" class="" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            <!-- More rows can be added here -->
        </tbody>
    </table>


    {{-- <form action="" method="post">
        @csrf
        <input type="date" name="start_date" value="{{ $startDate }}">
        <input type="date" name="end_date" value="{{ $endDate }}">
        <button type="submit">filter</button>
    </form>
    <a href="/beranda"><button>Reset</button></button>



        <p>{{ $data_filter_count }}</p> --}}
           
@endsection
