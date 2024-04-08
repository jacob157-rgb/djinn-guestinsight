<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @notifyCss

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


</head>

<body>
    <div class="flex w-screen h-screen bg-gray-200">
        <aside class="sticky flex flex-col items-center justify-between w-1/4 h-screen bg-white pt-14">
            <div class="flex flex-col items-center justify-start">
                <img class="w-2/5 h-auto" src="{{ asset('assets/image/logo.png') }}" alt="logo image">
                <h1 class="mt-5 text-4xl font-medium text-primary">DJ INN</h1>
                <ul class="flex flex-col self-start mt-10 space-y-2">
                    <li class="{{ request()->is('beranda') ? 'border-primary' : 'border-transparent' }} border-s-4">
                        <a class="{{ request()->is('beranda') ? 'text-primary font-semibold' : 'text-gry font-medium' }} flex items-center text-xl"
                            href="/beranda"><span class="px-5 text-4xl font-medium material-symbols-outlined">
                                home
                            </span> Beranda</a>
                    </li>
                    <li class="{{ request()->is('form') ? 'border-primary' : 'border-transparent' }} border-s-4">
                        <a class="{{ request()->is('form') ? 'text-primary font-semibold' : 'text-gry font-medium' }} flex items-center text-xl"
                            href="/form"><span class="px-5 text-4xl font-medium material-symbols-outlined">
                                assignment_add
                            </span> Formulir</a>
                    </li>
                    <li class="{{ request()->is('insight') ? 'border-primary' : 'border-transparent' }} border-s-4">
                        <a class="{{ request()->is('insight') ? 'text-primary font-semibold' : 'text-gry font-medium' }} flex items-center text-xl"
                            href="/insight"><span class="px-5 text-4xl font-medium material-symbols-outlined">
                                bar_chart
                            </span> Insight</a>
                    </li>
                    <li class="{{ request()->is('akumulasi') ? 'border-primary' : 'border-transparent' }} border-s-4">
                        <a class="{{ request()->is('akumulasi') ? 'text-primary font-semibold' : 'text-gry font-medium' }} flex items-center text-xl"
                            href="/akumulasi"><span class="px-5 text-4xl font-medium material-symbols-outlined">
                                person
                            </span> Akumulasi</a>
                    </li>
                </ul>
            </div>
            <form action="/logout" method="post">
                @csrf
                @method("DELETE")
                <button type="submit" class="flex items-center pb-3 text-xl text-gry"><span
                    class="px-3 text-3xl material-symbols-outlined">
                    logout
                </span> Logout</button>
            </form>
        </aside>
        <div class="w-3/4 h-screen overflow-y-auto bg-gray-200">
            <x-notify::notify />
            <div class="flex flex-col justify-between px-10 mt-8 md:flex-row">
                <div class="flex flex-col">
                    <span class="text-xl md:text-3xl">{{ $title }}</span>
                    <span class="text-xl md:text-2xl">{{ $greeting }}, <span
                            class="font-medium">{{ Auth::user()->name }}!</span></span>
                </div>
                <div class="flex flex-col mt-5 md:mt-0 md:items-end">
                    <span class="text-xl md:text-3xl">{{ $clock }}</span>
                    <span class="text-xl md:text-2xl">{{ $today }}</span>
                </div>
            </div>
            @yield('content')
            <div>
                <canvas id="myChart"></canvas>
              </div>
        </div>
    </div>
    {{-- JS --}}
    @notifyJs
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#dataTable tbody tr').each(function() {
                    var rowData = $(this).text().toLowerCase();
                    if (rowData.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });
        var rowCount = $('#dataTable tbody tr:visible').length;
            $('#dataFilterCount').text(rowCount);
    </script>

</body>

</html>
