@extends('layouts.app')
@section('content')
    <div class="block px-5 md:hidden">
        <form class="flex flex-col px-3 py-5 mt-5 space-x-2 space-y-2 bg-white rounded-xl" action="" method="post">
            @csrf
            <input class="px-3 py-2 bg-white rounded-full shadow-md" type="date" name="start_date"
                value="{{ $startDate }}">
            <span class="text-center">to</span>
            <input class="px-3 py-2 bg-white rounded-full shadow-md" type="date" name="end_date"
                value="{{ $endDate }}">
            <div class="flex flex-row items-center justify-between space-x-2">
                <button
                    class="justify-center flex-1 px-5 py-2 font-medium text-white rounded-full shadow-md text-md bg-gradient-red"
                    type="submit">
                    <span class="text-base font-bold material-symbols-outlined">
                        filter_alt
                    </span> Filter
                </button>
                <button id="export"
                    class="export justify-center flex-1 px-5 py-2 font-medium text-white rounded-full shadow-md text-md bg-gradient-green"
                    type="button">
                    <span class="text-base font-bold material-symbols-outlined">
                        ios_share
                    </span> Export
                </button>
            </div>
            <a href="/insight"
                class="flex justify-center px-5 py-2 font-medium text-white rounded-full shadow-md bg-gradient-blue"
                type="reset">
                <span class="text-base font-bold material-symbols-outlined">
                    restart_alt
                </span> Reset
            </a>
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
            <a href="/insight" class="flex justify-center px-3 py-1 bg-white rounded-full drop-shadow-2xl" type="reset">
                <span class="material-symbols-outlined">
                    restart_alt
                </span> Reset
            </a>
            <button
                class="flex justify-center px-5 py-1 font-medium text-white rounded-full text-md bg-gradient-red drop-shadow-2xl"
                type="submit"><span class="text-base font-bold material-symbols-outlined pe-2">
                    filter_alt
                </span> Filter</button>
            <button id="export"
                class="export flex justify-center px-5 py-1 font-medium text-white rounded-full text-md bg-gradient-green drop-shadow-2xl"
                type="button"><span class="text-base font-bold material-symbols-outlined pe-2">
                    ios_share
                </span> Export</button>
        </form>
    </div>

    <div id="modalExport" style="display: none;"
        class="modalExport flex flex-col max-w-xl p-8 m-auto mt-5 text-gray-800 shadow-sm rounded-xl bg-gray-50 lg:p-12">
        <form action="/insight/export" method="post">
            @csrf
            <div class="flex flex-col w-full">
                <label class="w-1/5" for="name">FileName :</label>
                <input class="w-4/5 p-2 border border-black rounded-lg" type="text" id="filename" name="filename"
                    required value="{{ old('filename') }}"><br>
                <div class="flex">
                    <input class="px-3 py-1 bg-white rounded-lg drop-shadow-2xl" type="date" name="start_date_export"
                        value="">
                    <span
                        class="px-3 py-1 mx-2 font-semibold text-white rounded-lg bg-gradient-red drop-shadow-2xl">to</span>
                    <input class="px-3 py-1 bg-white rounded-lg drop-shadow-2xl" type="date" name="end_date_export"
                        value="">
                </div>
                <button
                    class="flex justify-center w-40 px-5 py-1 mt-5 ml-auto font-medium text-white rounded-lg text-md bg-gradient-red drop-shadow-2xl"
                    type="submit"><span class="text-base font-bold material-symbols-outlined pe-2">
                        download
                    </span> Download</button>
            </div>
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
                        Data Selama {{ $startDate && $endDate != ' ' ? $daysDifference : '30' }} hari terakhir
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

        $(document).ready(function() {
            $(".export").click(function() {
                $(".modalExport").toggle();
            });
        });

        new Chart(daerah, {
            type: 'bar',
            data: {
                labels: ['TEGAL', 'SLAWI', 'BREBES', 'PEMALANG', 'JATENG', 'LUAR JATENG'],
                datasets: [{
                    label: '',
                    data: [{{ $region['tegal']['count'] }}, {{ $region['slawi']['count'] }},
                        {{ $region['brebes']['count'] }}, {{ $region['pemalang']['count'] }},
                        {{ $region['jateng']['count'] }}, {{ $region['luarJateng']['count'] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
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
            type: 'bar',
            data: {
                labels: ['Laki-Laki', 'Perempuan', 'Tidak Menyebutkan'], // Menambahkan label gender
                datasets: [{
                    label: '',
                    data: [
                        {{ $gender['male']['count'] }}, // Jumlah laki-laki
                        {{ $gender['female']['count'] }}, // Jumlah perempuan
                        {{ $gender['none']['count'] }} // Jumlah tidak menyebutkan
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 206, 86, 0.8)'
                    ]
                }]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    legend: {
                        display: false
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
            type: 'bar',
            data: {
                labels: ['18-25', '26-35', '36-50', '51-60', '60+'],
                datasets: [{
                    label: '',
                    data: [{{ $birth_date['u18_25']['count'] }}, {{ $birth_date['u26_35']['count'] }},
                        {{ $birth_date['u36_50']['count'] }}, {{ $birth_date['u51_60']['count'] }},
                        {{ $birth_date['lansia']['count'] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
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
            type: 'bar',
            data: {
                labels: ['Tidak Sekolah', 'SD', 'SMP/MTS', 'SMA/SMU', 'Perguruan Tinggi'],
                datasets: [{
                    label: '',
                    data: [{{ $education['ts']['count'] }}, {{ $education['sd']['count'] }},
                        {{ $education['smp']['count'] }}, {{ $education['sma']['count'] }},
                        {{ $education['pt']['count'] }},
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(127, 17, 22, 0.8)',
                        'rgba(20, 24, 60, 0.8)',
                        'rgba(82, 116, 166, 0.8)',
                        'rgba(32, 25, 36, 0.8)'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
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
            type: 'bar',
            data: {
                labels: ['WIRASWASTA', 'PNS', 'TNI/POLRI', 'GURU', 'PELAJAR', 'FREELANCER', 'BURUH', 'PETANI',
                    'NELAYAN', 'PEDAGANG', 'PENGUSAHA', 'TIDAK BEKERJA'
                ],
                datasets: [{
                    label: '',
                    data: [{{ $work['wiraswasta']['count'] }}, {{ $work['pns']['count'] }},
                        {{ $work['tniPolri']['count'] }},
                        {{ $work['guru']['count'] }}, {{ $work['pelajar']['count'] }},
                        {{ $work['freelancer']['count'] }},
                        {{ $work['buruh']['count'] }}, {{ $work['petani']['count'] }},
                        {{ $work['nelayan']['count'] }},
                        {{ $work['pedagang']['count'] }}, {{ $work['pengusaha']['count'] }},
                        {{ $work['tidakBekerja']['count'] }},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)', 'rgba(220, 20, 60, 0.8)', 'rgba(65, 105, 225, 0.8)',
                        'rgba(255, 140, 0, 0.8)', 'rgba(60, 179, 113, 0.8)', 'rgba(128, 0, 128, 0.8)',
                        'rgba(255, 69, 0, 0.8)'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
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
            type: 'bar',
            data: {
                labels: ['WEB', 'WORK IN GUEST', 'OWNER', 'TRAVEL', 'COORPORATE FAMILY', 'ENTERTAINMENT'],
                datasets: [{
                    label: '',
                    data: [{{ $typeGuest['web']['count'] }}, {{ $typeGuest['work']['count'] }},
                        {{ $typeGuest['owner']['count'] }}, {{ $typeGuest['travel']['count'] }},
                        {{ $typeGuest['coorporate']['count'] }},
                        {{ $typeGuest['entertainment']['count'] }}
                    ],
                    backgroundColor: [

                        'rgba(220, 20, 60, 0.8)',
                        'rgba(65, 105, 225, 0.8)',
                        'rgba(255, 140, 0, 0.8)',

                        'rgba(60, 179, 113, 0.8)',
                        'rgba(128, 0, 128, 0.8)',
                        'rgba(255, 69, 0, 0.8)'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
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



@endsection
