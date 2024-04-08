@extends('layouts.app')
@section('content')
    <div class="w-full px-10 my-8">
        <div class="flex flex-col items-center justify-center w-full p-8 bg-white rounded-xl">
            <span class="text-2xl">Isi Data Tamu</span>
            <form class="flex flex-col w-full space-y-3" action="{{ url('form') }}" method="POST">
                @csrf
                <div class="flex" class="flex">
                    <label class="w-1/5" for="ID_identity">No Identitas :</label>
                    <input class="w-4/5 p-2 border border-black rounded-lg" type="text" id="ID_identity"
                        name="ID_identity" required><br>
                </div>
                <div class="flex">
                    <label class="w-1/5" for="name">Nama :</label>
                    <input class="w-4/5 p-2 border border-black rounded-lg" type="text" id="name" name="name"
                        required><br>
                </div>
                <div class="flex">
                    <label class="w-1/5" for="address">Alamat :</label>
                    <input class="w-4/5 p-2 border border-black rounded-lg" type="text" id="address" name="address"
                        required><br>
                </div>
                <div class="flex">
                    <label class="w-1/5" for="region">Kota :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="region" name="region" required>
                        <option value="TEGAL">TEGAL</option>
                        <option value="SLAWI">SLAWI</option>
                        <option value="BREBES">BREBES</option>
                        <option value="PEMALANG">PEMALANG</option>
                        <option value="JATENG">JATENG</option>
                        <option value="LUAR_JATENG">LUAR JATENG</option>
                    </select><br>
                </div>
                <div class="flex">
                    <label class="w-1/5" for="birth_date">Tanggal Lahir :</label>
                    <input class="w-4/5 p-2 border border-black rounded-lg pe-0" type="date" id="birth_date"
                        name="birth_date" required><br>
                </div>
                <div class="flex">
                    <label class="w-1/5" for="work">Pekerjaan :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="work" name="work" required>
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
                <div class="flex">
                    <label class="w-1/5" for="education">Pendidikan :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="education" name="education" required>
                        <option value="TS">TS</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="PT">PT</option>
                    </select><br>
                </div>
                <div class="flex">
                    <label class="w-1/5" for="gender">Gender :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="gender" name="gender" required>
                        <option value="L">L</option>
                        <option value="P">P</option>
                        <option value="N">N</option>
                    </select><br>
                </div>
                <div class="flex">
                    <label class="w-1/5" for="type_guest">Jenis Tamu :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="type_guest" name="type_guest" required>
                        <option value="WEB">WEB</option>
                        <option value="WORK_IN_GUEST">WORK IN GUEST</option>
                        <option value="OWNER">OWNER</option>
                        <option value="TRAVEL">TRAVEL</option>
                        <option value="COORPORATE_FAMILY">COORPORATE FAMILY</option>
                        <option value="ENTERTAINMENT">ENTERTAINMENT</option>
                    </select><br>
                </div>
                <div class="flex self-end justify-end w-full">
                    <button class="flex justify-center w-4/5 py-2 text-white rounded-lg bg-gradient-red"
                        type="submit">Tambah <span class="material-symbols-outlined">
                            add_circle
                        </span></button>
                </div>
            </form>
        </div>
    </div>
@endsection
