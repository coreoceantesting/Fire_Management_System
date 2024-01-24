<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DriverDetail;
use App\Models\VehicleDetail;
use App\Http\Requests\GenerateSlipsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;

class OccuranceBookController extends Controller
{
    public function action_taken_slips_list()
    {
        $slip_list = DB::table('slips')
        ->where('slip_status', '!=', 'pending')
        ->where(function ($query) {
            $query->where('is_occurance_book_submitted', '0')
                ->orWhere('is_additional_form_submitted', '0');
        })
        ->latest()
        ->get();
        $designation_list = DB::table('designations')->where('is_deleted','0')->get();
        $fire_station_list = DB::table('fire_stations')->where('fire_station_is_active','0')->where('is_deleted','0')->get();
        $vehicle_list = DB::table('vehicle_details')->where('is_deleted','0')->get();
        return view('generateslips.action_taken_list', compact('slip_list','designation_list','fire_station_list','vehicle_list'));
    }

    public function view_action_taken_slip($slipId)
    {
        // Fetch slip details based on $slipId
        $slip = DB::table('slips')->select('slip_date','caller_name','caller_mobile_no','incident_location_address','land_mark','incident_reason','slip_status')->where('slip_id',$slipId)->first();
        
        // Fetch additional data from slip_action_form
        $slipActionFormData = DB::table('slip_action_form')->select('*')->where('slip_id', $slipId)->first();

        // Fetch worker details from on_field_worker_details with designation name
        $workerDetails = DB::table('on_field_worker_details')
            ->select('on_field_worker_details.worker_name', 'designations.designation_name')
            ->join('designations', 'on_field_worker_details.worker_designation', '=', 'designations.designation_id')
            ->where('on_field_worker_details.slip_action_form_id', $slipActionFormData->slip_action_form_id)
            ->get();

        $additionalHelpDetails = DB::table('additional_help_details')
            ->select(
                'additional_help_details.inform_call_time',
                'additional_help_details.vehicle_departure_time',
                'additional_help_details.vehicle_arrival_time', 
                'additional_help_details.vehicle_return_time', 
                'additional_help_details.no_of_fireman',
                'additional_help_details.type_of_vehicle',
                'additional_help_details.vehicle_return_to_center_time',
                'additional_help_details.total_distance',
                'additional_help_details.pumping_hours',
                'vehicle_details.vehicle_number',
                'fire_stations.name',)
            ->join('fire_stations', 'additional_help_details.fire_station_name', '=', 'fire_stations.fire_station_id')
            ->join('vehicle_details', 'additional_help_details.vehicle_number', '=', 'vehicle_details.vehicle_id')
            ->where('additional_help_details.slip_id', $slipId)
            ->get();

        $occuranceBookDetails = DB::table('occurance_book')->select('occurance_book_date','occurance_book_description', 'occurance_book_remark')->where('slip_id', $slipId)->first();
        // dd($additionalHelpDetails);

        // Return a view or JSON response with slip details and additional data
        return response()->json([
            'slip_data' => $slip,
            'slip_action_form_data' => $slipActionFormData,
            'worker_details' => $workerDetails,
            'additional_help_details' => $additionalHelpDetails,
            'occurance_book_details' => $occuranceBookDetails
        ]);
    }

