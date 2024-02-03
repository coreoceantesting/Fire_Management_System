<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\StoreEquipmentRequest;
use App\Http\Requests\Admin\Masters\UpdateEquipmentRequest;
use App\Models\Equipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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

}
