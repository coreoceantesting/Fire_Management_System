<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\StoreFireStationtRequest;
use App\Http\Requests\Admin\Masters\UpdateFireStationtRequest;
use App\Models\FireStation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FireStationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fire_stations_list = FireStation::where('fire_station_is_active','0')->latest()->get();

        return view('admin.masters.fire_stations')->with(['fire_stations_list'=> $fire_stations_list]);
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
    public function store(StoreFireStationtRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['created_by'] = Auth::user()->id;
            $input['created_at'] = date('Y-m-d H:i:s');
            FireStation::create( Arr::only( $input, FireStation::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Fire Station created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Fire Station');
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
    public function edit(FireStation $firestation)
    {
        if ($firestation)
        {
            $response = [
                'result' => 1,
                'firestation' => $firestation,
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
    public function update(UpdateFireStationtRequest $request, FireStation $firestation)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['name'] = $input['name'];
            $input['initial'] = $input['initial'];
            $input['updated_by'] = Auth::user()->id;
            $input['updated_at'] = date('Y-m-d H:i:s');
            $firestation->update( Arr::only( $input, FireStation::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Fire Station updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Fire Station');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FireStation $firestation)
    {
        try
        {
            DB::beginTransaction();
            $firestation->update(['fire_station_is_active' => '1']);
            DB::commit();
            return response()->json(['success'=> 'Fire station deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Fire Station');
        }
    }
}
