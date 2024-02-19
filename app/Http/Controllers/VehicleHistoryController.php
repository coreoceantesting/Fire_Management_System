<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class VehicleHistoryController extends Controller
{
    public function add_vechicle_details()
    {
        $vehicle_list = DB::table('vehicle_history')->where('is_vehicle_expire','0')->get();
        return view('vehicle_history.addVehicleDetails',compact('vehicle_list'));
    }

    public function store_vechicle_details(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'vehicle_name' => 'required',
                'company_name' => 'required',
                'vehicle_no' => 'required',
                'rc_no' => 'required',
                'rc_upload' => 'required|file|mimes:pdf,doc,docx',
                'puc_start_date' => 'required',
                'puc_end_date' => 'required',
                'puc_upload' => 'required|file|mimes:pdf,doc,docx',
                'insurance_start_date' => 'required',
                'insurance_end_date' => 'required',
                'insurance_upload' => 'required|file|mimes:pdf,doc,docx',
                'vehicle_fitness_start_date' => 'required',
                'vehicle_fitness_end_date' => 'required',
                'vehicle_fitness_upload' => 'required|file|mimes:pdf,doc,docx',
            ]);

            if ($request->hasFile('rc_upload')) {
                $rc_file = $request->file('rc_upload');
                $rc_file_path = $rc_file->store('vehicle_details/rc_files', 'public');
            }

            if ($request->hasFile('puc_upload')) {
                $puc_file = $request->file('puc_upload');
                $puc_file_path = $puc_file->store('vehicle_details/puc_files', 'public');
            }

            if ($request->hasFile('insurance_upload')) {
                $insurance_file = $request->file('insurance_upload');
                $insurance_file_path = $insurance_file->store('vehicle_details/insurance_files', 'public');
            }

            if ($request->hasFile('vehicle_fitness_upload')) {
                $vehicle_fitness_file = $request->file('vehicle_fitness_upload');
                $vehicle_fitness_file_path = $vehicle_fitness_file->store('vehicle_details/fitness_files', 'public');
            }


            // Store data in vehicle_history table
            DB::table('vehicle_history')->insert([
                'vehicle_name' => $request->input('vehicle_name'),
                'company_name' => $request->input('company_name'),
                'vehicle_no' => $request->input('vehicle_no'),
                'rc_no' => $request->input('rc_no'),
                'puc_start_date' => $request->input('puc_start_date'),
                'puc_end_date' => $request->input('puc_end_date'),
                'insurance_start_date' => $request->input('insurance_start_date'),
                'insurance_end_date' => $request->input('insurance_end_date'),
                'vehicle_fitness_start_date' => $request->input('vehicle_fitness_start_date'),
                'vehicle_fitness_end_date' => $request->input('vehicle_fitness_end_date'),
                'rc_upload' => isset($rc_file_path) ? $rc_file_path : null,
                'puc_upload' => isset($puc_file_path) ? $puc_file_path : null,
                'insurance_upload' => isset($insurance_file_path) ? $insurance_file_path : null,
                'vehicle_fitness_upload' => isset($vehicle_fitness_file_path) ? $vehicle_fitness_file_path : null,
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ]);

            return response()->json(['success' => 'Vehicle Details Added successfully!']);
        } catch (ValidationException $e) {
            // If validation fails, return validation errors
            return response()->json(['errors' => $e->errors()]);
        }
    }

    public function view_vehicle_detail($vehicleId)
    {
        $vehicle_detail = DB::table('vehicle_history')
                ->where('vehicle_history_id', $vehicleId)
                ->first();

        return response()->json([
            'vehicle_detail' => $vehicle_detail,
        ]);
    }
}
