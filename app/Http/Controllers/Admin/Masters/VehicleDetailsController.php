<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\StoreVehicleDetailsRequest;
use App\Http\Requests\Admin\Masters\UpdateVehicleDetailsRequest;
use App\Models\VehicleDetail;
use App\Models\FireStation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class VehicleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicle_list = VehicleDetail::where('vehicle_details.is_deleted','0')
        ->join('fire_stations', 'vehicle_details.fire_station_id', '=', 'fire_stations.fire_station_id')
        ->latest()
        ->get(['fire_stations.name','vehicle_details.*']);
        $fire_station_list = FireStation::where('is_deleted','0')->where('fire_station_is_active','0')->latest()->get();

        return view('admin.masters.vehicle_details')->with(['vehicle_list'=> $vehicle_list,'fire_station_list' => $fire_station_list]);
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
    public function store(StoreVehicleDetailsRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['created_by'] = Auth::user()->id;
            $input['created_at'] = date('Y-m-d H:i:s');
            VehicleDetail::create( Arr::only( $input, VehicleDetail::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Vehicle Details Store successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Vehicle Details');
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
    public function edit(VehicleDetail $vehicle_detail)
    {
        if ($vehicle_detail)
        {
            $response = [
                'result' => 1,
                'vehicle' => $vehicle_detail,
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
    public function update(UpdateVehicleDetailsRequest $request, VehicleDetail $vehicle_detail)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['vehicle_number'] = $input['vehicle_number'];
            $input['vehicle_type'] = $input['vehicle_type'];
            $input['fire_station_id'] = $input['fire_station_id'];
            $input['updated_by'] = Auth::user()->id;
            $input['updated_at'] = date('Y-m-d H:i:s');
            $vehicle_detail->update( Arr::only( $input, VehicleDetail::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Vehicle Details updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Vehicle Details');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleDetail $vehicle_detail)
    {
        try
        {
            DB::beginTransaction();
            $vehicle_detail->update(['is_deleted' => '1']);
            DB::commit();
            return response()->json(['success'=> 'Vehicle Details deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Vehicle Details');
        }
    }

    public function add_equipment_list(Request $request, $id)
    {
        return view('admin.addEquipment')->with(['id' => $id]);
    }

    public function store_equipment_details(Request $request)
    {

        try
        {
            DB::beginTransaction();

            foreach ($request->equipment_name as $key => $equipmentName) {
                DB::table('equipment_details')->insert([
                    'vehicle_details_id' => $request->vechicle_id,
                    'position' => $request->position,
                    'equipment_name' => $equipmentName,
                    'quantity' => $request->quantity[$key],
                    'created_by' => auth()->user()->id,
                    'created_at' => now(),
                ]);
            }

            DB::commit();
            return response()->json(['success'=> 'Equipment Details Added successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'adding', 'Equipment Details');
        }
    }

    public function get_equipment_list(Request $request, $id)
    {
        $equipmentData  = DB::table('equipment_details')
        ->where('vehicle_details_id', $id)
        ->get()
        ->groupBy('position');
        return view('admin.viewEquipmentDetails')->with(['data' => $equipmentData]);
    }
}
