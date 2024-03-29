<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->start_date && $request->end_date) {
            $date_filter = Guest::whereBetween(DB::raw('DATE(updated_at)'), [$request->start_date, $request->end_date])->get();
        } else {
            $date_filter = Guest::orderBy('id', 'desc')->get();
        }

        $data = [
            'count_admin' => User::count(),
            'count_guest' => Guest::count(),
            'data_filter_count' => $date_filter->count(),
            'data_filter' => $date_filter,
            'startDate' => $request->start_date ?? ' ',
            'endDate' => $request->end_date ?? ' ',
        ];

        //dd($data);
        return view('v_beranda.index', $data);
    }
}
