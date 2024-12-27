<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\StoreDesignationsRequest;
use App\Http\Requests\Admin\Masters\UpdateDesignationsRequest;
use App\Models\Designation;
use App\Models\FireStation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class DesignationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designation_list = Designation::where('designations.is_deleted','0')
                            ->leftjoin('fire_stations', 'designations.fire_station', '=', 'fire_stations.fire_station_id')
                            ->select('designations.*', 'fire_stations.name as fire_station_name')
                            ->orderBy('designations.designation_id','desc')
                            ->get();
        $fire_stations = FireStation::where('is_deleted','0')->where('fire_station_is_active','0')->latest()->get();

        return view('admin.masters.designations')->with(['designation_list'=> $designation_list, 'fire_stations'=> $fire_stations]);
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
    public function store(StoreDesignationsRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['created_by'] = Auth::user()->id;
            $input['created_at'] = date('Y-m-d H:i:s');
            Designation::create( Arr::only( $input, Designation::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Designation Store successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Designation');
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
    public function edit(Designation $designation)
    {
        if ($designation)
        {
            $response = [
                'result' => 1,
                'designation' => $designation,
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
    public function update(UpdateDesignationsRequest $request, Designation $designation)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['designation_name'] = $input['designation_name'];
            $input['designation_initial'] = $input['designation_initial'];
            $input['updated_by'] = Auth::user()->id;
            $input['updated_at'] = date('Y-m-d H:i:s');
            $designation->update( Arr::only( $input, Designation::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Designation updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Designation');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        try
        {
            DB::beginTransaction();
            $designation->update(['is_deleted' => '1']);
            DB::commit();
            return response()->json(['success'=> 'Designation deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Designation');
        }
    }
}
