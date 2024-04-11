<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\StoreEquipmentRequest;
use App\Http\Requests\Admin\Masters\UpdateEquipmentRequest;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EquipmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment_list = Equipment::where('is_deleted','0')->latest()->get();

        return view('admin.masters.equipments')->with(['equipment_list'=> $equipment_list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $input['created_by'] = Auth::user()->id;
            $input['created_at'] = now(); // Use Laravel's now() helper

            Equipment::create($input);

            DB::commit();

            return response()->json(['success' => 'Equipment created successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'creating', 'Equipment');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        if ($equipment)
        {
            $response = [
                'result' => 1,
                'equipment' => $equipment,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            $input['updated_by'] = Auth::user()->id;
            $input['updated_at'] = now();

            $equipment->update($input);

            DB::commit();

            return response()->json(['success' => 'Equipment updated successfully!']);
        } catch (\Exception $e) {
            return $this->respondWithAjax($e, 'updating', 'Equipment');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipment $equipment)
    {
        try
        {
            DB::beginTransaction();
            $equipment->update(['is_deleted' => '1']);
            DB::commit();
            return response()->json(['success'=> 'Equipment deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Equipment');
        }
    }

    public function inactive(Equipment $equipment)
    {
        try
        {
            DB::beginTransaction();
            $equipment->update(['equipment_is_active' => '0']);
            DB::commit();
            return response()->json(['success'=> 'Equipment InActive successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'inactive', 'Equipment');
        }
    }

    public function active(Equipment $equipment)
    {
        try
        {
            DB::beginTransaction();
            $equipment->update(['equipment_is_active' => '1']);
            DB::commit();
            return response()->json(['success'=> 'Equipment Active successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'active', 'Equipment');
        }
    }

    // stock Management
    public function add_stock()
    {
        // $equipment_list = Equipment::where('is_deleted','0')->where('equipment_is_active','1')->latest()->get();
        $equipment_list = Equipment::leftJoin('equipment_stock', 'equipment.equipment_id', '=', 'equipment_stock.equipment_id')
        ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(equipment_stock.quantity) as total_stock'))
        ->where('equipment.is_deleted', '0')
        ->where('equipment.equipment_is_active', '1')
        ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
        ->orderByDesc('equipment.created_at')  // Assuming you want to order by created_at in descending order
        ->get();

        // Fetch total supply quantity
        $totalSupplyQuantity = DB::table('equipment')
            ->leftJoin('supply_equipment', 'equipment.equipment_id', '=', 'supply_equipment.equipment_id')
            ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(IFNULL(supply_equipment.supply_equipment_quantity, 0)) as total_supply_quantity'))
            ->where('equipment.is_deleted', '0')
            ->where('equipment.equipment_is_active', '1')
            ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
            ->orderByDesc('equipment.created_at')
            ->get();

        // Combine the results with the equipment list
        $equipment_list = $equipment_list->map(function ($item) use ($totalSupplyQuantity) {
            $supplyItem = $totalSupplyQuantity->where('equipment_id', $item->equipment_id)->first();

            return (object) [
                'equipment_id' => $item->equipment_id,
                'equipment_name' => $item->equipment_name,
                'total_stock' => $item->total_stock,
                'total_supply_quantity' => $supplyItem ? $supplyItem->total_supply_quantity : 0,
            ];
        });

        
        return view('equipment_management.addStock',compact('equipment_list'));
    }

    public function store_stock(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'equipment_name' => 'required',
                'date' => 'required',
                'quantity' => 'required',
                'unit' => 'required',
                'work_order' => 'file|mimes:pdf,doc,docx',
            ]);

            if ($request->hasFile('work_order')) {
                $file = $request->file('work_order');
                $path = $file->store('work_orders', 'public'); // Save the file to the 'storage/app/public/work_orders' directory
            }

            // Store data in equipment_stock table
            DB::table('equipment_stock')->insert([
                'equipment_id' => $request->input('equipment_name'),
                'date' => $request->input('date'),
                'quantity' => $request->input('quantity'),
                'unit' => $request->input('unit'),
                'work_order' => isset($path) ? $path : null,
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ]);

            return response()->json(['success' => 'Stock Added successfully!']);
        } catch (ValidationException $e) {
            // If validation fails, return validation errors
            return response()->json(['errors' => $e->errors()]);
        }
    }

    public function view_stock_list($equipmentId)
    {
        $equipment_stock_list = DB::table('equipment_stock')
                ->select('equipment.equipment_name', 'equipment_stock.date', 'equipment_stock.quantity', 'equipment_stock.unit', 'equipment_stock.work_order')
                ->join('equipment', 'equipment_stock.equipment_id', '=', 'equipment.equipment_id')
                ->where('equipment_stock.equipment_id', $equipmentId)
                ->get();

        return response()->json([
            'equipment_stock_list' => $equipment_stock_list,
        ]);
    }

    public function supply_stock()
    {
        $equipment_list = Equipment::leftJoin('supply_equipment', 'equipment.equipment_id', '=', 'supply_equipment.equipment_id')
        ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(supply_equipment.supply_equipment_quantity) as total_supply_stock'))
        ->where('equipment.is_deleted', '0')
        ->where('equipment.equipment_is_active', '1')
        ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
        ->orderByDesc('equipment.created_at')  // Assuming you want to order by created_at in descending order
        ->get();
        return view('equipment_management.supplyStock',compact('equipment_list'));
    }

    public function store_supply_stock(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'equipment_name' => 'required',
                'date' => 'required',
                'quantity' => 'required',
                'unit' => 'required',
                'remark' => 'required',
            ]);

            // Store data in equipment_supply_stock table
            DB::table('supply_equipment')->insert([
                'equipment_id' => $request->input('equipment_name'),
                'supply_equipment_date' => $request->input('date'),
                'supply_equipment_quantity' => $request->input('quantity'),
                'supply_equipment_unit' => $request->input('unit'),
                'supply_equipment_remark' => $request->input('remark'),
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ]);

            return response()->json(['success' => 'Stock Supplyed successfully!']);
        } catch (ValidationException $e) {
            // If validation fails, return validation errors
            return response()->json(['errors' => $e->errors()]);
        }
    }

    public function view_supply_stock_list($equipmentId)
    {
        $equipment_supply_stock_list = DB::table('supply_equipment')
                ->select('equipment.equipment_name', 'supply_equipment.supply_equipment_date', 'supply_equipment.supply_equipment_quantity', 'supply_equipment.supply_equipment_unit', 'supply_equipment.supply_equipment_remark')
                ->join('equipment', 'supply_equipment.equipment_id', '=', 'equipment.equipment_id')
                ->where('supply_equipment.equipment_id', $equipmentId)
                ->get();

        return response()->json([
            'equipment_supply_stock_list' => $equipment_supply_stock_list,
        ]);
    }

    public function expire_stock()
    {
        $equipment_list = Equipment::leftJoin('expire_equipment', 'equipment.equipment_id', '=', 'expire_equipment.equipment_id')
        ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(expire_equipment.expire_equipment_quantity) as total_expire_stock'))
        ->where('equipment.is_deleted', '0')
        ->where('equipment.equipment_is_active', '1')
        ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
        ->orderByDesc('equipment.created_at')  // Assuming you want to order by created_at in descending order
        ->get();
        return view('equipment_management.expireStock',compact('equipment_list'));
    }

    public function store_expire_stock(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'equipment_name' => 'required',
                'date' => 'required',
                'quantity' => 'required',
                'unit' => 'required',
                'expired_from' =>'required',
                'remark' => 'required',
            ]);

            // Store data in equipment_expire_stock table
            DB::table('expire_equipment')->insert([
                'equipment_id' => $request->input('equipment_name'),
                'expire_equipment_date' => $request->input('date'),
                'expired_from' => $request->input('expired_from'),
                'expire_equipment_quantity' => $request->input('quantity'),
                'expire_equipment_unit' => $request->input('unit'),
                'expire_equipment_remark' => $request->input('remark'),
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ]);

            return response()->json(['success' => 'Expired Stock successfully!']);
        } catch (ValidationException $e) {
            // If validation fails, return validation errors
            return response()->json(['errors' => $e->errors()]);
        }
    }

    public function view_expire_stock_list($equipmentId)
    {
        $equipment_expire_stock_list = DB::table('expire_equipment')
                ->select('equipment.equipment_name', 'expire_equipment.expire_equipment_quantity', 'expire_equipment.expire_equipment_unit', 'expire_equipment.expire_equipment_remark', 'expire_equipment.expire_equipment_date')
                ->join('equipment', 'expire_equipment.equipment_id', '=', 'equipment.equipment_id')
                ->where('expire_equipment.equipment_id', $equipmentId)
                ->get();

        return response()->json([
            'equipment_expire_stock_list' => $equipment_expire_stock_list,
        ]);
    }

    public function get_available_quantity($equipmentId)
    {
        $total_stock = DB::table('equipment_stock')->where('equipment_id', $equipmentId)->sum('quantity');
        $total_supply = DB::table('supply_equipment')->where('equipment_id', $equipmentId)->sum('supply_equipment_quantity');
        $total_expire = DB::table('expire_equipment')->where('equipment_id', $equipmentId)->where('expired_from','1')->sum('expire_equipment_quantity');
        if($total_supply)
        {
            $available_quantity = $total_stock - $total_supply - $total_expire;
        }else{
            $available_quantity = $total_stock - 0;
        }

        if ($available_quantity) {
            // Return the available quantity as JSON
            return response()->json(['available_quantity' => $available_quantity]);
        } else {
            // Handle the case when equipment is not found
            return response()->json(['available_quantity' => '0']);
        }
    }

    public function overall_stock_detail()
    {
        $equipment_list = DB::table('equipment')
        ->leftJoin('equipment_stock', 'equipment.equipment_id', '=', 'equipment_stock.equipment_id')
        ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(IFNULL(equipment_stock.quantity, 0)) as total_stock'))
        ->where('equipment.is_deleted', '0')
        ->where('equipment.equipment_is_active', '1')
        ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
        ->orderByDesc('equipment.created_at')
        ->get();

        // Fetch total supply quantity
        $totalSupplyQuantity = DB::table('equipment')
            ->leftJoin('supply_equipment', 'equipment.equipment_id', '=', 'supply_equipment.equipment_id')
            ->select('equipment.equipment_id', 'equipment.equipment_name', DB::raw('SUM(IFNULL(supply_equipment.supply_equipment_quantity, 0)) as total_supply_quantity'))
            ->where('equipment.is_deleted', '0')
            ->where('equipment.equipment_is_active', '1')
            ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
            ->orderByDesc('equipment.created_at')
            ->get();

        // Fetch total expire quantity
        $totalExpireQuantity = DB::table('equipment')
        ->leftJoin('expire_equipment', 'equipment.equipment_id', '=', 'expire_equipment.equipment_id')
        ->select(
            'equipment.equipment_id',
            'equipment.equipment_name',
            DB::raw('SUM(CASE WHEN expire_equipment.expired_from = 1 THEN IFNULL(expire_equipment.expire_equipment_quantity, 0) ELSE 0 END) as total_expire_quantity_1'),
            DB::raw('SUM(CASE WHEN expire_equipment.expired_from = 2 THEN IFNULL(expire_equipment.expire_equipment_quantity, 0) ELSE 0 END) as total_expire_quantity_2')
        )
        ->where('equipment.is_deleted', '0')
        ->where('equipment.equipment_is_active', '1')
        ->groupBy('equipment.equipment_id', 'equipment.equipment_name')
        ->orderByDesc('equipment.created_at')
        ->get();

        // dd($totalExpireQuantity);

        // Combine the results with the equipment list
        $equipment_list = $equipment_list->map(function ($item) use ($totalSupplyQuantity, $totalExpireQuantity) {
            $supplyItem = $totalSupplyQuantity->where('equipment_id', $item->equipment_id)->first();
            $expireItem = $totalExpireQuantity->where('equipment_id', $item->equipment_id)->first();

            return (object) [
                'equipment_id' => $item->equipment_id,
                'equipment_name' => $item->equipment_name,
                'total_stock' => $item->total_stock,
                'total_supply_quantity' => $supplyItem ? $supplyItem->total_supply_quantity : 0,
                'total_expire_quantity_1' => $expireItem ? $expireItem->total_expire_quantity_1 : 0,
                'total_expire_quantity_2' => $expireItem ? $expireItem->total_expire_quantity_2 : 0,
            ];
        });

        // dd($equipment_list);
        return view('equipment_management.overallStockDetail', compact('equipment_list'));
    }

    public function get_supplied_quantity($equipmentId)
    {
        // $total_stock = DB::table('equipment_stock')->where('equipment_id', $equipmentId)->sum('quantity');
        $total_supply = DB::table('supply_equipment')->where('equipment_id', $equipmentId)->sum('supply_equipment_quantity');
        $total_expire = DB::table('expire_equipment')->where('equipment_id', $equipmentId)->sum('expire_equipment_quantity');
        if($total_expire)
        {
            $available_supplied_quantity = $total_supply - $total_expire;
        }else{
            $available_supplied_quantity = $total_supply - 0;
        }

        if ($available_supplied_quantity) {
            // Return the available quantity as JSON
            return response()->json(['available_supplied_quantity' => $available_supplied_quantity]);
        } else {
            // Handle the case when equipment is not found
            return response()->json(['available_supplied_quantity' => '0']);
        }
    }

    public function get_supplied_quantity_new(Request $request)
    {
        // $total_stock = DB::table('equipment_stock')->where('equipment_id', $equipmentId)->sum('quantity');
        if($request->expiredFrom == '1')
        {
            $total_stock = DB::table('equipment_stock')->where('equipment_id', $request->equipmentId)->sum('quantity');
            $total_supply = DB::table('supply_equipment')->where('equipment_id', $request->equipmentId)->sum('supply_equipment_quantity');
            $available_supplied_quantity = $total_stock - $total_supply;
        }else if($request->expiredFrom == '2') {
            $total_supply = DB::table('supply_equipment')->where('equipment_id', $request->equipmentId)->sum('supply_equipment_quantity');
            // $total_expire = DB::table('expire_equipment')->where('equipment_id', $request->equipmentId)->sum('expire_equipment_quantity');
            $available_supplied_quantity = $total_supply;
        }
        // if($total_expire)
        // {
        //     $available_supplied_quantity = $total_supply - $total_expire;
        // }else{
        //     $available_supplied_quantity = $total_supply - 0;
        // }

        if ($available_supplied_quantity) {
            // Return the available quantity as JSON
            return response()->json(['available_supplied_quantity' => $available_supplied_quantity]);
        } else {
            // Handle the case when equipment is not found
            return response()->json(['available_supplied_quantity' => '0']);
        }
    }

 

}
