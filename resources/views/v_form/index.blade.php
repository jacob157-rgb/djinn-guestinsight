@extends('layouts.app')
@section('content')
    <div class="w-full px-5 my-8 md:px-10">
        <div class="flex flex-col items-center justify-center w-full p-8 bg-white rounded-xl">
            <span class="text-2xl">Isi Data Tamu</span>
            <form class="flex flex-col w-full space-x-1 md:space-y-3" action="{{ url('form') }}" method="POST">
                @csrf
                <div class="flex flex-col md:flex-row" class="flex">
                    <label class="w-full md:w-1/5" for="ID_identity">No Identitas :</label>
                    <input class="w-full p-2 border border-black rounded-lg md:w-4/5" type="text" id="ID_identity"
                        name="ID_identity" required value="{{ old('ID_identity') }}"><br>
                </div>
                <span class="ml-40">
                    @error('ID_identity')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex flex-col md:flex-row">
                    <label class="w-full md:w-1/5" for="name">Nama :</label>
                    <input class="w-full p-2 border border-black rounded-lg md:w-4/5" type="text" id="name" name="name"
                        required value="{{ old('name') }}"><br>
                </div>
                <span class="ml-40">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex flex-col md:flex-row">
                    <label class="w-full md:w-1/5" for="address">Alamat :</label>
                    <input class="w-full p-2 border border-black rounded-lg md:w-4/5" type="text" id="address" name="address"
                        required value="{{ old('address') }}"><br>
                </div>
                <span class="ml-40">
                    @error('address')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex flex-col md:flex-row">
                    <label class="w-full md:w-1/5" for="region">Kota :</label>
                    <select class="w-full p-2 border border-black rounded-lg md:w-4/5" id="region" name="region" required
                        value="{{ old('region') }}">
                        <option selected>-- Pilih Kota --</option>
                        <option value="TEGAL">TEGAL</option>
                        <option value="SLAWI">SLAWI</option>
                        <option value="BREBES">BREBES</option>
                        <option value="PEMALANG">PEMALANG</option>
                        <option value="JATENG">JATENG</option>
                        <option value="LUAR_JATENG">LUAR JATENG</option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('region')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex flex-col md:flex-row">
                    <label class="w-full md:w-1/5" for="birth_date">Tanggal Lahir :</label>
                    <input class="w-full p-2 border border-black rounded-lg md:w-4/5 pe-0" type="date" id="birth_date"
                        name="birth_date" required value="{{ old('birth_date') }}"><br>
                </div>
                <span class="ml-40">
                    @error('birth_date')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex flex-col md:flex-row">
                    <label class="w-full md:w-1/5" for="work">Pekerjaan :</label>
                    <select class="w-full p-2 border border-black rounded-lg md:w-4/5" id="work" name="work" required
                        value="{{ old('work') }}">
                        <option selected>-- Pilih Pekerjaan --</option>
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
                <span class="ml-40">
                    @error('work')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex flex-col md:flex-row">
                    <label class="w-full md:w-1/5" for="education">Pendidikan :</label>
                    <select class="w-full p-2 border border-black rounded-lg md:w-4/5" id="education" name="education" required
                        value="{{ old('education') }}">
                        <option selected>-- Pilih Pendidikan --</option>
                        <option value="TS">TIDAK SEKOLAH</option>
                        <option value="SD">SD/MI</option>
                        <option value="SMP">SMP/MTS</option>
                        <option value="SMA">SMA/SMK</option>
                        <option value="PT">PERGURUAN TINGGI</option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('education')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex flex-col md:flex-row">
                    <label class="w-full md:w-1/5" for="gender">Gender :</label>
                    <select class="w-full p-2 border border-black rounded-lg md:w-4/5" id="gender" name="gender" required
                        value="{{ old('gender') }}">
                        <option selected>-- Pilih Gender --</option>
                        <option value="L">LAKI-LAKI</option>
                        <option value="P">PEREMPUAN</option>
                        <option value="N">NONE</option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('gender')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex flex-col md:flex-row">
                    <label class="w-full md:w-1/5" for="type_guest">Jenis Tamu :</label>
                    <select class="w-full p-2 border border-black rounded-lg md:w-4/5" id="type_guest" name="type_guest" required
                        value="{{ old('type_guest') }}">
                        <option selected>-- Pilih Jenis Tamu --</option>
                        <option value="WEB">WEB</option>
                        <option value="WORK_IN_GUEST">WORK IN GUEST</option>
                        <option value="OWNER">OWNER</option>
                        <option value="TRAVEL">TRAVEL</option>
                        <option value="COORPORATE_FAMILY">COORPORATE FAMILY</option>
                        <option value="ENTERTAINMENT">ENTERTAINMENT</option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('type_guest')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex self-end justify-end w-full">
                    <button class="flex justify-center w-full py-2 text-white rounded-lg md:w-4/5 bg-gradient-red"
                        type="submit">Tambah <span class="material-symbols-outlined">
                            add_circle
                        </span></button>
                </div>
            </form>
        </div>
    </div>
@endsection
