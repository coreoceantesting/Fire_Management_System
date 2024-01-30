<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function todays_list()
    {
        $todaysSlipList =DB::table('slips')->whereDate('created_at', now())->latest()->get();
        return view('slipslists.todaysList',compact('todaysSlipList'));
    }

    public function monthly_list()
    {
        $monthlySlipList = DB::table('slips')
        ->whereYear('created_at', now()->year)
        ->whereMonth('created_at', now()->month)
        ->latest()
        ->get();
        return view('slipslists.monthlyList',compact('monthlySlipList'));
    }

    public function yearly_list()
    {
        $yearlySlipList = DB::table('slips')
        ->whereYear('created_at', now()->year)
        ->latest()
        ->get();
        return view('slipslists.yearlyList',compact('yearlySlipList'));
    }

    public function action_taken_list()
    {
        $actionTakenSlipList = DB::table('slips')
        ->where('slip_status', "Action Form Submitted")
        ->latest()
        ->get();
        return view('slipslists.actionTakenList',compact('actionTakenSlipList'));
    }
}
