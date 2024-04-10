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
    <div class="flex flex-col-reverse w-screen h-screen bg-gray-200 md:flex-row">
        <aside class="sticky flex flex-col bg-white md:h-screen md:w-1/4 md:items-center md:justify-between md:pt-14">
            <div class="flex flex-col md:items-center md:justify-start">
                <img class="hidden w-2/5 h-auto md:block" src="{{ asset('assets/image/logo.png') }}" alt="logo image">
                <h1 class="hidden mt-5 text-4xl font-medium text-primary md:block">DJ INN</h1>
                <ul
                    class="flex flex-row self-stretch justify-between md:mt-10 md:flex-col md:items-start md:justify-center md:self-start md:py-0">
                    <li
                        class="{{ request()->is('beranda') ? 'border-primary' : 'border-transparent' }} border-b-4 md:border-y-0 md:border-l-4">
                        <a class="{{ request()->is('beranda') ? 'text-primary font-semibold' : 'text-gry font-medium' }} flex items-center text-xl"
                            href="/beranda"><span
                                class="px-5 py-3 text-3xl font-medium material-symbols-outlined md:text-4xl">
                                home
                            </span> <span class="hidden md:block"> Beranda</span></a>
                    </li>
                    <li
                        class="{{ request()->is('form') ? 'border-primary' : 'border-transparent' }} border-b-4 md:border-y-0 md:border-l-4">
                        <a class="{{ request()->is('form') ? 'text-primary font-semibold' : 'text-gry font-medium' }} flex items-center text-xl"
                            href="/form"><span
                                class="px-5 py-3 text-3xl font-medium material-symbols-outlined md:text-4xl">
                                assignment_add
                            </span> <span class="hidden md:block"> Formulir</span></a>
                    </li>
                    <li
                        class="{{ request()->is('insight') ? 'border-primary' : 'border-transparent' }} border-b-4 md:border-y-0 md:border-l-4">
                        <a class="{{ request()->is('insight') ? 'text-primary font-semibold' : 'text-gry font-medium' }} flex items-center text-xl"
                            href="/insight"><span
                                class="px-5 py-3 text-3xl font-medium material-symbols-outlined md:text-4xl">
                                bar_chart
                            </span> <span class="hidden md:block"> Insight</span></a>
                    </li>
                    <li
                        class="{{ request()->is('akumulasi') ? 'border-primary' : 'border-transparent' }} border-b-4 md:border-y-0 md:border-l-4">
                        <a class="{{ request()->is('akumulasi') ? 'text-primary font-semibold' : 'text-gry font-medium' }} flex items-center text-xl"
                            href="/akumulasi"><span
                                class="px-5 py-3 text-3xl font-medium material-symbols-outlined md:text-4xl">
                                person
                            </span> <span class="hidden md:block"> Akumulasi</span></a>
                    </li>
                    <li class="block md:hidden">
                        <form action="/logout" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center text-xl border-b-4 border-transparent text-gry"><span
                                    class="px-5 py-3 text-3xl material-symbols-outlined">
                                    logout</button>
                        </form>
                    </li>
                </ul>
            </div>
            <form class="hidden md:block" action="/logout" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center pb-3 text-xl text-gry"><span
                        class="px-3 text-3xl material-symbols-outlined">
                        logout
                    </span> Logout</button>
            </form>
        </aside>
        <div class="w-full h-screen overflow-y-auto bg-gray-200 md:w-3/4">
            <x-notify::notify />
            <div class="block px-10 mt-8 md:hidden">
                <div class="flex flex-col">
                    <span class="text-xl underline md:text-3xl">{{ $title }}</span>
                    <span class="text-sm md:text-2xl">{{ $greeting }},<br> <span
                            class="text-xl font-medium">{{ Auth::user()->name }}!</span></span>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="flex flex-col justify-between px-10 mt-8 md:flex-row">
                    <div class="flex flex-col">
                        <span class="text-xl md:text-3xl">{{ $title }}</span>
                        <span class="text-xl md:text-2xl">{{ $greeting }}, <span
                                class="font-medium">{{ Auth::user()->name }}!</span></span>
                    </div>
                    <div class="flex flex-col mt-0 md:items-end">
                        <span class="text-xl md:text-3xl">{{ $clock }}</span>
                        <span class="text-xl md:text-2xl">{{ $today }}</span>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
        {{-- JS --}}
        @notifyJs
        <script src="{{ asset('assets/js/scripts.js') }}"></script>



</body>

</html>
