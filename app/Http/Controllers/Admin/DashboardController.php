<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $todaysSlipCount =DB::table('slips')->whereDate('created_at', now())->count();
        $monthlySlipCount = DB::table('slips')
        ->whereYear('created_at', now()->year)
        ->whereMonth('created_at', now()->month)
        ->count();
        $yearlySlipCount = DB::table('slips')
        ->whereYear('created_at', now()->year)
        ->count();
        $actionTakenSlipCount = DB::table('slips')
        ->where('slip_status', "Action Form Submitted")
        ->count();
        $vardiAhavalSlipCount = DB::table('slips')->where('is_occurance_book_submitted','1')->count();
        return view('admin.dashboard', compact('todaysSlipCount', 'monthlySlipCount', 'yearlySlipCount', 'actionTakenSlipCount','vardiAhavalSlipCount'));
    }

    public function changeThemeMode()
    {
        $mode = request()->cookie('theme-mode');

        if($mode == 'dark')
            Cookie::queue('theme-mode', 'light', 43800);
        else
            Cookie::queue('theme-mode', 'dark', 43800);

        return true;
    }
}
