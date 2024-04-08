@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full px-10 mt-8 space-x-0 space-y-3 h-28 md:flex-row md:space-x-2 md:space-y-0">
        <div class="w-full h-full rounded-lg shadow-inner bg-gradient-red md:w-1/2">
            <div class="flex">
                <div class="p-5">
                    <span class="font-bold text-white">Total Admin</span>
                    <br>
                    <p class="mt-2 font-extrabold text-white">{{ $count_admin }}</p>
                </div>
                <div class="font-extrabold"></div>
            </div>
        </div>
        <div class="w-full h-full rounded-lg shadow-inner bg-gradient-blue md:w-1/2">
            <div class="flex">
                <div class="p-5">
                    <span class="font-bold text-white">Total Pengunjung</span>
                    <br>
                    <p class="mt-2 font-extrabold text-white">{{ $count_guest }}</p>
                </div>
                <div class="font-extrabold"></div>
            </div>
        </div>
    </div>

    <div class="w-full px-10 mt-3 mb-8">
        <div class="w-full p-8 bg-white rounded-xl">
            <div class="mb-4">
                <input type="text" id="searchInput" class="px-4 py-2 border rounded-md" placeholder="Search...">
            </div>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="dataTable" class="w-full text-sm text-left text-gray-500 rtl:text-right">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">No. Identitas</th>
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
                            <tr class="border-b odd:bg-white even:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->ID_identity }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->name }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->address }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->region }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->birth_date }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->work }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->education }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->gender }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $row->type_guest }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <a href="form/{{ $row->id }}"
                                        class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                                    <span class="mx-2"> | </span>
                                    <a href="#" onclick="confirmDelete(event, '{{ $row->id }}')"
                                        class="font-medium text-red-600 hover:underline dark:text-red-500">Hapus</a>
                                    <form id="deleteForm_{{ $row->id }}" action="form/{{ $row->id }}"
                                        method="post">@csrf @method('DELETE') <button type="submit"></button></form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>

            <nav class="flex items-center justify-between gap-x-1">
                <button type="button" onclick="previousPage()"
                    class="inline-flex min-h-[38px] min-w-[38px] items-center justify-center gap-x-2 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                    <svg class="size-3.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                    <span aria-hidden="true" class="hidden sm:block">Previous</span>
                </button>
                <div class="flex items-center gap-x-1">
                    @for ($i = 0; $i < $pagination['lastPage']; $i++)
                        <button type="button" onclick="changePage({{ $i + 1 }})"
                            class="{{ $i + 1 == $pagination['currentPage'] ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-800' }} flex min-h-[38px] min-w-[38px] items-center justify-center rounded-lg px-3 py-2 text-sm focus:bg-gray-300 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:bg-gray-600 dark:text-white dark:focus:bg-gray-500"
                            aria-current="page">{{ $i + 1 }}</button>
                    @endfor
                </div>
                <button type="button" onclick="nextPage()"
                    class="inline-flex min-h-[38px] min-w-[38px] items-center justify-center gap-x-2 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                    <span aria-hidden="true" class="hidden sm:block">Next</span>
                    <svg class="size-3.5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
            </nav>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function changePage(page) {
            var currentUrl = window.location.href;
            var newUrl = currentUrl.split('?')[0] + '?page=' + page;
            window.location.href = newUrl;
        }

        function previousPage() {
            var page = parseInt("{{ $pagination['currentPage'] }}");
            var currentUrl = "{{ $pagination['path'] }}";
            var newUrl = currentUrl + '?page=' + (page - 1);
            console.log(newUrl)
            window.location.href = newUrl;
        }

        function nextPage() {
            var page = parseInt("{{ $pagination['currentPage'] }}");
            var currentUrl = "{{ $pagination['path'] }}";
            var newUrl = currentUrl + '?page=' + (page + 1);
            console.log(newUrl)
            window.location.href = newUrl;
        }

        function confirmDelete(event, id) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus?')) {
                document.getElementById('deleteForm_' + id).submit();
            }
        }

        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#dataTable tbody tr').each(function() {
                    var rowData = $(this).text().toLowerCase();
                    if (rowData.indexOf(searchText) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        });
    </script>
@endsection
