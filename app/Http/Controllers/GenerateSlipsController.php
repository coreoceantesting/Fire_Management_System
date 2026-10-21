<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DriverDetail;
use App\Models\VehicleDetail;
use App\Models\FireCause;
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
        $firestation_list = DB::table('fire_stations')->where('is_deleted','0')->get();
        $designation_list = DB::table('designations')->where('is_deleted','0')->get();
        $fire_cause_list = FireCause::where('is_deleted','0')->latest()->get();
        return view('generateslips.slipslist', compact('slip_list','designation_list', 'fire_cause_list', 'firestation_list'));
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
            $data['fire_station'] = $input['fire_station'];
            $data['land_mark'] = $input['landmark'];
            $data['incident_reason'] = $input['incident_reason'];
            $data['pdf_name'] = $pdfFileName;
            $data['created_by'] = Auth::user()->id;
            $data['created_at'] = date('Y-m-d H:i:s');
            // dd($data);

            // Retrieve the last slip number and increment it
            $lastSlip = DB::table('slips')->orderBy('slip_id', 'desc')->first();
            if ($lastSlip) {
                $lastSlipNumber = intval(substr($lastSlip->slip_unique_number, -2));
            } else {
                $lastSlipNumber = 0;
            }
            $newSlipNumber = str_pad($lastSlipNumber + 1, 2, '0', STR_PAD_LEFT);
            $data['slip_unique_number'] = $newSlipNumber;


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
                'fire_station' => $input['fire_station'],
                'land_mark' => $input['landmark'],
                'incident_reason' => $input['incident_reason'],
                'generated_by' => Auth::user()->name,
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
            $rules = [
                'slip_id' => 'required',
                'call_time' => ['required', 'date_format:Y-m-d\TH:i,Y-m-d\TH:i:s,Y-m-d H:i,Y-m-d H:i:s', 'regex:/^(19|20)\d{2}-\d{2}-\d{2}[T ]\d{2}:\d{2}(:\d{2})?$/'],
                'type_of_vehicle' => 'required',
                'number_of_vehicle' => 'required',
                'vehicle_departure_time' => ['required', 'date_format:Y-m-d\TH:i,Y-m-d\TH:i:s,Y-m-d H:i,Y-m-d H:i:s', 'regex:/^(19|20)\d{2}-\d{2}-\d{2}[T ]\d{2}:\d{2}(:\d{2})?$/'],
                'vehicle_arrival_time' => ['required', 'date_format:Y-m-d\TH:i,Y-m-d\TH:i:s,Y-m-d H:i,Y-m-d H:i:s', 'regex:/^(19|20)\d{2}-\d{2}-\d{2}[T ]\d{2}:\d{2}(:\d{2})?$/'],
                'vehicle_departure_from_scene_time' => ['required', 'date_format:Y-m-d\TH:i,Y-m-d\TH:i:s,Y-m-d H:i,Y-m-d H:i:s', 'regex:/^(19|20)\d{2}-\d{2}-\d{2}[T ]\d{2}:\d{2}(:\d{2})?$/'],
                'vehicle_arrival_at_center_time' => ['required', 'date_format:Y-m-d\TH:i,Y-m-d\TH:i:s,Y-m-d H:i,Y-m-d H:i:s', 'regex:/^(19|20)\d{2}-\d{2}-\d{2}[T ]\d{2}:\d{2}(:\d{2})?$/'],
                // 'total_distance' => 'required',
                // 'pumping_hours' => 'required',
                'worker_name.*' => 'required',
                'worker_designation.*' => 'required',
            ];

            $messages = [
                'call_time.*' => 'कृपया कॉलची वैध तारीख आणि वेळ निवडा (वर्ष ४ अंकी असावे) / Please enter a valid call date & time.',
                'vehicle_departure_time.*' => 'कृपया वाहन सुटण्याची वैध तारीख आणि वेळ निवडा (वर्ष ४ अंकी असावे) / Please enter a valid vehicle departure date & time.',
                'vehicle_arrival_time.*' => 'कृपया वाहन पोचण्याची वैध तारीख आणि वेळ निवडा (वर्ष ४ अंकी असावे) / Please enter a valid vehicle arrival date & time.',
                'vehicle_departure_from_scene_time.*' => 'कृपया घटनास्तळावरुन निघाल्याची वैध तारीख आणि वेळ निवडा (वर्ष ४ अंकी असावे) / Please enter a valid departure date & time.',
                'vehicle_arrival_at_center_time.*' => 'कृपया केंद्रामध्ये आल्याची वैध तारीख आणि वेळ निवडा (वर्ष ४ अंकी असावे) / Please enter a valid vehicle arrival at center date & time.',
                'type_of_vehicle.required' => 'वाहनाचा प्रकार निवडा / Please select type of vehicle.',
                'number_of_vehicle.required' => 'वाहनाचा नंबर निवडा / Please select vehicle number.',
                'worker_name.*.required' => 'कर्मचाऱ्यांचे नाव आवश्यक आहे / Worker name is required.',
                'worker_designation.*.required' => 'कर्मचाऱ्यांचे तपशील आवश्यक आहे / Worker designation is required.',
            ];

            $request->validate($rules, $messages);

            // Format datetime values properly for MySQL
            $callTime = $request->filled('call_time') ? date('Y-m-d H:i:s', strtotime($request->input('call_time'))) : null;
            $departureTime = $request->filled('vehicle_departure_time') ? date('Y-m-d H:i:s', strtotime($request->input('vehicle_departure_time'))) : null;
            $arrivalTime = $request->filled('vehicle_arrival_time') ? date('Y-m-d H:i:s', strtotime($request->input('vehicle_arrival_time'))) : null;
            $departureFromScene = $request->filled('vehicle_departure_from_scene_time') ? date('Y-m-d H:i:s', strtotime($request->input('vehicle_departure_from_scene_time'))) : null;
            $arrivalAtCenter = $request->filled('vehicle_arrival_at_center_time') ? date('Y-m-d H:i:s', strtotime($request->input('vehicle_arrival_at_center_time'))) : null;

            // Store data in slip_action_forms table
            $slipActionForm = DB::table('slip_action_form')->insertGetId([
                'slip_id' => $request->input('slip_id'),
                'call_time' => $callTime,
                'center_name' => "पनवेल",
                'type_of_vehicle' => $request->input('type_of_vehicle'),
                'number_of_vehicle' => $request->input('number_of_vehicle'),
                'vehicle_arrival_time' => $arrivalTime,
                'vehicle_departure_from_scene_time' => $departureFromScene,
                'vehicle_arrival_at_center_time' => $arrivalAtCenter,
                'total_distance' => $request->input('total_distance'),
                'pumping_hours' => $request->input('pumping_hours'),
                'vehicle_departure_time' => $departureTime,
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ]);

            // Store worker details in on_field_worker_details table
            if ($request->has('worker_name')) {
                foreach ($request->input('worker_name') as $key => $workerName) {
                    DB::table('on_field_worker_details')->insert([
                        'slip_action_form_id' => $slipActionForm,
                        'worker_name' => $workerName,
                        'worker_designation' => $request->input('worker_designation')[$key] ?? null,
                        'created_by' => Auth::user()->id,
                        'created_at' => now(),
                    ]);
                }
            }

            DB::table('slips')->where('slip_id', $request->input('slip_id'))->update([
                'slip_status' => 'Action Form Submitted',
            ]);

            return response()->json(['success' => 'Action Form Submitted successfully!']);
        } catch (ValidationException $e) {
            // If validation fails, return validation errors with 422 status
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error($e);
            // If database query fails due to invalid datetime format, identify the exact column
            if ($e->getCode() == 22007 || str_contains($e->getMessage(), '1292 Incorrect datetime value')) {
                if (preg_match("/for column ['`]([^'`]+)['`]/", $e->getMessage(), $matches)) {
                    $column = $matches[1];
                    return response()->json([
                        'errors' => [
                            $column => ['अवैध तारीख आणि वेळ (कृपया वैध 4-अंकी वर्ष प्रविष्ट करा). / Invalid date and time format.']
                        ]
                    ], 422);
                }
            }
            return response()->json(['error2' => 'Database error: ' . $e->getMessage()], 500);
        } catch (\Throwable $e) {
            \Log::error($e);
            return response()->json(['error2' => 'An unexpected error occurred: ' . $e->getMessage()], 500);
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
