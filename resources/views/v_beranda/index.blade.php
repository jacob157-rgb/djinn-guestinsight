@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full px-3 mt-8 space-x-0 space-y-3 md:space-y-0 md:space-x-2 md:flex-row h-28">
        <div class="w-full h-full rounded-lg shadow-inner md:w-1/2 bg-gradient-red">
            <div class="flex">
                <div class="p-5">
                    <span class="text-white font-bold">Total Admin</span>
                    <br>
                    <p class="text-white font-extrabold mt-2">{{ $count_admin }}</p>
                </div>
                <div class="font-extrabold"></div>
            </div>
        </div>
        <div class="w-full h-full rounded-lg shadow-inner md:w-1/2 bg-gradient-blue">
            <div class="flex">
                <div class="p-5">
                    <span class="text-white font-bold">Total Pengunjung</span>
                    <br>
                    <p class="text-white font-extrabold mt-2">{{ $count_guest }}</p>
                </div>
                <div class="font-extrabold"></div>
            </div>
        </div>
    </div>

    <div class="bg-white m-2 rounded p-2">
        <div class="mb-4">
            <input type="text" id="searchInput" class="px-4 py-2 border rounded-md" placeholder="Search...">
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
            <table id="dataTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">No. ID</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                        <th scope="col" class="px-6 py-3">Kota</th>
                        <th scope="col" class="px-6 py-3">Tgl Lahir</th>
                        <th scope="col" class="px-6 py-3">Pekerjaan</th>
                        <th scope="col" class="px-6 py-3">Pendidikan</th>
                        <th scope="col" class="px-6 py-3">Gender</th>
                        <th scope="col" class="px-6 py-3">Jenis Tamu</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_filter as $index => $row)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->ID_identity }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->name }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->address }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->region }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->birth_date }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->work }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->education }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->gender }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $row->type_guest }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        {{ $data_filter->links() }}
    </div>
@endsection
