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
        // dd($equipment_list);
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

}
