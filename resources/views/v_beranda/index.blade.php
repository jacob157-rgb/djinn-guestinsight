@extends('layouts.app')
@section('content')

    <div class="flex flex-col w-full px-3 mt-8 space-x-0 space-y-3 md:space-y-0 md:space-x-2 md:flex-row h-28">
        <div class="w-full h-full rounded-lg md:w-1/2 bg-gradient-red"></div>
        <div class="w-full h-full rounded-lg md:w-1/2 bg-gradient-blue"></div>
    </div>

    {{-- <form action="" method="post">
        @csrf
        <input type="date" name="start_date" value="{{ $startDate }}">
        <input type="date" name="end_date" value="{{ $endDate }}">
        <button type="submit">filter</button>
    </form>
    <a href="/beranda"><button>Reset</button></button>



        <p>{{ $data_filter_count }}</p> --}}
@endsection
