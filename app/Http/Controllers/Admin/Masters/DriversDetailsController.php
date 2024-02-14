<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\StoreDriversRequest;
use App\Http\Requests\Admin\Masters\UpdateDriversRequest;
use App\Models\DriverDetail;
use App\Models\VehicleDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class DriversDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers_list = DriverDetail::where('is_deleted','0')->latest()->get();
        $vehicle_list = VehicleDetail::where('is_deleted','0')->latest()->get();

        return view('admin.masters.drivers')->with(['drivers_list'=> $drivers_list,'vehicle_list' => $vehicle_list]);
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
    public function store(StoreDriversRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['created_by'] = Auth::user()->id;
            $input['created_at'] = date('Y-m-d H:i:s');
            DriverDetail::create( Arr::only( $input, DriverDetail::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Driver Details Store successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Driver Details');
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
     * Show the form for editing the specified 
     */
    public function edit(DriverDetail $driver_detail)
    {
        if ($driver_detail)
        {
            $response = [
                'result' => 1,
                'driver_detail' => $driver_detail,
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
    public function update(UpdateDriversRequest $request, DriverDetail $driver_detail)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['driver_name'] = $input['driver_name'];
            $input['driver_mob_no'] = $input['driver_mob_no'];
            $input['driver_gender'] = $input['driver_gender'];
            $input['driver_job_status'] = $input['driver_job_status'];
            // $input['vehicle_id'] = $input['vehicle_id'];
            $input['updated_by'] = Auth::user()->id;
            $input['updated_at'] = date('Y-m-d H:i:s');
            $driver_detail->update( Arr::only( $input, DriverDetail::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Driver Details updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Driver Details');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverDetail $driver_detail)
    {
        try
        {
            DB::beginTransaction();
            $driver_detail->update(['is_deleted' => '1']);
            DB::commit();
            return response()->json(['success'=> 'Driver Details deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Driver Details');
        }
    }
}
