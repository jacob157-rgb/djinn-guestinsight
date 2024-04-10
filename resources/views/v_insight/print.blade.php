<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @notifyCss

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">


    <title>Document</title>
</head>

<body>

    <style>
        .icon-container {
            position: absolute;
            top: 0px;
            right: 0px;
            padding: 2px;
        }

        @media print {
            @page {
                margin: 0;
                size: landscape;
            }

            body {
                margin: 0;
            }

            .back {
                display: none;
            }
        }
    </style>


    <div class="w-full px-1 ">
        <div class="w-full p-8 bg-white rounded-xl">
            <a href="/akumulasi"
                class="flex justify-center w-24 px-5 py-1 m-5 font-medium text-white rounded-full back text-md bg-gradient-red drop-shadow-2xl">Kembali</a>
            <div class="flex mb-2">
                <div>
                    <span class="p-1 font-bold text-white rounded-full bg-gradient-red material-symbols-outlined">
                        filter_alt
                    </span>
                </div>
                <div class="p-1">
                    <span>
                        Akummulasi Data Selama {{ $startDate && $endDate != ' ' ? $daysDifference : '30' }} hari
                        terakhir
                    </span>
                </div>
            </div>
            <div class="grid">
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 mb-5 bg-white rounded-lg drop-shadow-2xl"
                    id="daerah">
                    <div class="flex items-center justify-between text-sm font-medium">
                        <span class="flex items-center">
                            <span class="material-symbols-outlined me-2">public</span> Akumulasi Daerah
                        </span>
                        <span class="icon-container" onclick="openDaerah();">
                            <span
                                class="text-lg text-gray-600 material-symbols-outlined hover:text-black cursor-copy hover:text-xl">center_focus_strong</span>
                        </span>
                    </div>
                    <canvas id="cDaerah"></canvas>
                </div>

                <div class="flex flex-col items-center justify-center w-full h-auto p-4 mb-5 bg-white rounded-lg drop-shadow-2xl"
                    id="gender">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">wc
                        </span> Akumulasi Gender</span>
                    <span class="icon-container" onclick="openGender();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined hover:text-black cursor-copy hover:text-xl">center_focus_strong</span>
                    </span>
                    <canvas id="cGender"></canvas>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 mb-5 bg-white rounded-lg drop-shadow-2xl"
                    id="usia">
                    <span class="flex items-center text-sm font-medium"><span
                            class="material-symbols-outlined me-2">cake
                        </span> Akumulasi Usia</span>
                    <span class="icon-container" onclick="openUsia();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined hover:text-black cursor-copy hover:text-xl">center_focus_strong</span>
                    </span>
                    <canvas id="cUsia"></canvas>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 mb-5 bg-white rounded-lg drop-shadow-2xl"
                    id="pendidikan">
                    <span class="flex items-center text-sm font-medium"><span
                            class="material-symbols-outlined me-2">school
                        </span> Akumulasi Pendidikan</span>
                    <span class="icon-container" onclick="openPendidikan();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined hover:text-black cursor-copy hover:text-xl">center_focus_strong</span>
                    </span>
                    <canvas id="cEdu"></canvas>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 mb-5 bg-white rounded-lg drop-shadow-2xl"
                    id="pekerjaan">
                    <span class="flex items-center text-sm font-medium"><span
                            class="material-symbols-outlined me-2">work
                        </span> Akumulasi Pekerjaan</span>
                    <span class="icon-container" onclick="openPekerjaan();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined hover:text-black cursor-copy hover:text-xl">center_focus_strong</span>
                    </span>
                    <canvas id="cJob"></canvas>
                </div>
                <div class="flex flex-col items-center justify-center w-full h-auto p-4 mb-5 bg-white rounded-lg drop-shadow-2xl"
                    id="jenis">
                    <span class="flex items-center text-sm font-medium"><span
                            class="material-symbols-outlined me-2">apartment
                        </span> Akumulasi Jenis Tamu</span>
                    <span class="icon-container" onclick="openJenis();">
                        <span
                            class="text-lg text-gray-600 material-symbols-outlined hover:text-black cursor-copy hover:text-xl">center_focus_strong</span>
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

        window.print()
    </script>



</body>

</html>
