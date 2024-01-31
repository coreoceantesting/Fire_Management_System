<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FiltersController extends Controller
{
    public function filter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status = $request->input('status');

        $start_datetime = $start_date . ' 00:00:00';
        $end_datetime = $end_date . ' 23:59:59';

        $slipQuery = DB::table('slips')
            ->whereBetween('slip_date', [$start_datetime, $end_datetime]);

        if ($status) {
            $slipQuery->where('slip_status', $status);
        }

        $slip_list = $slipQuery->latest()->get();

        return view('generateslips.slipslist', compact('slip_list'));
    }

    public function new_generated_filter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status = $request->input('status');

        $start_datetime = $start_date . ' 00:00:00';
        $end_datetime = $end_date . ' 23:59:59';

        $slipQuery = DB::table('slips')
            ->whereBetween('slip_date', [$start_datetime, $end_datetime]);

        if ($status) {
            $slipQuery->where('slip_status', $status);
        }

        $slip_list = $slipQuery->where('slip_status','Pending')->latest()->get();
        $designation_list = DB::table('designations')->where('is_deleted','0')->get();
        $vehicle_list = DB::table('vehicle_details')->where('is_deleted','0')->get();

        return view('generateslips.new_generated_slip', compact('slip_list','designation_list','vehicle_list'));
    }

    public function action_taken_slips_filter(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status = $request->input('status');

        $start_datetime = $start_date . ' 00:00:00';
        $end_datetime = $end_date . ' 23:59:59';

        $slipQuery = DB::table('slips')
            ->whereBetween('slip_date', [$start_datetime, $end_datetime]);

        if ($status) {
            $slipQuery->where('slip_status', $status);
        }

        $slip_list = $slipQuery->latest()->get();
        $designation_list = DB::table('designations')->where('is_deleted','0')->get();
        $fire_station_list = DB::table('fire_stations')->where('fire_station_is_active','0')->where('is_deleted','0')->get();
        $vehicle_list = DB::table('vehicle_details')->where('is_deleted','0')->get();

        return view('generateslips.action_taken_list', compact('slip_list','designation_list','vehicle_list','fire_station_list'));
    }

}