    public function store_additional(Request $request)
    {
        $request->validate([
            'fire_station' => 'required|array',
            'no_of_fireman' => 'required|array',
            'vehicle_no' => 'required|array',
            'inform_call_time' => 'required|array',
            'departure_vehicle_datetime' => 'required|array',
            'vehicle_arrival_datetime' => 'required|array',
            'vehicle_return_to_firestation_datetime' => 'required|array',
        ]);
    
        // Store data in the database
        foreach ($request->input('fire_station') as $key => $fireStation) {
            DB::table('additional_help_details')->insert([
                'slip_id' => $request->input('slip_id'),
                'center_name' => "पनवेल",
                'fire_station_name' => $fireStation,
                'no_of_fireman' => $request->input('no_of_fireman')[$key],
                'vehicle_number' => $request->input('vehicle_no')[$key],
                'type_of_vehicle' => $request->input('type_of_vehicle')[$key],
                'inform_call_time' => $request->input('inform_call_time')[$key],
                'vehicle_departure_time' => $request->input('departure_vehicle_datetime')[$key],
                'vehicle_arrival_time' => $request->input('vehicle_arrival_datetime')[$key],
                'vehicle_return_time' => $request->input('vehicle_return_to_firestation_datetime')[$key],
                'vehicle_return_to_center_time' => $request->input('vehicle_return_to_center_datetime')[$key],
                'total_distance' => $request->input('total_distance')[$key],
                'pumping_hours' => $request->input('pumping_hours')[$key],
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        
        DB::table('slips')->where('slip_id',$request->input('slip_id'))->update([
            'is_additional_form_submitted' => '1',
            'slip_status' => 'Additional Help Submitted',
        ]);

        return response()->json(['success'=> 'Additional Help Submitted successfully!']);
    }

    public function store_occurance_book(Request $request)
    {
        $request->validate([
            'datetime_new' => 'required',
            'description' => 'required',
            'remark' => 'required',
        ]);

        DB::table('occurance_book')->insert([
            'slip_id' => $request->input('slip_id_new'),
            'occurance_book_date' => $request->input('datetime_new'),
            'occurance_book_description' => $request->input('description'),
            'occurance_book_remark' => $request->input('remark'),
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('slips')->where('slip_id',$request->input('slip_id_new'))->update([
            'is_occurance_book_submitted' => '1',
            'slip_status' => 'Occurance Book Submitted',
        ]);

        return response()->json(['success'=> 'Occurance Book Submitted successfully!']);
    }

    // vardi ahawal List
    
    public function vardi_ahaval_list()
    {
        $slip_list = DB::table('slips')->where('is_occurance_book_submitted','1')->latest()->get();
        $designation_list = DB::table('designations')->where('is_deleted','0')->get();
        $fire_station_list = DB::table('fire_stations')->where('fire_station_is_active','0')->where('is_deleted','0')->get();
        $vehicle_list = DB::table('vehicle_details')->where('is_deleted','0')->get();
        return view('generateslips.list_for_vardi_ahaval', compact('slip_list','designation_list','fire_station_list','vehicle_list'));
    }

    public function slip_details($slipId)
    {
        // Fetch slip details based on $slipId
        // $slip = DB::table('slips')->select('slip_date','caller_name','caller_mobile_no','incident_location_address','land_mark','incident_reason','slip_status')->where('slip_id',$slipId)->first();
        $slip_details = DB::table('slips')
        ->select('slips.slip_id', 'slips.caller_name', 'slips.caller_mobile_no', 'slips.incident_location_address', 'slip_action_form.call_time', 'slip_action_form.vehicle_departure_time')
        ->join('slip_action_form', 'slips.slip_id', '=', 'slip_action_form.slip_id')
        ->where('slips.slip_id', $slipId)
        ->first();

        $response = [
            'result' => 1,
            'slip_data' => $slip_details,
        ];

        // Return a view or JSON response with slip details
        return $response;
    }

    public function store_vardi_ahaval(Request $request)
    {
            $request->validate([
                'vardi_name' => 'required',
                'vardi_contact_no' => 'required',
                'vardi_place' => 'required',
                'owner_name' => 'required',
                'vaparkarta_name' => 'required',
                'incident_time' => 'required',
                'first_vehicle_departing_date_time' => 'required',
                'time_of_arrival_at_the_scene' => 'required',
                'distance' => 'required',
                'property_description' => 'required',
                'type_of_fire' => 'required',
                'limit_of_fire' => 'required',
                'possible_cause_of_fire' => 'required',
                'description_of_damage' => 'required',
                'property_damage' => 'required',
                'area_damage' => 'required',
                'space_loss' => 'required',
                'property_loss' => 'required',
                'officer_name_present_at_last_moment' => 'required',
                'date_of_departure_from_scene' => 'required',
                'time_of_departure_from_scene' => 'required',
                'total_time' => 'required',
                'total_hour' => 'required',
                'male_one' => 'required',
                'woman_one' => 'required',
                'male_two' => 'required',
                'woman_two' => 'required',
                'male_three' => 'required',
                'woman_three' => 'required',
                'deceased_male' => 'required',
                'deceased_woman' => 'required',
                'wounded_male' => 'required',
                'wounded_woman' => 'required',
            ]);
    
            // Store data in the database
            DB::table('vardi_ahaval_details')->insert([
                'slip_id' => $request->input('edit_model_id_new'),
                'vardi_name' => $request->input('vardi_name'),
                'vardi_contact_no' => $request->input('vardi_contact_no'),
                'vardi_place' => $request->input('vardi_place'),
                'owner_name' => $request->input('owner_name'),
                'vaparkarta_name' => $request->input('vaparkarta_name'),
                'incident_time' => $request->input('incident_time'),
                'first_vehicle_departing_date_time' => $request->input('first_vehicle_departing_date_time'),
                'time_of_arrival_at_the_scene' => $request->input('time_of_arrival_at_the_scene'),
                'distance' => $request->input('distance'),
                'property_description' => $request->input('property_description'),
                'type_of_fire' => $request->input('type_of_fire'),
                'limit_of_fire' => $request->input('limit_of_fire'),
                'possible_cause_of_fire' => $request->input('possible_cause_of_fire'),
                'description_of_damage' => $request->input('description_of_damage'),
                'property_damage' => $request->input('property_damage'),
                'area_damage' => $request->input('area_damage'),
                'space_loss' => $request->input('space_loss'),
                'property_loss' => $request->input('property_loss'),
                'officer_name_present_at_last_moment' => $request->input('officer_name_present_at_last_moment'),
                'date_of_departure_from_scene' => $request->input('date_of_departure_from_scene'),
                'time_of_departure_from_scene' => $request->input('time_of_departure_from_scene'),
                'total_time' => $request->input('total_time'),
                'total_hour' => $request->input('total_hour'),
                'male_one' => $request->input('male_one'),
                'woman_one' => $request->input('woman_one'),
                'male_two' => $request->input('male_two'),
                'woman_two' => $request->input('woman_two'),
                'male_three' => $request->input('male_three'),
                'woman_three' => $request->input('woman_three'),
                'deceased_male' => $request->input('deceased_male'),
                'deceased_woman' => $request->input('deceased_woman'),
                'wounded_male' => $request->input('wounded_male'),
                'wounded_woman' => $request->input('wounded_woman'),
                'created_by' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        
            DB::table('slips')->where('slip_id',$request->input('edit_model_id_new'))->update([
                'is_vardi_ahaval_submitted' => '1',
                'slip_status' => 'Vardi Ahval Submitted',
            ]);

            // Create mPDF instance
            $pdf = new Mpdf();
            $slipData = DB::table('slips')->where('slip_id', $request->input('edit_model_id_new'))->first();
            // Save the generated PDF to a temporary file
            $formattedDatetime = date('Y-m-d_H_i_s');
            $pdfFileName = $slipData->caller_name.'_'. $formattedDatetime . '.pdf';
            $pdfFilePath = public_path('vardi_ahaval/' . $pdfFileName);

            // Update 'slips' table with the PDF file name
            DB::table('slips')->where('slip_id', $request->input('edit_model_id_new'))->update([
                'vardi_ahaval_pdf_name' => $pdfFileName,
            ]);

            // Retrieve data from the database (if needed for PDF content)
            $slipData = DB::table('slips')->where('slip_id', $request->input('edit_model_id_new'))->first();
            $vardiAhavalData = DB::table('vardi_ahaval_details')->where('slip_id', $request->input('edit_model_id_new'))->first();
            $actionTakenData = DB::table('slip_action_form')->where('slip_id', $request->input('edit_model_id_new'))->first();
            $additionalHelpDetails = DB::table('additional_help_details')
            ->select(
                'additional_help_details.inform_call_time',
                'additional_help_details.vehicle_departure_time',
                'additional_help_details.vehicle_arrival_time', 
                'additional_help_details.vehicle_return_time', 
                'additional_help_details.no_of_fireman',
                'additional_help_details.center_name',
                'additional_help_details.type_of_vehicle',
                'additional_help_details.vehicle_return_to_center_time',
                'additional_help_details.total_distance',
                'additional_help_details.pumping_hours',
                'vehicle_details.vehicle_number',
                'fire_stations.name',)
            ->join('fire_stations', 'additional_help_details.fire_station_name', '=', 'fire_stations.fire_station_id')
            ->join('vehicle_details', 'additional_help_details.vehicle_number', '=', 'vehicle_details.vehicle_id')
            ->where('additional_help_details.slip_id', $request->input('edit_model_id_new'))
            ->get();
            $workers_Details = DB::table('on_field_worker_details')
            ->join('designations', 'on_field_worker_details.worker_designation', '=', 'designations.designation_id')
            ->where('on_field_worker_details.slip_action_form_id',$actionTakenData->slip_action_form_id)
            ->get();

            // Render the PDF view (adjust the view path based on your project structure)
            $pdfview = view('generateslips.vardi_ahaval_pdf', compact('slipData','vardiAhavalData','actionTakenData','additionalHelpDetails','workers_Details'));
            
            $pdf->WriteHTML($pdfview->render());

            // Output the PDF to the file
            $pdf->Output($pdfFilePath, 'F');

            return response()->json(['success' => 'Vardi Ahawal Submitted successfully!']);
    }

    public function vardi_ahaval_pdf($slip_id)
    {
        // Fetch data related to the slip
        $slipData = DB::table('slips')->where('slip_id', $slip_id)->first();

        // Create mPDF instance
        $mpdf = new Mpdf();

        // Use mPDF to generate the PDF from the view
        $pdf = view('generateslips.vardi_ahaval_pdf', compact('slipData'))->render();

        // Save the generated PDF to a temporary file
        $formattedDatetime = date('Y-m-d_H_i_s', strtotime($slipData->slip_date));
        $pdfFileName = $slipData->caller_name . '_' . $formattedDatetime . '.pdf';
        $pdfFilePath = public_path('vardi_ahaval/' . $pdfFileName);

        // Write PDF content to the file
        file_put_contents($pdfFilePath, $pdf);

        // Return the response with the PDF file path
        return response()->json(['pdfUrl' => $pdfFilePath]);
    }



}
