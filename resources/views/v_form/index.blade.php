<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tamu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- @vite('resources/css/app.css')
    @vite('resources/js/app.js') --}}

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <h2>Create Guest</h2>
    <form action="{{ url('form') }}" method="POST">
        @csrf
        <div>
            <label for="ID_identity">ID Identity:</label>
            <input type="text" id="ID_identity" name="ID_identity" required><br>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
        </div>
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>
        </div>
        <div>
            <label for="region">Region:</label>
            <select id="region" name="region" required>
                <option value="TEGAL">TEGAL</option>
                <option value="SLAWI">SLAWI</option>
                <option value="BREBES">BREBES</option>
                <option value="PEMALANG">PEMALANG</option>
                <option value="JATENG">JATENG</option>
                <option value="LUAR_JATENG">LUAR JATENG</option>
            </select><br>
        </div>
        <div>
            <label for="birth_date">Birth Date:</label>
            <input type="date" id="birth_date" name="birth_date" required><br>
        </div>
        <div>
            <label for="work">Work:</label>
            <select id="work" name="work" required>
                <option value="WIRASWASTA">WIRASWASTA</option>
                <option value="PNS">PNS</option>
                <option value="TNI_POLRI">TNI/POLRI</option>
                <option value="GURU">GURU</option>
                <option value="PELAJAR">PELAJAR</option>
                <option value="FREELANCER">FREELANCER</option>
                <option value="BURUH">BURUH</option>
                <option value="PETANI">PETANI</option>
                <option value="NELAYAN">NELAYAN</option>
                <option value="PEDAGANG">PEDAGANG</option>
                <option value="PENGUSAHA">PENGUSAHA</option>
                <option value="TIDAK_BEKERJA">TIDAK BEKERJA</option>
            </select><br>
        </div>
        <div>
            <label for="education">Education:</label>
            <select id="education" name="education" required>
                <option value="TS">TS</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="PT">PT</option>
            </select><br>
        </div>
        <div>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="L">L</option>
                <option value="P">P</option>
                <option value="N">N</option>
            </select><br>
        </div>
        <div>
            <label for="type_guest">Type of Guest:</label>
            <select id="type_guest" name="type_guest" required>
                <option value="WEB">WEB</option>
                <option value="WORK_IN_GUEST">WORK IN GUEST</option>
                <option value="OWNER">OWNER</option>
                <option value="TRAVEL">TRAVEL</option>
                <option value="COORPORATE_FAMILY">COORPORATE FAMILY</option>
                <option value="ENTERTAINMENT">ENTERTAINMENT</option>
            </select><br>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
    {{-- JS --}}
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

</body>

</html>
