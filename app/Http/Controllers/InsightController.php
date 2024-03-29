<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsightController extends Controller
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
                'luar_jateng' => [
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
        ];

        dd($data);
        return view('v_insight.index', $data);
    }
}
