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
        if ($request->start_date && $request->end_date) {
            $sumAlls = Guest::whereBetween('updated_at', [$request->start_date, $request->end_date])->count();

            //klasifikasi daerah
            $tegal = Guest::where('region', 'TEGAL')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $slawi = Guest::where('region', 'SLAWI')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $brebes = Guest::where('region', 'BREBES')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $pemalang = Guest::where('region', 'PEMALANG')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $jateng = Guest::where('region', 'JATENG')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $luarJateng = Guest::where('region', 'LUAR_JATENG')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();

            //klasifikasi gender
            $male = Guest::where('gender', 'L')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $female = Guest::where('gender', 'P')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $none = Guest::where('gender', 'N')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();

            //klasifikasi pendidikan
            $ts = Guest::where('education', 'TS')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $sd = Guest::where('education', 'SD')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $smp = Guest::where('education', 'SMP')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $sma = Guest::where('education', 'SMA')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $pt = Guest::where('education', 'PT')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();

            //klasifikasi jenis tamu
            $web = Guest::where('type_guest', 'WEB')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $work = Guest::where('type_guest', 'WORK_IN_GUEST')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $owner = Guest::where('type_guest', 'OWNER')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $travel = Guest::where('type_guest', 'TRAVEL')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $coorporate = Guest::where('type_guest', 'COORPORATE_FAMILY')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $entertainment = Guest::where('type_guest', 'ENTERTAINMENT')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();

            //klasifikasi pekerjaan
            $wiraswasta = Guest::where('work', 'WIRASWASTA')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $pns = Guest::where('work', 'PNS')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $tniPolri = Guest::where('work', 'TNI_POLRI')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $guru = Guest::where('work', 'GURU')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $pelajar = Guest::where('work', 'PELAJAR')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $freelancer = Guest::where('work', 'FREELANCER')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $buruh = Guest::where('work', 'BURUH')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $petani = Guest::where('work', 'PETANI')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $nelayan = Guest::where('work', 'NELAYAN')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $pedagang = Guest::where('work', 'PEDAGANG')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $pengusaha = Guest::where('work', 'PENGUSAHA')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();
            $tidakBekerja = Guest::where('work', 'TIDAK_BEKERJA')
                ->whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->count();

            //klasifikasi Usia
            $u18_25 = Guest::whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 25')
                ->count();

            $u26_35 = Guest::whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 26 AND 35')
                ->count();

            $u36_50 = Guest::whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 36 AND 50')
                ->count();

            $u51_60 = Guest::whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 51 AND 60')
                ->count();

            $lansia = Guest::whereBetween('updated_at', [$request->start_date, $request->end_date])
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > 60')
                ->count();
        } else {
            $sumAlls = Guest::count();

            //klasifikasi daerah
            $tegal = Guest::where('region', 'TEGAL')->count();
            $slawi = Guest::where('region', 'SLAWI')->count();
            $brebes = Guest::where('region', 'BREBES')->count();
            $pemalang = Guest::where('region', 'PEMALANG')->count();
            $jateng = Guest::where('region', 'JATENG')->count();
            $luarJateng = Guest::where('region', 'LUAR_JATENG')->count();

            //klasifikasi gender
            $male = Guest::where('gender', 'L')->count();
            $female = Guest::where('gender', 'P')->count();
            $none = Guest::where('gender', 'N')->count();

            //klasifikasi pendidikan
            $ts = Guest::where('education', 'TS')->count();
            $sd = Guest::where('education', 'SD')->count();
            $smp = Guest::where('education', 'SMP')->count();
            $sma = Guest::where('education', 'SMA')->count();
            $pt = Guest::where('education', 'PT')->count();

            //klasifikasi jenis tamu
            $web = Guest::where('type_guest', 'WEB')->count();
            $work = Guest::where('type_guest', 'WORK_IN_GUEST')->count();
            $owner = Guest::where('type_guest', 'OWNER')->count();
            $travel = Guest::where('type_guest', 'TRAVEL')->count();
            $coorporate = Guest::where('type_guest', 'COORPORATE_FAMILY')->count();
            $entertainment = Guest::where('type_guest', 'ENTERTAINMENT')->count();

            //klasifikasi pekerjaan
            $wiraswasta = Guest::where('work', 'WIRASWASTA')->count();
            $pns = Guest::where('work', 'PNS')->count();
            $tniPolri = Guest::where('work', 'TNI_POLRI')->count();
            $guru = Guest::where('work', 'GURU')->count();
            $pelajar = Guest::where('work', 'PELAJAR')->count();
            $freelancer = Guest::where('work', 'FREELANCER')->count();
            $buruh = Guest::where('work', 'BURUH')->count();
            $petani = Guest::where('work', 'PETANI')->count();
            $nelayan = Guest::where('work', 'NELAYAN')->count();
            $pedagang = Guest::where('work', 'PEDAGANG')->count();
            $pengusaha = Guest::where('work', 'PENGUSAHA')->count();
            $tidakBekerja = Guest::where('work', 'TIDAK_BEKERJA')->count();

            //klasifikasi Usia
            $u18_25 = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 25')->count();

            $u26_35 = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 26 AND 35')->count();

            $u36_50 = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 36 AND 50')->count();

            $u51_60 = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 51 AND 60')->count();

            $lansia = Guest::whereRaw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > 60')->count();
        }

        $data = [
            'startDate' => $request->start_date ?? ' ',
            'endDate' => $request->end_date ?? ' ',
            'sum' => $sumAlls,
            'region' => [
                'tegal' => [
                    'persen' => $sumAlls != 0 ? ($tegal / $sumAlls) * 100 : 0,
                    'count' => $tegal,
                ],
                'slawi' => [
                    'persen' => $sumAlls != 0 ? ($slawi / $sumAlls) * 100 : 0,
                    'count' => $slawi,
                ],
                'brebes' => [
                    'persen' => $sumAlls != 0 ? ($brebes / $sumAlls) * 100 : 0,
                    'count' => $brebes,
                ],
                'pemalang' => [
                    'persen' => $sumAlls != 0 ? ($pemalang / $sumAlls) * 100 : 0,
                    'count' => $pemalang,
                ],
                'jateng' => [
                    'persen' => $sumAlls != 0 ? ($jateng / $sumAlls) * 100 : 0,
                    'count' => $jateng,
                ],
                'luarJateng' => [
                    'persen' => $sumAlls != 0 ? ($luarJateng / $sumAlls) * 100 : 0,
                    'count' => $luarJateng,
                ],
            ],
            'gender' => [
                'male' => [
                    'persen' => $sumAlls != 0 ? ($male / $sumAlls) * 100 : 0,
                    'count' => $male,
                ],
                'female' => [
                    'persen' => $sumAlls != 0 ? ($female / $sumAlls) * 100 : 0,
                    'count' => $female,
                ],
                'none' => [
                    'persen' => $sumAlls != 0 ? ($none / $sumAlls) * 100 : 0,
                    'count' => $none,
                ],
            ],
            'education' => [
                'ts' => [
                    'persen' => $sumAlls != 0 ? ($ts / $sumAlls) * 100 : 0,
                    'count' => $ts,
                ],
                'sd' => [
                    'persen' => $sumAlls != 0 ? ($sd / $sumAlls) * 100 : 0,
                    'count' => $sd,
                ],
                'smp' => [
                    'persen' => $sumAlls != 0 ? ($smp / $sumAlls) * 100 : 0,
                    'count' => $smp,
                ],
                'sma' => [
                    'persen' => $sumAlls != 0 ? ($sma / $sumAlls) * 100 : 0,
                    'count' => $sma,
                ],
                'pt' => [
                    'persen' => $sumAlls != 0 ? ($pt / $sumAlls) * 100 : 0,
                    'count' => $pt,
                ],
            ],
            'typeGuest' => [
                'web' => [
                    'persen' => $sumAlls != 0 ? ($web / $sumAlls) * 100 : 0,
                    'count' => $web,
                ],
                'work' => [
                    'persen' => $sumAlls != 0 ? ($work / $sumAlls) * 100 : 0,
                    'count' => $work,
                ],
                'owner' => [
                    'persen' => $sumAlls != 0 ? ($owner / $sumAlls) * 100 : 0,
                    'count' => $owner,
                ],
                'travel' => [
                    'persen' => $sumAlls != 0 ? ($travel / $sumAlls) * 100 : 0,
                    'count' => $travel,
                ],
                'coorporate' => [
                    'persen' => $sumAlls != 0 ? ($coorporate / $sumAlls) * 100 : 0,
                    'count' => $coorporate,
                ],
                'entertainment' => [
                    'persen' => $sumAlls != 0 ? ($entertainment / $sumAlls) * 100 : 0,
                    'count' => $entertainment,
                ],
            ],
            'work' => [
                'wiraswasta' => [
                    'persen' => $sumAlls != 0 ? ($wiraswasta / $sumAlls) * 100 : 0,
                    'count' => $wiraswasta,
                ],
                'pns' => [
                    'persen' => $sumAlls != 0 ? ($pns / $sumAlls) * 100 : 0,
                    'count' => $pns,
                ],
                'tniPolri' => [
                    'persen' => $sumAlls != 0 ? ($tniPolri / $sumAlls) * 100 : 0,
                    'count' => $tniPolri,
                ],
                'guru' => [
                    'persen' => $sumAlls != 0 ? ($guru / $sumAlls) * 100 : 0,
                    'count' => $guru,
                ],
                'pelajar' => [
                    'persen' => $sumAlls != 0 ? ($pelajar / $sumAlls) * 100 : 0,
                    'count' => $pelajar,
                ],
                'freelancer' => [
                    'persen' => $sumAlls != 0 ? ($freelancer / $sumAlls) * 100 : 0,
                    'count' => $freelancer,
                ],
                'buruh' => [
                    'persen' => $sumAlls != 0 ? ($buruh / $sumAlls) * 100 : 0,
                    'count' => $buruh,
                ],
                'petani' => [
                    'persen' => $sumAlls != 0 ? ($petani / $sumAlls) * 100 : 0,
                    'count' => $petani,
                ],
                'nelayan' => [
                    'persen' => $sumAlls != 0 ? ($nelayan / $sumAlls) * 100 : 0,
                    'count' => $nelayan,
                ],
                'pedagang' => [
                    'persen' => $sumAlls != 0 ? ($pedagang / $sumAlls) * 100 : 0,
                    'count' => $pedagang,
                ],
                'pengusaha' => [
                    'persen' => $sumAlls != 0 ? ($pengusaha / $sumAlls) * 100 : 0,
                    'count' => $pengusaha,
                ],
                'tidakBekerja' => [
                    'persen' => $sumAlls != 0 ? ($tidakBekerja / $sumAlls) * 100 : 0,
                    'count' => $tidakBekerja,
                ],
            ],
            'birth_date' => [
                'u18_25' => [
                    'persen' => $sumAlls != 0 ? ($u18_25 / $sumAlls) * 100 : 0,
                    'count' => $u18_25,
                ],
                'u26_35' => [
                    'persen' => $sumAlls != 0 ? ($u26_35 / $sumAlls) * 100 : 0,
                    'count' => $u26_35,
                ],
                'u36_50' => [
                    'persen' => $sumAlls != 0 ? ($u36_50 / $sumAlls) * 100 : 0,
                    'count' => $u36_50,
                ],
                'u51_60' => [
                    'persen' => $sumAlls != 0 ? ($u51_60 / $sumAlls) * 100 : 0,
                    'count' => $u51_60,
                ],
                'lansia' => [
                    'persen' => $sumAlls != 0 ? ($lansia / $sumAlls) * 100 : 0,
                    'count' => $lansia,
                ],
            ],
        ];

        //dd($data);
        return view('v_akumulasi.index', $data);
    }
}
