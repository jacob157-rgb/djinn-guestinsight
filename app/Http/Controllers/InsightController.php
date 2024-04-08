<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsightController extends Controller
{
    public function index(Request $request)
    {
        $currentHour = Carbon::now()->hour;
        
        if ($currentHour < 12) {
            $greeting = 'Selamat Pagi';
        } else if ($currentHour < 15) {
            $greeting = 'Selamat Siang';
        } else if ($currentHour < 18) {
            $greeting = 'Selamat Sore';
        } else {
            $greeting = 'Selamat Malam';
        }
        
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $curr = Carbon::now()->format('g:i A');

        $sumAlls = $request->start_date && $request->end_date ? Guest::whereBetween('updated_at', [$request->start_date, $request->end_date])->count() : Guest::count();

        $data = [
            'title' => 'Insight',
            'greeting' => $greeting,
            'clock' => $curr,
            'today' => $today,
            'startDate' => $request->start_date ?? ' ',
            'endDate' => $request->end_date ?? ' ',
            'sum' => $sumAlls,
            'gender' => $this->getGender($request->start_date, $request->end_date, $sumAlls),
            'region' => $this->getRegion($request->start_date, $request->end_date, $sumAlls),
            'education' => $this->getEducation($request->start_date, $request->end_date, $sumAlls),
            'typeGuest' => $this->getTypeGuest($request->start_date, $request->end_date, $sumAlls),
            'work' => $this->getWork($request->start_date, $request->end_date, $sumAlls),
            'birth_date' => $this->getBirthDate($request->start_date, $request->end_date, $sumAlls),
        ];

        // dd($data);
        return view('v_insight.index', $data);
    }

    // Insight gender
    public function getGender($start_date, $end_date, $sumAlls)
    {
        if ($start_date && $end_date) {
            $male = Guest::where('gender', 'L')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $female = Guest::where('gender', 'P')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $none = Guest::where('gender', 'N')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
        } else {
            $male = Guest::where('gender', 'L')->get();
            $female = Guest::where('gender', 'P')->get();
            $none = Guest::where('gender', 'N')->get();

            $start_date = Carbon::now()->subDays(30)->toDateString();
            $end_date = Carbon::now()->toDateString();
        }



        $data = [
            'male' => [
                'datas' => $male,
                'persen' => $sumAlls != 0 ? (count($male) / $sumAlls) * 100 : 0,
                'count' => count($male),
            ],
            'female' => [
                'datas' => $female,
                'persen' => $sumAlls != 0 ? (count($female) / $sumAlls) * 100 : 0,
                'count' => count($female),
            ],
            'none' => [
                'datas' => $none,
                'persen' => $sumAlls != 0 ? (count($none) / $sumAlls) * 100 : 0,
                'count' => count($none),
            ],
        ];
        //dd($data);

        return $data;
    }

    // Insight daerah
    public function getRegion($start_date, $end_date, $sumAlls)
    {
        if ($start_date && $end_date) {
            $tegal = Guest::where('region', 'TEGAL')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $slawi = Guest::where('region', 'SLAWI')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $brebes = Guest::where('region', 'BREBES')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $pemalang = Guest::where('region', 'PEMALANG')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $jateng = Guest::where('region', 'JATENG')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $luarJateng = Guest::where('region', 'LUAR_JATENG')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
        } else {
            $tegal = Guest::where('region', 'TEGAL')->get();
            $slawi = Guest::where('region', 'SLAWI')->get();
            $brebes = Guest::where('region', 'BREBES')->get();
            $pemalang = Guest::where('region', 'PEMALANG')->get();
            $jateng = Guest::where('region', 'JATENG')->get();
            $luarJateng = Guest::where('region', 'LUAR_JATENG')->get();
        }

        $data = [
            'tegal' => [
                'datas' => $tegal,
                'persen' => $sumAlls != 0 ? (count($tegal) / $sumAlls) * 100 : 0,
                'count' => count($tegal),
            ],
            'slawi' => [
                'datas' => $slawi,
                'persen' => $sumAlls != 0 ? (count($slawi) / $sumAlls) * 100 : 0,
                'count' => count($slawi),
            ],
            'brebes' => [
                'datas' => $brebes,
                'persen' => $sumAlls != 0 ? (count($brebes) / $sumAlls) * 100 : 0,
                'count' => count($brebes),
            ],
            'pemalang' => [
                'datas' => $pemalang,
                'persen' => $sumAlls != 0 ? (count($pemalang) / $sumAlls) * 100 : 0,
                'count' => count($pemalang),
            ],
            'jateng' => [
                'datas' => $jateng,
                'persen' => $sumAlls != 0 ? (count($jateng) / $sumAlls) * 100 : 0,
                'count' => count($jateng),
            ],
            'luarJateng' => [
                'datas' => $luarJateng,
                'persen' => $sumAlls != 0 ? (count($luarJateng) / $sumAlls) * 100 : 0,
                'count' => count($luarJateng),
            ],
        ];

        return $data;
    }

    //Insight pendidikan
    public function getEducation($start_date, $end_date, $sumAlls)
    {
        if ($start_date && $end_date) {
            $ts = Guest::where('education', 'TS')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $sd = Guest::where('education', 'SD')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $smp = Guest::where('education', 'SMP')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $sma = Guest::where('education', 'SMA')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $pt = Guest::where('education', 'PT')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
        } else {
            $ts = Guest::where('education', 'TS')->get();
            $sd = Guest::where('education', 'SD')->get();
            $smp = Guest::where('education', 'SMP')->get();
            $sma = Guest::where('education', 'SMA')->get();
            $pt = Guest::where('education', 'PT')->get();
        }

        $data = [
            'ts' => [
                'datas' => $ts,
                'persen' => $sumAlls != 0 ? (count($ts) / $sumAlls) * 100 : 0,
                'count' => count($ts),
            ],
            'sd' => [
                'datas' => $sd,
                'persen' => $sumAlls != 0 ? (count($sd) / $sumAlls) * 100 : 0,
                'count' => count($sd),
            ],
            'smp' => [
                'datas' => $smp,
                'persen' => $sumAlls != 0 ? (count($smp) / $sumAlls) * 100 : 0,
                'count' => count($smp),
            ],
            'sma' => [
                'datas' => $sma,
                'persen' => $sumAlls != 0 ? (count($sma) / $sumAlls) * 100 : 0,
                'count' => count($sma),
            ],
            'pt' => [
                'datas' => $pt,
                'persen' => $sumAlls != 0 ? (count($pt) / $sumAlls) * 100 : 0,
                'count' => count($pt),
            ],
        ];

        return $data;
    }

    //Insight jenis tamu
    public function getTypeGuest($start_date, $end_date, $sumAlls)
    {
        if ($start_date && $end_date) {
            $web = Guest::where('type_guest', 'WEB')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $work = Guest::where('type_guest', 'WORK_IN_GUEST')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $owner = Guest::where('type_guest', 'OWNER')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $travel = Guest::where('type_guest', 'TRAVEL')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $coorporate = Guest::where('type_guest', 'COORPORATE_FAMILY')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $entertainment = Guest::where('type_guest', 'ENTERTAINMENT')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
        } else {
            $web = Guest::where('type_guest', 'WEB')->get();
            $work = Guest::where('type_guest', 'WORK_IN_GUEST')->get();
            $owner = Guest::where('type_guest', 'OWNER')->get();
            $travel = Guest::where('type_guest', 'TRAVEL')->get();
            $coorporate = Guest::where('type_guest', 'COORPORATE_FAMILY')->get();
            $entertainment = Guest::where('type_guest', 'ENTERTAINMENT')->get();
        }

        $data = [
            'web' => [
                'datas' => $web,
                'persen' => $sumAlls != 0 ? (count($web) / $sumAlls) * 100 : 0,
                'count' => count($web),
            ],
            'work' => [
                'datas' => $work,
                'persen' => $sumAlls != 0 ? (count($work) / $sumAlls) * 100 : 0,
                'count' => count($work),
            ],
            'owner' => [
                'datas' => $owner,
                'persen' => $sumAlls != 0 ? (count($owner) / $sumAlls) * 100 : 0,
                'count' => count($owner),
            ],
            'travel' => [
                'datas' => $travel,
                'persen' => $sumAlls != 0 ? (count($travel) / $sumAlls) * 100 : 0,
                'count' => count($travel),
            ],
            'coorporate' => [
                'datas' => $coorporate,
                'persen' => $sumAlls != 0 ? (count($coorporate) / $sumAlls) * 100 : 0,
                'count' => count($coorporate),
            ],
            'entertainment' => [
                'datas' => $entertainment,
                'persen' => $sumAlls != 0 ? (count($entertainment) / $sumAlls) * 100 : 0,
                'count' => count($entertainment),
            ],
        ];

        return $data;
    }

    //Insight Usia
    public function getBirthDate($start_date, $end_date, $sumAlls)
    {
        if ($start_date && $end_date) {
            $u18_25 = Guest::whereBetween('updated_at', [$start_date, $end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 25')
                ->get();
            $u26_35 = Guest::whereBetween('updated_at', [$start_date, $end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 26 AND 35')
                ->get();
            $u36_50 = Guest::whereBetween('updated_at', [$start_date, $end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 36 AND 50')
                ->get();
            $u51_60 = Guest::whereBetween('updated_at', [$start_date, $end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 51 AND 60')
                ->get();
            $lansia = Guest::whereBetween('updated_at', [$start_date, $end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > 60')
                ->get();
        } else {
            $u18_25 = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 25')->get();
            $u26_35 = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 26 AND 35')->get();
            $u36_50 = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 36 AND 50')->get();
            $u51_60 = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 51 AND 60')->get();
            $lansia = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > 60')->get();
        }

        $data = [
            'u18_25' => [
                'datas' => $u18_25,
                'persen' => $sumAlls != 0 ? (count($u18_25) / $sumAlls) * 100 : 0,
                'count' => count($u18_25),
            ],
            'u26_35' => [
                'datas' => $u26_35,
                'persen' => $sumAlls != 0 ? (count($u26_35) / $sumAlls) * 100 : 0,
                'count' => count($u26_35),
            ],
            'u36_50' => [
                'datas' => $u36_50,
                'persen' => $sumAlls != 0 ? (count($u36_50) / $sumAlls) * 100 : 0,
                'count' => count($u36_50),
            ],
            'u51_60' => [
                'datas' => $u51_60,
                'persen' => $sumAlls != 0 ? (count($u51_60) / $sumAlls) * 100 : 0,
                'count' => count($u51_60),
            ],
            'lansia' => [
                'datas' => $lansia,
                'persen' => $sumAlls != 0 ? (count($lansia) / $sumAlls) * 100 : 0,
                'count' => count($lansia),
            ],
        ];

        return $data;
    }

    //Insight pekerjaan
    public function getWork($start_date, $end_date, $sumAlls)
    {
        if ($start_date && $end_date) {
            $wiraswasta = Guest::where('work', 'WIRASWASTA')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $pns = Guest::where('work', 'PNS')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $tniPolri = Guest::where('work', 'TNI_POLRI')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $guru = Guest::where('work', 'GURU')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $pelajar = Guest::where('work', 'PELAJAR')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $freelancer = Guest::where('work', 'FREELANCER')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $buruh = Guest::where('work', 'BURUH')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $petani = Guest::where('work', 'PETANI')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $nelayan = Guest::where('work', 'NELAYAN')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $pedagang = Guest::where('work', 'PEDAGANG')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $pengusaha = Guest::where('work', 'PENGUSAHA')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
            $tidakBekerja = Guest::where('work', 'TIDAK_BEKERJA')
                ->whereBetween('updated_at', [$start_date, $end_date])
                ->get();
        } else {
            $wiraswasta = Guest::where('work', 'WIRASWASTA')->get();
            $pns = Guest::where('work', 'PNS')->get();
            $tniPolri = Guest::where('work', 'TNI_POLRI')->get();
            $guru = Guest::where('work', 'GURU')->get();
            $pelajar = Guest::where('work', 'PELAJAR')->get();
            $freelancer = Guest::where('work', 'FREELANCER')->get();
            $buruh = Guest::where('work', 'BURUH')->get();
            $petani = Guest::where('work', 'PETANI')->get();
            $nelayan = Guest::where('work', 'NELAYAN')->get();
            $pedagang = Guest::where('work', 'PEDAGANG')->get();
            $pengusaha = Guest::where('work', 'PENGUSAHA')->get();
            $tidakBekerja = Guest::where('work', 'TIDAK_BEKERJA')->get();
        }
        $data = [
            'wiraswasta' => [
                'datas' => $wiraswasta,
                'persen' => $sumAlls != 0 ? (count($wiraswasta) / $sumAlls) * 100 : 0,
                'count' => count($wiraswasta),
            ],
            'pns' => [
                'datas' => $pns,
                'persen' => $sumAlls != 0 ? (count($pns) / $sumAlls) * 100 : 0,
                'count' => count($pns),
            ],
            'tniPolri' => [
                'datas' => $tniPolri,
                'persen' => $sumAlls != 0 ? (count($tniPolri) / $sumAlls) * 100 : 0,
                'count' => count($tniPolri),
            ],
            'guru' => [
                'datas' => $guru,
                'persen' => $sumAlls != 0 ? (count($guru) / $sumAlls) * 100 : 0,
                'count' => count($guru),
            ],
            'pelajar' => [
                'datas' => $pelajar,
                'persen' => $sumAlls != 0 ? (count($pelajar) / $sumAlls) * 100 : 0,
                'count' => count($pelajar),
            ],
            'freelancer' => [
                'datas' => $freelancer,
                'persen' => $sumAlls != 0 ? (count($freelancer) / $sumAlls) * 100 : 0,
                'count' => count($freelancer),
            ],
            'buruh' => [
                'datas' => $buruh,
                'persen' => $sumAlls != 0 ? (count($buruh) / $sumAlls) * 100 : 0,
                'count' => count($buruh),
            ],
            'petani' => [
                'datas' => $petani,
                'persen' => $sumAlls != 0 ? (count($petani) / $sumAlls) * 100 : 0,
                'count' => count($petani),
            ],
            'nelayan' => [
                'datas' => $nelayan,
                'persen' => $sumAlls != 0 ? (count($nelayan) / $sumAlls) * 100 : 0,
                'count' => count($nelayan),
            ],
            'pedagang' => [
                'datas' => $pedagang,
                'persen' => $sumAlls != 0 ? (count($pedagang) / $sumAlls) * 100 : 0,
                'count' => count($pedagang),
            ],
            'pengusaha' => [
                'datas' => $pengusaha,
                'persen' => $sumAlls != 0 ? (count($pengusaha) / $sumAlls) * 100 : 0,
                'count' => count($pengusaha),
            ],
            'tidakBekerja' => [
                'datas' => $tidakBekerja,
                'persen' => $sumAlls != 0 ? (count($tidakBekerja) / $sumAlls) * 100 : 0,
                'count' => count($tidakBekerja),
            ],
        ];

        return $data;
    }
}
