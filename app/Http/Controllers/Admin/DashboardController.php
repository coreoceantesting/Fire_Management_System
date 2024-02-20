<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Equipment;

class DashboardController extends Controller
{

    public function index()
    {
        $todaysSlipCount =DB::table('slips')->whereDate('created_at', now())->count();
        $todaysSlipList =DB::table('slips')
        ->select('slip_date','caller_name','pdf_name','slip_id')
        ->whereDate('created_at', now())
        ->latest()
        ->take(5)
        ->get();
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
        $totalSlipCount = DB::table('slips')->count();
        $vehicle_history_details = DB::table('vehicle_history')->where('is_vehicle_expire','0')->latest()->take(5)->get();

        $equipment_list = DB::table('equipment')
        ->leftJoin('equipment_stock', 'equipment.equipment_id', '=', 'equipment_stock.equipment_id')
        ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(IFNULL(equipment_stock.quantity, 0)) as total_stock'))
        ->where('equipment.is_deleted', '0')
        ->where('equipment.equipment_is_active', '1')
        ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
        ->orderByDesc('equipment.created_at')
        ->take(5)
        ->get();

        // Fetch total supply quantity
        $totalSupplyQuantity = DB::table('equipment')
            ->leftJoin('supply_equipment', 'equipment.equipment_id', '=', 'supply_equipment.equipment_id')
            ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(IFNULL(supply_equipment.supply_equipment_quantity, 0)) as total_supply_quantity'))
            ->where('equipment.is_deleted', '0')
            ->where('equipment.equipment_is_active', '1')
            ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
            ->orderByDesc('equipment.created_at')
            ->take(5)
            ->get();

        // Fetch total expire quantity
        $totalExpireQuantity = DB::table('equipment')
            ->leftJoin('expire_equipment', 'equipment.equipment_id', '=', 'expire_equipment.equipment_id')
            ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(IFNULL(expire_equipment.expire_equipment_quantity, 0)) as total_expire_quantity'))
            ->where('equipment.is_deleted', '0')
            ->where('equipment.equipment_is_active', '1')
            ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
            ->orderByDesc('equipment.created_at')
            ->take(5)
            ->get();

        // Combine the results with the equipment list
        $equipment_list = $equipment_list->map(function ($item) use ($totalSupplyQuantity, $totalExpireQuantity) {
            $supplyItem = $totalSupplyQuantity->where('equipment_id', $item->equipment_id)->first();
            $expireItem = $totalExpireQuantity->where('equipment_id', $item->equipment_id)->first();

            return (object) [
                'equipment_id' => $item->equipment_id,
                'equipment_name' => $item->equipment_name,
                'total_stock' => $item->total_stock,
                'total_supply_quantity' => $supplyItem ? $supplyItem->total_supply_quantity : 0,
                'total_expire_quantity' => $expireItem ? $expireItem->total_expire_quantity : 0,
            ];
        });


        return view('admin.dashboard', compact('todaysSlipCount', 'monthlySlipCount', 'yearlySlipCount', 'actionTakenSlipCount','vardiAhavalSlipCount','totalSlipCount','todaysSlipList','equipment_list','vehicle_history_details'));
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
