@extends('layouts.app')
@section('content')
    <form class="ms-10 mt-5 flex w-fit items-center space-x-3 rounded-full bg-white py-3 pe-3 ps-1" action=""
        method="post">
        @csrf
        <input class="rounded-full bg-white px-3 py-1 drop-shadow-2xl" type="date" name="start_date"
            value="{{ $startDate }}">
        <span>to</span>
        <input class="rounded-full bg-white px-3 py-1 drop-shadow-2xl" type="date" name="end_date"
            value="{{ $endDate }}">
        <a href="/akumulasi" class="flex justify-center rounded-full bg-white px-3 py-1 drop-shadow-2xl" type="reset">
            <span class="material-symbols-outlined">
                restart_alt
            </span> Reset
        </a>
        <button
            class="text-md bg-gradient-red flex justify-center rounded-full px-5 py-1 font-medium text-white drop-shadow-2xl"
            type="submit"><span class="material-symbols-outlined pe-2 text-base font-bold">
                filter_alt
            </span> Filter</button>
        <button id="export"
            class="text-md bg-gradient-green flex justify-center rounded-full px-5 py-1 font-medium text-white drop-shadow-2xl"
            type="button"><span class="material-symbols-outlined pe-2 text-base font-bold">
                ios_share
            </span> Export</button>
    </form>

    <div class="my-8 w-full px-10">
        <div class="w-full rounded-xl bg-white p-8">
            <div class="mb-2 flex">
                <div>
                    <span class="bg-gradient-red material-symbols-outlined rounded-full p-1 font-bold text-white">
                        filter_alt
                    </span>
                </div>
                <div class="p-1">
                    <span>
                        {{-- Akummulasi Data Selama {{ $startDate && $endDate != ' ' ? $daysDifference : '30' }} hari terakhir --}}
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div
                    class="flex h-auto w-full flex-col items-center justify-center rounded-lg bg-white p-4 drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">public
                        </span> Akumulasi Daerah</span>
                    <canvas id="cDaerah"></canvas>
                </div>
                <div
                    class="flex h-auto w-full flex-col items-center justify-center rounded-lg bg-white p-4 drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">wc
                        </span> Akumulasi Gender</span>
                    <canvas id="cGender"></canvas>
                </div>
                <div
                    class="flex h-auto w-full flex-col items-center justify-center rounded-lg bg-white p-4 drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">cake
                        </span> Akumulasi Usia</span>
                    <canvas id="cUsia"></canvas>
                </div>
                <div
                    class="flex h-auto w-full flex-col items-center justify-center rounded-lg bg-white p-4 drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">school
                        </span> Akumulasi Pendidikan</span>
                    <canvas id="cEdu"></canvas>
                </div>
                <div
                    class="flex h-auto w-full flex-col items-center justify-center rounded-lg bg-white p-4 drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span class="material-symbols-outlined me-2">work
                        </span> Akumulasi Pekerjaan</span>
                    <canvas id="cJob"></canvas>
                </div>
                <div
                    class="flex h-auto w-full flex-col items-center justify-center rounded-lg bg-white p-4 drop-shadow-2xl">
                    <span class="flex items-center text-sm font-medium"><span
                            class="material-symbols-outlined me-2">apartment
                        </span> Akumulasi Jenis Tamu</span>
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
