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

    {{-- CSS --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}
</head>

<body>
    <div class="flex w-screen h-screen bg-gray-200">
        <aside class="flex flex-col items-center justify-between w-1/4 h-screen bg-white pt-14">
            <div class="flex flex-col items-center justify-start">
                <img class="w-2/5 h-auto" src="{{ asset('assets/image/logo.png') }}" alt="logo image">
                <h1 class="mt-5 text-4xl font-medium text-primary">DJ INN</h1>
                <ul class="flex flex-col self-start mt-10 space-y-2">
                    <li class="border-primary border-s-4">
                        <a class="flex items-center text-xl font-semibold text-primary" href=""><span
                                class="px-5 text-4xl font-medium material-symbols-outlined">
                                home
                            </span> Beranda</a>
                    </li>
                    <li class="border-transparent border-s-4">
                        <a class="flex items-center text-xl font-medium text-gry" href=""><span
                                class="px-5 text-4xl font-medium material-symbols-outlined">
                                assignment_add
                            </span> Formulir</a>
                    </li>
                    <li class="border-transparent border-s-4">
                        <a class="flex items-center text-xl font-medium text-gry" href=""><span
                                class="px-5 text-4xl font-medium material-symbols-outlined">
                                bar_chart
                            </span> Insight</a>
                    </li>
                    <li class="border-transparent border-s-4">
                        <a class="flex items-center text-xl font-medium text-gry" href=""><span
                                class="px-5 text-4xl font-medium material-symbols-outlined">
                                person
                            </span> Akumulasi</a>
                    </li>
                </ul>
            </div>
            <a class="flex items-center pb-3 text-xl text-gry" href="/logout"><span
                    class="px-3 text-3xl material-symbols-outlined">
                    logout
                </span> Logout</a>
        </aside>
        <div class="w-3/4 h-screen bg-gray-200">
            @yield('content')
        </div>
    </div>
    {{-- JS --}}
    {{-- <script src="{{ asset('assets/js/scripts.js') }}"></script> --}}
</body>

</html>
