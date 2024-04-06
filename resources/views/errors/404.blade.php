<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404!</title>
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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="flex flex-col items-center justify-center h-screen">
        <h1 class="text-[10rem] drop-shadow-2xl font-bold text-primary">404</h1>
        <span class="-mt-10 text-2xl font-medium tracking-widest text-black" x-data="{ texts: ['Halaman Tidak Ditemukan', 'Gak Ketemu Nich :(', 'Wadidaw Gimana Nich'] }"
        x-typewriter="texts" x-typewriter.cursor="texts"></span>
        <span class="">kembali ke <a href="/" class="underline">utama</a></span>
    </div>
    {{-- JS --}}
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>

</html>
