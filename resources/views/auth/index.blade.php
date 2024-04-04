<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite('resources/css/app.css')
</head>

<body>
    <div class="grid h-screen grid-cols-1 md:grid-cols-2">
        <div class="w-full h-full p-5 md:h-screen">
            <img class="object-cover w-full h-full rounded-xl" src="{{ asset('assets/image/login.png') }}"
                alt="banner image" />
        </div>
        <div class="absolute z-10 flex items-center justify-center w-full h-full px-12 py-5 bg-white bg-opacity-50 md:bg-opacity-100 md:bg-transparent md:static md:z-0 md:h-full backdrop-filter backdrop-blur-sm md:backdrop-blur-none md:backdrop-none">
            <div class="flex flex-col items-center">
                <img class="w-1/5 h-1/5" src="{{ asset('assets/image/logo.png') }}" alt="logo image">
                <h1 class="mt-5 text-3xl font-semibold text-primary">DJ INN</h1>
                <p class="self-start mt-10 text-xl font-medium">Silahkan masuk untuk melanjutkan</p>
                @if ($errors->any())
                <div class="self-start text-primary">
                    <p>Ada yang salah !</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="flex flex-col w-full mt-5 space-y-2" action="{{ url('login') }}" method="POST">
                    @csrf
                    <div class="flex flex-col">
                        <label for="username">Username</label>
                        <input placeholder="Masukan Username"
                            class="h-10 rounded-lg border border-gray-200 pl-[14px] text-sm" type="text"
                            id="username" name="username" value="{{ old('username') }}" required autofocus>
                    </div>
                    <div class="flex flex-col pb-5">
                        <label for="password">Password</label>
                        <input placeholder="Masukan Password"
                            class="h-10 rounded-lg border border-gray-200 pl-[14px] text-sm" type="password"
                            id="password" name="password" required>
                    </div>
                    <button class="flex items-center justify-center py-2 text-white rounded-lg hover:opacity-80 bg-gradient-red"
                        type="submit"><span class="material-symbols-outlined me-2">
                            encrypted
                        </span> Masuk</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
