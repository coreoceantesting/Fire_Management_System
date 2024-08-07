<?php

namespace App\Http\Controllers\Admin\Masters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Masters\StoreFireCauseRequest;
use App\Http\Requests\Admin\Masters\UpdateFireCauseRequest;
use App\Models\FireCause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class FireCauseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fire_causes_list = FireCause::where('is_deleted','0')->latest()->get();

        return view('admin.masters.fire_causes')->with(['fire_causes_list'=> $fire_causes_list]);
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
    public function store(StoreFireCauseRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['created_by'] = Auth::user()->id;
            $input['created_at'] = date('Y-m-d H:i:s');

            FireCause::create($input);
            DB::commit();

            return response()->json(['success'=> 'Fire Cause created successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Fire Cause');
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
    public function edit(FireCause $firecause)
    {

        if ($firecause)
        {
            $response = [
                'result' => 1,
                'firecause' => $firecause,
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
    public function update(UpdateFireCauseRequest $request, FireCause $firecause)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['name'] = $input['name'];
            $input['initial'] = $input['initial'];
            $input['updated_by'] = Auth::user()->id;
            $input['updated_at'] = date('Y-m-d H:i:s');
            $firecause->update($input);
            DB::commit();

            return response()->json(['success'=> 'Fire Cause updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Fire Cause');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FireCause $firecause)
    {
        try
        {
            DB::beginTransaction();
            $firecause->update(['is_deleted' => '1']);
            DB::commit();
            return response()->json(['success'=> 'Fire Cause deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Fire Cause');
        }
    }
}
