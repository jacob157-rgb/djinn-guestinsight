@extends('layouts.app')
@section('content')
    <div class="w-full px-10 my-8">
        <div class="flex flex-col items-center justify-center w-full p-8 bg-white rounded-xl">
            <span class="text-2xl">Isi Data Tamu</span>
            <form class="flex flex-col w-full space-y-3" action="{{ url('form', $data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex" class="flex">
                    <label class="w-1/5" for="ID_identity">No Identitas :</label>
                    <input class="w-4/5 p-2 border border-black rounded-lg" type="text" id="ID_identity"
                        name="ID_identity" required value="{{ $data->ID_identity }}"><br>
                </div>
                <span class="ml-40">
                    @error('ID_identity')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex">
                    <label class="w-1/5" for="name">Nama :</label>
                    <input class="w-4/5 p-2 border border-black rounded-lg" type="text" id="name" name="name"
                        required value="{{ $data->name }}"><br>
                </div>
                <span class="ml-40">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex">
                    <label class="w-1/5" for="address">Alamat :</label>
                    <input class="w-4/5 p-2 border border-black rounded-lg" type="text" id="address" name="address"
                        required value="{{ $data->address }}"><br>
                </div>
                <span class="ml-40">
                    @error('address')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex">
                    <label class="w-1/5" for="region">Kota :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="region" name="region" required>
                        <option selected>-- Pilih Kota --</option>
                        <option value="TEGAL" {{ $data->region == 'TEGAL' ? 'selected' : '' }}>TEGAL</option>
                        <option value="SLAWI" {{ $data->region == 'SLAWI' ? 'selected' : '' }}>SLAWI</option>
                        <option value="BREBES" {{ $data->region == 'BREBES' ? 'selected' : '' }}>BREBES</option>
                        <option value="PEMALANG" {{ $data->region == 'PEMALANG' ? 'selected' : '' }}>PEMALANG</option>
                        <option value="JATENG" {{ $data->region == 'JATENG' ? 'selected' : '' }}>JATENG</option>
                        <option value="LUAR_JATENG" {{ $data->region == 'LUAR_JATENG' ? 'selected' : '' }}>LUAR JATENG
                        </option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('region')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex">
                    <label class="w-1/5" for="birth_date">Tanggal Lahir :</label>
                    <input class="w-4/5 p-2 border border-black rounded-lg pe-0" type="date" id="birth_date"
                        name="birth_date" required value="{{ $data->birth_date }}"><br>
                </div>
                <span class="ml-40">
                    @error('birth_date')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex">
                    <label class="w-1/5" for="work">Pekerjaan :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="work" name="work" required>
                        <option selected>-- Pilih Pekerjaan --</option>
                        <option value="WIRASWASTA" {{ $data->work == 'WIRASWASTA' ? 'selected' : '' }}>WIRASWASTA</option>
                        <option value="PNS" {{ $data->work == 'PNS' ? 'selected' : '' }}>PNS</option>
                        <option value="TNI_POLRI" {{ $data->work == 'TNI_POLRI' ? 'selected' : '' }}>TNI/POLRI</option>
                        <option value="GURU" {{ $data->work == 'GURU' ? 'selected' : '' }}>GURU</option>
                        <option value="PELAJAR" {{ $data->work == 'PELAJAR' ? 'selected' : '' }}>PELAJAR</option>
                        <option value="FREELANCER" {{ $data->work == 'FREELANCER' ? 'selected' : '' }}>FREELANCER</option>
                        <option value="BURUH" {{ $data->work == 'BURUH' ? 'selected' : '' }}>BURUH</option>
                        <option value="PETANI" {{ $data->work == 'PETANI' ? 'selected' : '' }}>PETANI</option>
                        <option value="NELAYAN" {{ $data->work == 'NELAYAN' ? 'selected' : '' }}>NELAYAN</option>
                        <option value="PEDAGANG" {{ $data->work == 'PEDAGANG' ? 'selected' : '' }}>PEDAGANG</option>
                        <option value="PENGUSAHA" {{ $data->work == 'PENGUSAHA' ? 'selected' : '' }}>PENGUSAHA</option>
                        <option value="TIDAK_BEKERJA" {{ $data->work == 'TIDAK_BEKERJA' ? 'selected' : '' }}>TIDAK BEKERJA
                        </option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('work')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex">
                    <label class="w-1/5" for="education">Pendidikan :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="education" name="education" required>
                        <option selected>-- Pilih Pendidikan --</option>
                        <option value="TS" {{ $data->education == 'TS' ? 'selected' : '' }}>TIDAK SEKOLAH</option>
                        <option value="SD" {{ $data->education == 'SD' ? 'selected' : '' }}>SD/MI</option>
                        <option value="SMP" {{ $data->education == 'SMP' ? 'selected' : '' }}>SMP/MTS</option>
                        <option value="SMA" {{ $data->education == 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="PT" {{ $data->education == 'PT' ? 'selected' : '' }}>PERGURUAN TINGGI</option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('education')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex">
                    <label class="w-1/5" for="gender">Gender :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="gender" name="gender" required>
                        <option selected>-- Pilih Gender --</option>
                        <option value="L" {{ $data->gender == 'L' ? 'selected' : '' }}>LAKI-LAKI</option>
                        <option value="P" {{ $data->gender == 'P' ? 'selected' : '' }}>PEREMPUAN</option>
                        <option value="N" {{ $data->gender == 'N' ? 'selected' : '' }}>NONE</option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('gender')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex">
                    <label class="w-1/5" for="type_guest">Jenis Tamu :</label>
                    <select class="w-4/5 p-2 border border-black rounded-lg" id="type_guest" name="type_guest" required>
                        <option selected>-- Pilih Jenis Tamu --</option>
                        <option value="WEB" {{ $data->type_guest == 'WEB' ? 'selected' : '' }}>WEB</option>
                        <option value="WORK_IN_GUEST" {{ $data->type_guest == 'WORK_IN_GUEST' ? 'selected' : '' }}>WORK IN
                            GUEST</option>
                        <option value="OWNER" {{ $data->type_guest == 'OWNER' ? 'selected' : '' }}>OWNER</option>
                        <option value="TRAVEL" {{ $data->type_guest == 'TRAVEL' ? 'selected' : '' }}>TRAVEL</option>
                        <option value="COORPORATE_FAMILY"
                            {{ $data->type_guest == 'COORPORATE_FAMILY' ? 'selected' : '' }}>
                            COORPORATE FAMILY</option>
                        <option value="ENTERTAINMENT" {{ $data->type_guest == 'ENTERTAINMENT' ? 'selected' : '' }}>
                            ENTERTAINMENT</option>
                    </select><br>
                </div>
                <span class="ml-40">
                    @error('type_guest')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </span>
                <div class="flex self-end justify-end w-full">
                    <button class="flex justify-center w-4/5 py-2 text-white rounded-lg bg-gradient-red"
                        type="submit">Save <span class="material-symbols-outlined">
                            add_circle
                        </span></button>
                </div>
            </form>
        </div>
    </div>
@endsection
