<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkumulasiController extends Controller
{
    public function index(Request $request)
    {
        $sumAlls = $request->start_date && $request->end_date ? Guest::whereBetween('updated_at', [$request->start_date, $request->end_date])->count() : Guest::count();

        $data = [
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

        dd($data);
        return view('v_akumulasi.index', $data);
    }

    // Klasifikasi gender
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


        $trafik_male = [];
        $trafik_female = [];
        $trafik_none = [];

        while ($start_date <= $end_date) {
            $maleData = Guest::where('gender', 'L')->whereDate('updated_at', $start_date)->get();
            $femaleData = Guest::where('gender', 'P')->whereDate('updated_at', $start_date)->get();
            $noneData = Guest::where('gender', 'N')->whereDate('updated_at', $start_date)->get();

            $male_count = count($maleData);
            $female_count = count($femaleData);
            $none_count = count($noneData);

            $formatted_date = date('m-d-Y', strtotime($start_date));

            $trafik_male[$formatted_date] = $male_count;
            $trafik_female[$formatted_date] = $female_count;
            $trafik_none[$formatted_date] = $none_count;

            $start_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
        }

        $data = [
            'male' => [
                'datas' => $male,
                'persen' => $sumAlls != 0 ? (count($male) / $sumAlls) * 100 : 0,
                'count' => count($male),
                'trafik' => $trafik_male,
            ],
            'female' => [
                'datas' => $female,
                'persen' => $sumAlls != 0 ? (count($female) / $sumAlls) * 100 : 0,
                'count' => count($female),
                'trafik' => $trafik_female,
            ],
            'none' => [
                'datas' => $none,
                'persen' => $sumAlls != 0 ? (count($none) / $sumAlls) * 100 : 0,
                'count' => count($none),
                'trafik' => $trafik_none,
            ],
        ];
        //dd($data);

        return $data;
    }

    // Klasifikasi daerah
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

            $start_date = Carbon::now()->subDays(30)->toDateString();
            $end_date = Carbon::now()->toDateString();
        }

        $trafik_tegal = [];
        $trafik_slawi = [];
        $trafik_brebes = [];
        $trafik_pemalang = [];
        $trafik_jateng = [];
        $trafik_luarJateng = [];

        while ($start_date <= $end_date) {
            $tegalData = Guest::where('region', 'TEGAL')->whereDate('updated_at', $start_date)->get();
            $slawiData = Guest::where('region', 'SLAWI')->whereDate('updated_at', $start_date)->get();
            $brebesData = Guest::where('region', 'BREBES')->whereDate('updated_at', $start_date)->get();
            $pemalangData = Guest::where('region', 'PEMALANG')->whereDate('updated_at', $start_date)->get();
            $jatengData = Guest::where('region', 'JATENG')->whereDate('updated_at', $start_date)->get();
            $luarJatengData = Guest::where('region', 'LUAR_JATENG')->whereDate('updated_at', $start_date)->get();

            $tegal_countData = count($tegalData);
            $slawi_countData = count($slawiData);
            $brebes_countData = count($brebesData);
            $pemalang_countData = count($pemalangData);
            $jateng_countData = count($jatengData);
            $luarJateng_countData = count($luarJatengData);

            $formatted_date = date('m-d-Y', strtotime($start_date));

            $trafik_tegal[$formatted_date] = $tegal_countData;
            $trafik_slawi[$formatted_date] = $slawi_countData;
            $trafik_brebes[$formatted_date] = $brebes_countData;
            $trafik_pemalang[$formatted_date] = $pemalang_countData;
            $trafik_jateng[$formatted_date] = $jateng_countData;
            $trafik_luarJateng[$formatted_date] = $luarJateng_countData;

            $start_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
        }
        $data = [
            'tegal' => [
                'datas' => $tegal,
                'persen' => $sumAlls != 0 ? (count($tegal) / $sumAlls) * 100 : 0,
                'count' => count($tegal),
                'trafik' => $trafik_tegal,
            ],
            'slawi' => [
                'datas' => $slawi,
                'persen' => $sumAlls != 0 ? (count($slawi) / $sumAlls) * 100 : 0,
                'count' => count($slawi),
                'trafik' => $trafik_slawi,
            ],
            'brebes' => [
                'datas' => $brebes,
                'persen' => $sumAlls != 0 ? (count($brebes) / $sumAlls) * 100 : 0,
                'count' => count($brebes),
                'trafik' => $trafik_brebes,
            ],
            'pemalang' => [
                'datas' => $pemalang,
                'persen' => $sumAlls != 0 ? (count($pemalang) / $sumAlls) * 100 : 0,
                'count' => count($pemalang),
                'trafik' => $trafik_pemalang,
            ],
            'jateng' => [
                'datas' => $jateng,
                'persen' => $sumAlls != 0 ? (count($jateng) / $sumAlls) * 100 : 0,
                'count' => count($jateng),
                'trafik' => $trafik_jateng,
            ],
            'luarJateng' => [
                'datas' => $luarJateng,
                'persen' => $sumAlls != 0 ? (count($luarJateng) / $sumAlls) * 100 : 0,
                'count' => count($luarJateng),
                'trafik' => $trafik_luarJateng,
            ],
        ];

        return $data;
    }

    //klasifikasi pendidikan
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

            $start_date = Carbon::now()->subDays(30)->toDateString();
            $end_date = Carbon::now()->toDateString();
        }

        $trafik_ts = [];
        $trafik_sd = [];
        $trafik_smp = [];
        $trafik_sma = [];
        $trafik_pt = [];

        while ($start_date <= $end_date) {

            $tsData = Guest::where('education', 'TS')->whereDate('updated_at', $start_date)->get();
            $sdData = Guest::where('education', 'SD')->whereDate('updated_at', $start_date)->get();
            $smpData = Guest::where('education', 'SMP')->whereDate('updated_at', $start_date)->get();
            $smaData = Guest::where('education', 'SMA')->whereDate('updated_at', $start_date)->get();
            $ptData = Guest::where('education', 'PT')->whereDate('updated_at', $start_date)->get();

            $ts_count = count($tsData);
            $sd_count = count($sdData);
            $smp_count = count($smpData);
            $sma_count = count($smaData);
            $pt_count = count($ptData);

            $formatted_date = date('m-d-Y', strtotime($start_date));

            $trafik_ts[$formatted_date] = $ts_count;
            $trafik_sd[$formatted_date] = $sd_count;
            $trafik_smp[$formatted_date] = $smp_count;
            $trafik_sma[$formatted_date] = $sma_count;
            $trafik_pt[$formatted_date] = $pt_count;


            $start_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
        }


        $data = [
            'ts' => [
                'datas' => $ts,
                'persen' => $sumAlls != 0 ? (count($ts) / $sumAlls) * 100 : 0,
                'count' => count($ts),
                'trafik' => $trafik_ts,
            ],
            'sd' => [
                'datas' => $sd,
                'persen' => $sumAlls != 0 ? (count($sd) / $sumAlls) * 100 : 0,
                'count' => count($sd),
                'trafik' => $trafik_sd,
            ],
            'smp' => [
                'datas' => $smp,
                'persen' => $sumAlls != 0 ? (count($smp) / $sumAlls) * 100 : 0,
                'count' => count($smp),
                'trafik' => $trafik_smp,
            ],
            'sma' => [
                'datas' => $sma,
                'persen' => $sumAlls != 0 ? (count($sma) / $sumAlls) * 100 : 0,
                'count' => count($sma),
                'trafik' => $trafik_sma,
            ],
            'pt' => [
                'datas' => $pt,
                'persen' => $sumAlls != 0 ? (count($pt) / $sumAlls) * 100 : 0,
                'count' => count($pt),
                'trafik' => $trafik_pt,
            ],
        ];

        return $data;
    }

    //klasifikasi jenis tamu
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

            $start_date = Carbon::now()->subDays(30)->toDateString();
            $end_date = Carbon::now()->toDateString();
        }

        $trafik_web = [];
        $trafik_work = [];
        $trafik_owner = [];
        $trafik_travel = [];
        $trafik_coorporate = [];
        $trafik_entertainment = [];

        while ($start_date <= $end_date) {

            $webData = Guest::where('type_guest', 'WEB')->whereDate('updated_at', $start_date)->get();
            $workData = Guest::where('type_guest', 'WORK_IN_GUEST')->whereDate('updated_at', $start_date)->get();
            $ownerData = Guest::where('type_guest', 'OWNER')->whereDate('updated_at', $start_date)->get();
            $travelData = Guest::where('type_guest', 'TRAVEL')->whereDate('updated_at', $start_date)->get();
            $coorporateData = Guest::where('type_guest', 'COORPORATE_FAMILY')->whereDate('updated_at', $start_date)->get();
            $entertainmentData = Guest::where('type_guest', 'ENTERTAINMENT')->whereDate('updated_at', $start_date)->get();

            $web_count = count($webData);
            $work_count = count($workData);
            $owner_count = count($ownerData);
            $travel_count = count($travelData);
            $coorporate_count = count($coorporateData);
            $entertainment_count = count($entertainmentData);

            $formatted_date = date('m-d-Y', strtotime($start_date));

            $trafik_web[$formatted_date] = $web_count;
            $trafik_work[$formatted_date] = $work_count;
            $trafik_owner[$formatted_date] = $owner_count;
            $trafik_travel[$formatted_date] = $travel_count;
            $trafik_coorporate[$formatted_date] = $coorporate_count;
            $trafik_entertainment[$formatted_date] = $entertainment_count;

            $start_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
        }

        $data = [
            'web' => [
                'datas' => $web,
                'persen' => $sumAlls != 0 ? (count($web) / $sumAlls) * 100 : 0,
                'count' => count($web),
                'trafik' => $trafik_web,
            ],
            'work' => [
                'datas' => $work,
                'persen' => $sumAlls != 0 ? (count($work) / $sumAlls) * 100 : 0,
                'count' => count($work),
                'trafik' => $trafik_work,
            ],
            'owner' => [
                'datas' => $owner,
                'persen' => $sumAlls != 0 ? (count($owner) / $sumAlls) * 100 : 0,
                'count' => count($owner),
                'trafik' => $trafik_owner,
            ],
            'travel' => [
                'datas' => $travel,
                'persen' => $sumAlls != 0 ? (count($travel) / $sumAlls) * 100 : 0,
                'count' => count($travel),
                'trafik' => $trafik_travel,
            ],
            'coorporate' => [
                'datas' => $coorporate,
                'persen' => $sumAlls != 0 ? (count($coorporate) / $sumAlls) * 100 : 0,
                'count' => count($coorporate),
                'trafik' => $trafik_coorporate,
            ],
            'entertainment' => [
                'datas' => $entertainment,
                'persen' => $sumAlls != 0 ? (count($entertainment) / $sumAlls) * 100 : 0,
                'count' => count($entertainment),
                'trafik' => $trafik_entertainment,
            ],
        ];

        return $data;
    }

    //klasifikasi Usia
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

            $start_date = Carbon::now()->subDays(30)->toDateString();
            $end_date = Carbon::now()->toDateString();
        }

        $trafik_u18_25 = [];
        $trafik_u26_35 = [];
        $trafik_u36_50 = [];
        $trafik_u51_60 = [];
        $trafik_lansia = [];

        while ($start_date <= $end_date) {

            $u18_25Data = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 25')->whereDate('updated_at', $start_date)->get();
            $u26_35Data = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 26 AND 35')->whereDate('updated_at', $start_date)->get();
            $u36_50Data = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 36 AND 50')->whereDate('updated_at', $start_date)->get();
            $u51_60Data = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 51 AND 60')->whereDate('updated_at', $start_date)->get();
            $lansiaData = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > 60')->whereDate('updated_at', $start_date)->get();

            $u18_25_count = count($u18_25Data);
            $u26_35_count = count($u26_35Data);
            $u36_50_count = count($u36_50Data);
            $u51_60_count = count($u51_60Data);
            $lansia_count = count($lansiaData);

            $formatted_date = date('m-d-Y', strtotime($start_date));

            $trafik_u18_25[$formatted_date] = $u18_25_count;
            $trafik_u26_35[$formatted_date] = $u26_35_count;
            $trafik_u36_50[$formatted_date] = $u36_50_count;
            $trafik_u51_60[$formatted_date] = $u51_60_count;
            $trafik_lansia[$formatted_date] = $lansia_count;

            $start_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
        }


        $data = [
            'u18_25' => [
                'datas' => $u18_25,
                'persen' => $sumAlls != 0 ? (count($u18_25) / $sumAlls) * 100 : 0,
                'count' => count($u18_25),
                'trafik' => $trafik_u18_25,
            ],
            'u26_35' => [
                'datas' => $u26_35,
                'persen' => $sumAlls != 0 ? (count($u26_35) / $sumAlls) * 100 : 0,
                'count' => count($u26_35),
                'trafik' => $trafik_u26_35,
            ],
            'u36_50' => [
                'datas' => $u36_50,
                'persen' => $sumAlls != 0 ? (count($u36_50) / $sumAlls) * 100 : 0,
                'count' => count($u36_50),
                'trafik' => $trafik_u36_50,
            ],
            'u51_60' => [
                'datas' => $u51_60,
                'persen' => $sumAlls != 0 ? (count($u51_60) / $sumAlls) * 100 : 0,
                'count' => count($u51_60),
                'trafik' => $trafik_u51_60,
            ],
            'lansia' => [
                'datas' => $lansia,
                'persen' => $sumAlls != 0 ? (count($lansia) / $sumAlls) * 100 : 0,
                'count' => count($lansia),
                'trafik' => $trafik_lansia,
            ],
        ];

        return $data;
    }

    //klasifikasi pekerjaan
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
