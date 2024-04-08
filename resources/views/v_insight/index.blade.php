@extends('layouts.app')
@section('content')
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
        <button
            class="flex justify-center px-5 py-1 font-medium text-white rounded-full text-md bg-gradient-green drop-shadow-2xl"
            type="button"><span class="text-base font-bold material-symbols-outlined pe-2">
                ios_share
            </span> Export</button>
    </form>
    <div class="w-full px-10 mt-8">
        <div class="w-full p-8 bg-white rounded-xl">
            <div class="grid grid-cols-2 gap-3">
                <div
                    class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">public
                        </span> Klasifikasi Daerah</span>
                    <canvas id="cDaerah"></canvas>
                </div>
                <div
                    class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">wc
                        </span> Klasifikasi Gender</span>
                    <canvas id="cGender"></canvas>
                </div>
                <div
                    class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">cake
                        </span> Klasifikasi Usia</span>
                    <canvas id="cUsia"></canvas>
                </div>
                <div
                    class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">school
                        </span> Klasifikasi Pendidikan</span>
                    <canvas id="cEdu"></canvas>
                </div>
                <div
                    class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">work
                        </span> Klasifikasi Pekerjaan</span>
                    <canvas id="cJob"></canvas>
                </div>
                <div
                    class="flex flex-col items-center justify-center w-full h-auto p-4 bg-white rounded-lg drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span
                            class="material-symbols-outlined me-2">apartment
                        </span> Klasifikasi Jenis Tamu</span>
                    <canvas id="cType"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        'rgba(220, 20, 60, 0.8)', 'rgba(65, 105, 225, 0.8)', 'rgba(255, 140, 0, 0.8)',
                        'rgba(60, 179, 113, 0.8)', 'rgba(128, 0, 128, 0.8)', 'rgba(255, 69, 0, 0.8)'
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
