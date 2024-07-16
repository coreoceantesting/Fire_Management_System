<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DriverDetail;
use App\Models\VehicleDetail;
use App\Http\Requests\GenerateSlipsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Mpdf\Mpdf;

class GenerateSlipsController extends Controller
{
    public function index()
    {
        $slip_list = DB::table('slips')->latest()->get();
        $designation_list = DB::table('designations')->where('is_deleted','0')->get();
        return view('generateslips.slipslist', compact('slip_list','designation_list'));
    }

    public function store_slip(GenerateSlipsRequest $request)
    {
        try
        {
            DB::beginTransaction();

            $input = $request->validated();

                $formattedDatetime = date('Y-m-d_H-i-s', strtotime($input['datetime']));
                $pdfFileName = $input['caller_name'] .'_'. $formattedDatetime. '.pdf';

            $data['slip_date'] = $input['datetime'];
            $data['caller_name'] = $input['caller_name'];
            $data['caller_mobile_no'] = $input['caller_mobile_no'];
            $data['incident_location_address'] = $input['incident_location'];
            $data['land_mark'] = $input['landmark'];
            $data['incident_reason'] = $input['incident_reason'];
            $data['pdf_name'] = $pdfFileName;
            $data['created_by'] = Auth::user()->id;
            $data['created_at'] = date('Y-m-d H:i:s');
            // dd($data);

            $slipId = DB::table('slips')->insertGetId($data);

            // Save notification
            $notificationData = [
                'user_id' => Auth::user()->id,
                'slip_id' => $slipId,
                'message' => 'A new slip has been generated',
                'is_read' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('notifications')->insert($notificationData);

            

            $pdf = new Mpdf();
            // Save the PDF file
            $pdfFilePath = public_path('slips/' . $pdfFileName);

            $pdfView = \View::make('generateslips.slip_pdf', [
                'slip_date' => date('Y-m-d', strtotime($input['datetime'])),
                'slip_time' => date('H:i:s', strtotime($input['datetime'])),
                'caller_name' => $input['caller_name'],
                'caller_mobile_no' => $input['caller_mobile_no'],
                'incident_location_address' => $input['incident_location'],
                'land_mark' => $input['landmark'],
                'incident_reason' => $input['incident_reason'],
            ]);

            $pdf->WriteHTML($pdfView->render());
            $pdf->Output($pdfFilePath, 'F');

            $pdfUrl = url('/slips/' . $pdfFileName);
            // below sms code will come


            DB::commit();

            return response()->json(['success'=> 'Slip Generated successfully!', 'pdf_url' => $pdfUrl]);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'creating', 'Slip');
        }
    }
    
    public function new_generated_slip()
    {
        $slip_list = DB::table('slips')->where('slip_status','Pending')->latest()->get();
        $designation_list = DB::table('designations')->where('is_deleted','0')->get();
        $vehicle_list = DB::table('vehicle_details')->where('is_deleted','0')->get();
        return view('generateslips.new_generated_slip', compact('slip_list','designation_list','vehicle_list'));
    }

    public function view_generated_slip($slipId)
    {
        // Fetch slip details based on $slipId
        $slip = DB::table('slips')->select('slip_date','caller_name','caller_mobile_no','incident_location_address','land_mark','incident_reason','slip_status')->where('slip_id',$slipId)->first();

        // Return a view or JSON response with slip details
        return response()->json(['slip_data' => $slip]);
    }

    // store slip action form
    public function store_slip_action_form(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'call_time' => 'required',
                'type_of_vehicle' => 'required',
                'number_of_vehicle' => 'required',
                'vehicle_arrival_time' => 'required',
                'vehicle_departure_from_scene_time' => 'required',
                'vehicle_arrival_at_center_time' => 'required',
                // 'total_distance' => 'required',
                // 'pumping_hours' => 'required',
                'vehicle_departure_time' => 'required',
                'worker_name.*' => 'required',
                'worker_designation.*' => 'required',
            ]);

            // Store data in slip_action_forms table
            $slipActionForm = DB::table('slip_action_form')->insertGetId([
                'slip_id' => $request->input('slip_id'),
                'call_time' => $request->input('call_time'),
                'center_name' => "पनवेल",
                'type_of_vehicle' => $request->input('type_of_vehicle'),
                'number_of_vehicle' => $request->input('number_of_vehicle'),
                'vehicle_arrival_time' => $request->input('vehicle_arrival_time'),
                'vehicle_departure_from_scene_time' => $request->input('vehicle_departure_from_scene_time'),
                'vehicle_arrival_at_center_time' => $request->input('vehicle_arrival_at_center_time'),
                'total_distance' => $request->input('total_distance'),
                'pumping_hours' => $request->input('pumping_hours'),
                'vehicle_departure_time' => $request->input('vehicle_departure_time'),
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ]);

            // Store worker details in on_field_worker_details table
            foreach ($request->input('worker_name') as $key => $workerName) {
                DB::table('on_field_worker_details')->insert([
                    'slip_action_form_id' => $slipActionForm,
                    'worker_name' => $workerName,
                    'worker_designation' => $request->input('worker_designation')[$key],
                    'created_by' => Auth::user()->id,
                    'created_at' => now(),
                ]);
            }
            
            DB::table('slips')->where('slip_id', $request->input('slip_id'))->update([
                'slip_status' => 'Action Form Submitted',
            ]);

            return response()->json(['success' => 'Action Form Submitted successfully!']);
        } catch (ValidationException $e) {
            // If validation fails, return validation errors
            return response()->json(['errors' => $e->errors()]);
        }
    }

    public function getCount()
    {
        $count = DB::table('notifications')
                    ->where('is_read', 0)
                    ->count();

        return response()->json(['count' => $count]);
    }

    public function getNotifications()
    {
        $notifications = DB::table('notifications')
                            ->join('slips', 'notifications.slip_id', '=', 'slips.slip_id')
                            // ->where('is_read', 0)
                            ->orderBy('notifications.notification_id', 'desc')
                            ->take(5)
                            ->get(['notifications.*', 'slips.caller_name', 'slips.slip_date']);

        return response()->json(['notifications' => $notifications]);
    }

    public function markAsRead($id)
    {
        $notification = DB::table('notifications')->where('notification_id', $id)->first();

        if (!$notification) {
            return response()->json(['error' => 'Notification not found.'], 404);
        }

        // Assuming 'is_read' is a boolean field in your notifications table
        DB::table('notifications')->where('notification_id', $id)->update(['is_read' => 1]);

        return response()->json(['message' => 'Notification marked as read.']);
    }

    public function markAllAsRead()
    {
        // Assuming 'is_read' is a boolean field in your notifications table
        DB::table('notifications')->where('is_read', 0)->update(['is_read' => 1]);

        return response()->json(['message' => 'All notifications marked as read.']);
    }


    

}
