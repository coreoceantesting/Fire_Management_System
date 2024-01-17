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

class GenerateSlipsController extends Controller
{
    public function index()
    {
        $slip_list = DB::table('slips')->latest()->get();
        return view('generateslips.slipslist', compact('slip_list'));
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

            DB::table('slips')->insert($data);

            

            $pdf = new Mpdf();
            // Save the PDF file
            $pdfFilePath = public_path('slips/' . $pdfFileName);

            $pdfView = \View::make('generateslips.slip_pdf', [
                'slip_date' => $formattedDatetime,
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

    public function filter(Request $request)
    {
        // Your filtering logic here
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $start_datetime = $start_date . ' 00:00:00';
        $end_datetime = $end_date . ' 23:59:59';

        $slip_list = DB::table('slips')
            ->whereBetween('slip_date', [$start_datetime, $end_datetime])
            ->latest()
            ->get();

        return view('generateslips.slipslist', compact('slip_list'));
    }

    

}
