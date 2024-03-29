<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        return view('v_form.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'ID_identity' => 'required|unique:guest,ID_identity',
                'name' => 'required',
                'address' => 'required',
                'region' => 'required|in:TEGAL,SLAWI,BREBES,PEMALANG,JATENG,LUAR_JATENG',
                'birth_date' => 'required|date',
                'work' => 'required|in:WIRASWASTA,PNS,TNI_POLRI,GURU,PELAJAR,FREELANCER,BURUH,PETANI,NELAYAN,PEDAGANG,PENGUSAHA,TIDAK_BEKERJA',
                'education' => 'required|in:TS,SD,SMP,SMA,PT',
                'gender' => 'required|in:L,P,N',
                'type_guest' => 'required|in:WEB,WORK_IN_GUEST,OWNER,TRAVEL,COORPORATE_FAMILY,ENTERTAINMENT',
            ],
            [
                'ID_identity.required' => 'ID Identity harus diisi.',
                'ID_identity.unique' => 'ID Identity sudah digunakan.',
                'name.required' => 'Nama harus diisi.',
                'address.required' => 'Alamat harus diisi.',
                'region.required' => 'Region harus dipilih.',
                'region.in' => 'Region harus dipilih dari pilihan yang tersedia.',
                'birth_date.required' => 'Tanggal lahir harus diisi.',
                'birth_date.date' => 'Format tanggal lahir tidak valid.',
                'work.required' => 'Pekerjaan harus dipilih.',
                'work.in' => 'Pekerjaan harus dipilih dari pilihan yang tersedia.',
                'education.required' => 'Pendidikan harus dipilih.',
                'education.in' => 'Pendidikan harus dipilih dari pilihan yang tersedia.',
                'gender.required' => 'Jenis kelamin harus dipilih.',
                'gender.in' => 'Jenis kelamin harus dipilih dari pilihan yang tersedia.',
                'type_guest.required' => 'Tipe tamu harus dipilih.',
                'type_guest.in' => 'Tipe tamu harus dipilih dari pilihan yang tersedia.',
            ],
        );

        Guest::create($validatedData);

        return redirect('/form')->with('msg', 'Guest created successfully!');
    }

    public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $validatedData = $request->validate(
            [
                'ID_identity' => 'required',
                'name' => 'required',
                'address' => 'required',
                'region' => 'required|in:TEGAL,SLAWI,BREBES,PEMALANG,JATENG,LUAR_JATENG',
                'birth_date' => 'required|date',
                'work' => 'required|in:WIRASWASTA,PNS,TNI_POLRI,GURU,PELAJAR,FREELANCER,BURUH,PETANI,NELAYAN,PEDAGANG,PENGUSAHA,TIDAK_BEKERJA',
                'education' => 'required|in:TS,SD,SMP,SMA,PT',
                'gender' => 'required|in:L,P,N',
                'type_guest' => 'required|in:WEB,WORK_IN_GUEST,OWNER,TRAVEL,COORPORATE_FAMILY,ENTERTAINMENT',
            ],
            [
                'ID_identity.required' => 'ID Identity harus diisi.',
                'name.required' => 'Nama harus diisi.',
                'address.required' => 'Alamat harus diisi.',
                'region.required' => 'Region harus dipilih.',
                'region.in' => 'Region harus dipilih dari pilihan yang tersedia.',
                'birth_date.required' => 'Tanggal lahir harus diisi.',
                'birth_date.date' => 'Format tanggal lahir tidak valid.',
                'work.required' => 'Pekerjaan harus dipilih.',
                'work.in' => 'Pekerjaan harus dipilih dari pilihan yang tersedia.',
                'education.required' => 'Pendidikan harus dipilih.',
                'education.in' => 'Pendidikan harus dipilih dari pilihan yang tersedia.',
                'gender.required' => 'Jenis kelamin harus dipilih.',
                'gender.in' => 'Jenis kelamin harus dipilih dari pilihan yang tersedia.',
                'type_guest.required' => 'Tipe tamu harus dipilih.',
                'type_guest.in' => 'Tipe tamu harus dipilih dari pilihan yang tersedia.',
            ],
        );

        $guest->update($validatedData);

        return redirect('/form')->with('msg', 'Guest updated successfully!');
    }

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect('/form')->with('msg', 'Guest deleted successfully!');
    }
}
