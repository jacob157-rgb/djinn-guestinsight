@extends('layouts.app')
@section('content')
    <div class="block px-2 md:hidden">
        <form class="flex flex-col items-center px-3 py-3 mx-3 mt-5 space-y-2 bg-white rounded-xl" action=""
            method="post">
            @csrf
            <input class="w-full px-3 py-2 bg-white rounded-full shadow-md" type="date" name="start_date"
                value="{{ $startDate }}">
            <span>to</span>
            <input class="w-full px-3 py-2 bg-white rounded-full shadow-md" type="date" name="end_date"
                value="{{ $endDate }}">
            <div class="flex flex-col w-full space-y-3">
                <a href="/akumulasi"
                    class="flex justify-center w-full py-2 font-medium text-white rounded-full shadow-md bg-gradient-blue"
                    type="reset">
                    <span class="material-symbols-outlined">
                        restart_alt
                    </span> Reset
                </a>
                <button
                    class="flex justify-center w-full py-2 font-medium text-white rounded-full shadow-md bg-gradient-red"
                    type="submit">
                    <span class="text-base font-bold material-symbols-outlined">
                        filter_alt
                    </span> Filter
                </button>
                <a href="/akumulasi/print/{{ $startDate && $endDate != ' ' ? $startDate . '/' . $endDate : ' ' }}"
                    class="flex justify-center w-full py-2 font-medium text-white rounded-full shadow-md bg-gradient-red">
                    <span class="material-symbols-outlined">
                        picture_as_pdf
                    </span> Download PDF
                </a>
            </div>
        </form>
    </div>
    <div class="hidden md:block">
        <form class="flex items-center py-3 mt-5 space-x-3 bg-white rounded-full ms-10 w-fit pe-3 ps-1" action=""
            method="post">
            @csrf
            <input class="px-3 py-1 bg-white rounded-full drop-shadow-2xl" type="date" name="start_date"
                value="{{ $startDate }}">
            <span>to</span>
            <input class="px-3 py-1 bg-white rounded-full drop-shadow-2xl" type="date" name="end_date"
                value="{{ $endDate }}">
            <a href="/akumulasi" class="flex justify-center px-3 py-1 bg-white rounded-full drop-shadow-2xl" type="reset">
                <span class="material-symbols-outlined">
                    restart_alt
                </span> Reset
            </a>
            <button
                class="flex justify-center px-5 py-1 font-medium text-white rounded-full text-md bg-gradient-red drop-shadow-2xl"
                type="submit"><span class="text-base font-bold material-symbols-outlined pe-2">
                    filter_alt
                </span> Filter</button>
            <a href="/akumulasi/print/{{ $startDate && $endDate != ' ' ? $startDate . '/' . $endDate : ' ' }}"
                class="flex justify-center px-5 py-1 font-medium text-white rounded-full text-md bg-gradient-red drop-shadow-2xl"><span
                    class="material-symbols-outlined pe-2">
                    picture_as_pdf
                </span> Download PDF</a>
        </form>
    </div>

    <div class="w-full px-5 my-8 md:px-10">
        <div class="w-full p-8 bg-white rounded-xl">
            <div class="flex mb-2">
                <div>
                    <span class="p-1 font-bold text-white rounded-full bg-gradient-red material-symbols-outlined">
                        filter_alt
                    </span>
                </div>
                <div class="p-1">
                    <span>
                        Akumulasi Data Selama {{ $startDate && $endDate != ' ' ? $daysDifference : '30' }} hari
                        terakhir
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl"
                    id="daerah">
                    <div class="flex items-center justify-between text-sm font-medium">
                        <span class="flex items-center">
                            <span class="material-symbols-outlined me-2">public</span> Akumulasi Daerah
                        </span>
                        <span class="icon-container" onclick="openDaerah();">
                            <span
                                class="text-lg text-gray-600 material-symbols-outlined cursor-copy hover:text-xl hover:text-black">center_focus_strong</span>
                        </span>
                    </div>
                    <canvas id="cDaerah"></canvas>
                </div>

                <div class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl"
                    id="gender">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">wc
                        </span> Akumulasi Gender</span>
                    <span class="icon-container" onclick="openGender();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined cursor-copy hover:text-xl hover:text-black">center_focus_strong</span>
                    </span>
                    <canvas id="cGender"></canvas>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl"
                    id="usia">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">cake
                        </span> Akumulasi Usia</span>
                    <span class="icon-container" onclick="openUsia();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined cursor-copy hover:text-xl hover:text-black">center_focus_strong</span>
                    </span>
                    <canvas id="cUsia"></canvas>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl"
                    id="pendidikan">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">school
                        </span> Akumulasi Pendidikan</span>
                    <span class="icon-container" onclick="openPendidikan();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined cursor-copy hover:text-xl hover:text-black">center_focus_strong</span>
                    </span>
                    <canvas id="cEdu"></canvas>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl"
                    id="pekerjaan">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">work
                        </span> Akumulasi Pekerjaan</span>
                    <span class="icon-container" onclick="openPekerjaan();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined cursor-copy hover:text-xl hover:text-black">center_focus_strong</span>
                    </span>
                    <canvas id="cJob"></canvas>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl"
                    id="jenis">
                    <span class="flex items-center text-sm font-medium"><span
                            class="material-symbols-outlined me-2">apartment
                        </span> Akumulasi Jenis Tamu</span>
                    <span class="icon-container" onclick="openJenis();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined cursor-copy hover:text-xl hover:text-black">center_focus_strong</span>
                    </span>
                    <canvas id="cType"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const daerah = document.getElementById('cDaerah');
        const gender = document.getElementById('cGender');
        const usia = document.getElementById('cUsia');
        const edu = document.getElementById('cEdu');
        const job = document.getElementById('cJob');
        const type = document.getElementById('cType');

        new Chart(daerah, {
            type: 'line',
            data: {
                datasets: [{
                        label: 'Tegal',
                        data: @json($region['tegal']['trafik']),
                        backgroundColor: 'rgba(255, 99, 132, 0.8)'
                    },
                    {
                        label: 'Slawi',
                        data: @json($region['slawi']['trafik']),
                        backgroundColor: 'rgba(54, 162, 235, 0.8)'
                    },
                    {
                        label: 'Brebes',
                        data: @json($region['brebes']['trafik']),
                        backgroundColor: 'rgba(255, 206, 86, 0.8)'
                    },
                    {
                        label: 'Pemalang',
                        data: @json($region['pemalang']['trafik']),
                        backgroundColor: 'rgba(75, 192, 192, 0.8)'
                    },
                    {
                        label: 'Jateng',
                        data: @json($region['jateng']['trafik']),
                        backgroundColor: 'rgba(153, 102, 255, 0.8)'
                    },
                    {
                        label: 'Luar Jateng',
                        data: @json($region['luarJateng']['trafik']),
                        backgroundColor: 'rgba(255, 159, 64, 0.8)'
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(gender, {
            type: 'line',
            data: {
                datasets: [{
                        label: 'Laki-Laki',
                        data: @json($gender['male']['trafik']),
                        backgroundColor: 'rgba(54, 162, 235, 0.8)'
                    },
                    {
                        label: 'Perempuan',
                        data: @json($gender['female']['trafik']),
                        backgroundColor: 'rgba(255, 99, 132, 0.8)'
                    },
                    {
                        label: 'Tidak Menyebutkan',
                        data: @json($gender['none']['trafik']),
                        backgroundColor: 'rgba(255, 206, 86, 0.8)'
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(usia, {
            type: 'line',
            data: {
                datasets: [{
                        label: '18-25',
                        data: @json($birth_date['u18_25']['trafik']),
                        backgroundColor: 'rgba(255, 99, 132, 0.8)'
                    },
                    {
                        label: '26-35',
                        data: @json($birth_date['u26_35']['trafik']),
                        backgroundColor: 'rgba(54, 162, 235, 0.8)'
                    },
                    {
                        label: '36-50',
                        data: @json($birth_date['u36_50']['trafik']),
                        backgroundColor: 'rgba(255, 206, 86, 0.8)'
                    },
                    {
                        label: '51-60',
                        data: @json($birth_date['u51_60']['trafik']),
                        backgroundColor: 'rgba(75, 192, 192, 0.8)'
                    },
                    {
                        label: '60+',
                        data: @json($birth_date['lansia']['trafik']),
                        backgroundColor: 'rgba(153, 102, 255, 0.8)'
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(edu, {
            type: 'line',
            data: {
                datasets: [{
                        label: 'Tidak Sekolah',
                        data: @json($education['ts']['trafik']),
                        backgroundColor: 'rgba(255, 206, 86, 0.8)'
                    },
                    {
                        label: 'SD',
                        data: @json($education['sd']['trafik']),
                        backgroundColor: 'rgba(127, 17, 22, 0.8)'
                    },
                    {
                        label: 'SMP/MTS',
                        data: @json($education['smp']['trafik']),
                        backgroundColor: 'rgba(20, 24, 60, 0.8)'
                    },
                    {
                        label: 'SMA/SMU',
                        data: @json($education['sma']['trafik']),
                        backgroundColor: 'rgba(82, 116, 166, 0.8)'
                    },
                    {
                        label: 'Perguruan Tinggi',
                        data: @json($education['pt']['trafik']),
                        backgroundColor: 'rgba(32, 25, 36, 0.8)'
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(job, {
            type: 'line',
            data: {
                datasets: [{
                        label: 'Wiraswasta',
                        data: @json($work['wiraswasta']['trafik']),
                        backgroundColor: 'rgba(255, 99, 132, 0.8)'
                    },
                    {
                        label: 'PNS',
                        data: @json($work['pns']['trafik']),
                        backgroundColor: 'rgba(54, 162, 235, 0.8)'
                    },
                    {
                        label: 'TNI/Polri',
                        data: @json($work['tniPolri']['trafik']),
                        backgroundColor: 'rgba(255, 206, 86, 0.8)'
                    },
                    {
                        label: 'Guru',
                        data: @json($work['guru']['trafik']),
                        backgroundColor: 'rgba(75, 192, 192, 0.8)'
                    },
                    {
                        label: 'Pelajar',
                        data: @json($work['pelajar']['trafik']),
                        backgroundColor: 'rgba(153, 102, 255, 0.8)'
                    },
                    {
                        label: 'Freelancer',
                        data: @json($work['freelancer']['trafik']),
                        backgroundColor: 'rgba(255, 159, 64, 0.8)'
                    },
                    {
                        label: 'Buruh',
                        data: @json($work['buruh']['trafik']),
                        backgroundColor: 'rgba(220, 20, 60, 0.8)'
                    },
                    {
                        label: 'Petani',
                        data: @json($work['petani']['trafik']),
                        backgroundColor: 'rgba(65, 105, 225, 0.8)'
                    },
                    {
                        label: 'Nelayan',
                        data: @json($work['nelayan']['trafik']),
                        backgroundColor: 'rgba(255, 140, 0, 0.8)'
                    },
                    {
                        label: 'Pedagang',
                        data: @json($work['pedagang']['trafik']),
                        backgroundColor: 'rgba(60, 179, 113, 0.8)'
                    },
                    {
                        label: 'Pengusaha',
                        data: @json($work['pengusaha']['trafik']),
                        backgroundColor: 'rgba(128, 0, 128, 0.8)'
                    },
                    {
                        label: 'Tidak Bekerja',
                        data: @json($work['tidakBekerja']['trafik']),
                        backgroundColor: 'rgba(255, 69, 0, 0.8)'
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(type, {
            type: 'line',
            data: {
                datasets: [{
                        label: 'WEB',
                        data: @json($typeGuest['web']['trafik']),
                        backgroundColor: 'rgba(220, 20, 60, 0.8)'
                    },
                    {
                        label: 'Work In Guest',
                        data: @json($typeGuest['work']['trafik']),
                        backgroundColor: 'rgba(65, 105, 225, 0.8)'
                    },
                    {
                        label: 'Owner',
                        data: @json($typeGuest['owner']['trafik']),
                        backgroundColor: 'rgba(255, 140, 0, 0.8)'
                    },
                    {
                        label: 'Travel',
                        data: @json($typeGuest['travel']['trafik']),
                        backgroundColor: 'rgba(60, 179, 113, 0.8)'
                    },
                    {
                        label: 'Coorporate Family',
                        data: @json($typeGuest['coorporate']['trafik']),
                        backgroundColor: 'rgba(128, 0, 128, 0.8)'
                    },
                    {
                        label: 'Entertainment',
                        data: @json($typeGuest['entertainment']['trafik']),
                        backgroundColor: 'rgba(255, 69, 0, 0.8)'
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var elemDaerah = document.getElementById("daerah");
        var elemPendidikan = document.getElementById("pendidikan");
        var elemPekerjaan = document.getElementById("pekerjaan");
        var elemJenis = document.getElementById("jenis");
        var elemGender = document.getElementById("gender");
        var elemUsia = document.getElementById("usia");

        function openDaerah() {
            if (elemDaerah.requestFullscreen) {
                elemDaerah.requestFullscreen();
            } else if (elemDaerah.webkitRequestFullscreen) {
                elemDaerah.webkitRequestFullscreen();
            } else if (elemDaerah.msRequestFullscreen) {
                elemDaerah.msRequestFullscreen();
            }
        }

        function openPendidikan() {
            if (elemPendidikan.requestFullscreen) {
                elemPendidikan.requestFullscreen();
            } else if (elemPendidikan.webkitRequestFullscreen) {
                elemPendidikan.webkitRequestFullscreen();
            } else if (elemPendidikan.msRequestFullscreen) {
                elemPendidikan.msRequestFullscreen();
            }
        }

        function openPekerjaan() {
            if (elemPekerjaan.requestFullscreen) {
                elemPekerjaan.requestFullscreen();
            } else if (elemPekerjaan.webkitRequestFullscreen) {
                elemPekerjaan.webkitRequestFullscreen();
            } else if (elemPekerjaan.msRequestFullscreen) {
                elemPekerjaan.msRequestFullscreen();
            }
        }

        function openGender() {
            if (elemGender.requestFullscreen) {
                elemGender.requestFullscreen();
            } else if (elemGender.webkitRequestFullscreen) {
                elemGender.webkitRequestFullscreen();
            } else if (elemGender.msRequestFullscreen) {
                elemGender.msRequestFullscreen();
            }
        }

        function openUsia() {
            if (elemUsia.requestFullscreen) {
                elemUsia.requestFullscreen();
            } else if (elemUsia.webkitRequestFullscreen) {
                elemUsia.webkitRequestFullscreen();
            } else if (elemUsia.msRequestFullscreen) {
                elemUsia.msRequestFullscreen();
            }
        }

        function openJenis() {
            if (elemJenis.requestFullscreen) {
                elemJenis.requestFullscreen();
            } else if (elemJenis.webkitRequestFullscreen) {
                elemJenis.webkitRequestFullscreen();
            } else if (elemJenis.msRequestFullscreen) {
                elemJenis.msRequestFullscreen();
            }
        }
    </script>

    {{--
    <p>total tamu : {{ $sum }}</p>
    <p>Laki laki total : {{ $gender['male']['count'] }} = {{ $gender['male']['persen'] }} % dari keseluruhan data =
        {{ $sum }}</p>
    <p>Perempuan total : {{ $gender['female']['count'] }} = {{ $gender['female']['persen'] }} % dari keseluruhan data =
        {{ $sum }}</p>
    <p>None total : {{ $gender['none']['count'] }} = {{ $gender['none']['persen'] }} % dari keseluruhan data
        = {{ $sum }}</p>

    <div style="display: flex; margin: 5px">
        <table border="2">
            <tr>
                <th>Name</th>
                <th>Gender</th>
            </tr>
            @foreach ($gender['male']['datas'] as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->gender }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Jumlah</th>
                <td>{{ $gender['male']['count'] }}</td>
            </tr>
            <tr>
                <th>persentasi</th>
                <td>{{ $gender['male']['persen'] }} %</td>
            </tr>
        </table>
        <br>
        <table border="2" style="margin-left: 5px; margin-right: 5px">
            <tr>
                <th>Name</th>
                <th>Gender</th>
            </tr>
            @foreach ($gender['female']['datas'] as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->gender }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Jumlah</th>
                <td>{{ $gender['female']['count'] }}</td>
            </tr>
            <tr>
                <th>persentasi</th>
                <td>{{ $gender['female']['persen'] }} %</td>
            </tr>
        </table>
        <br>
        <table border="2">
            <tr>
                <th>Name</th>
                <th>Gender</th>
            </tr>
            @foreach ($gender['none']['datas'] as $row)
                <tr>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->gender }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Jumlah</th>
                <td>{{ $gender['none']['count'] }}</td>
            </tr>
            <tr>
                <th>persentasi</th>
                <td>{{ $gender['none']['persen'] }} %</td>
            </tr>
        </table>
    </div> --}}
@endsection
