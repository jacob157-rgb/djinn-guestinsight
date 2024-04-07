@extends('layouts.app')
@section('content')
    <div class="flex flex-col justify-between px-10 mt-8 md:flex-row">
        <div class="flex flex-col">
            <span class="text-xl md:text-3xl">{{ $title }}</span>
            <span class="text-xl md:text-2xl">{{ $greeting }}, <span class="font-medium">{{ Auth::user()->name }}!</span></span>
        </div>
        <div class="flex flex-col mt-5 md:mt-0 md:items-end">
            <span class="text-xl md:text-3xl">{{ $clock }}</span>
            <span class="text-xl md:text-2xl">{{ $today }}</span>
        </div>
    </div>

    <div class="flex flex-col w-full px-3 mt-10 space-x-0 space-y-3 md:space-y-0 md:space-x-2 md:flex-row h-28">
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
