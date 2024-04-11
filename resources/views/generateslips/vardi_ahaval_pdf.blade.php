<!DOCTYPE html>
<html>
<head>
    <title>{{ $slipData->caller_name }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'freeserif', 'normal';
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 3rem;
            padding: 2rem;
            border: 1px solid black;
        }

        h5, p, h4 {
            text-align: center;
            margin: 0.5rem;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-md-6 {
            width: 50%;
            float: left;
        }

        .col-md-12{
            width: 100%;
            float: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid black;
        }

        ul, ol {
            padding-left: 0;
        }

        ul li, ol li {
            list-style-type: none;
        }

        .rescuetable {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
          }

          .rescuetable .col-md-4 {
            width: 30%;
          }

          .rescuetable table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
          }

          .rescuetable table th,
          .rescuetable table td {
            padding: 10px;
            text-align: center;
            border: 1px solid black;
          }

          .rescuetable caption {
            font-weight: bold;
            margin-bottom: 0.5rem;
          }

        .vardi th, .vardi td {
            padding: 3px;
            text-align: left;
            border: 0px solid black!important;
        }
    </style>
</head>
<body>
    <div class="container">
        <p><img class="logo" src="{{ public_path('/admin/images/Panvel_Municipal_Corporation.png') }}" height="80" width="80" alt="Left Logo"></p>
        <h5>परिशिष्ट - " ग "</h5>
        <p>( ३ व ३ (ब) )</p>
        <h3 style="text-align:center;"><b>पनवेल महानगरपालिका अग्निशमन सेवा</h3>
        <p><b>आगीच्या वर्दीचा अहवाल</b></p>

        <div class="row">
            <div class="col-md-6">
                <p style="text-align: left;">विभाग :- अग्निशमन केंद्र पनवेल</p>
            </div>
            <div class="col-md-6">
                <p style="text-align: right;">वर्दीची तारीख : {{ date('d-m-Y', strtotime($slipData->slip_date)) }}</p>
            </div>   
            <div class="col-md-12">
                <p style="text-align: left;">घटनास्थळी असलेल्या कर्मचाऱ्यांचे नाव: - {{$vardiAhavalData->officer_name_present_at_last_moment}}</p>
            </div>         
        </div>

        <hr>
        <h4 class="text-center">१. वर्दी</h4>

        <table class="vardi">
            <tr>
                <th>वर्दी देणाऱ्याचे नाव</th>
                <td>:- {{$vardiAhavalData->vardi_name}}</td>
            </tr>
            <tr>
                <th>दूरध्वनी क्रमांक</th>
                <td>:- {{$vardiAhavalData->vardi_contact_no}}</td>
            </tr>
            <tr>
                <th>वर्दीचे ठिकाण</th>
                <td>:- {{$vardiAhavalData->vardi_place}}</td>
            </tr>
            <tr>
                <th>मालकाचे नाव</th>
                <td>:- {{$vardiAhavalData->owner_name}}</td>
            </tr>
            <tr>
                <th>वापर करणाऱ्याचे नाव</th>
                <td>:- {{$vardiAhavalData->vaparkarta_name}}</td>
            </tr>
            <tr>
                <th>वर्दीची वेळ</th>
                <td>:- {{date('Y-m-d', strtotime($vardiAhavalData->incident_time))}} / {{date('H:i:s', strtotime($vardiAhavalData->incident_time))}}</td>
            </tr>
            <tr>
                <th>वर्दीवर प्रथम रवाना झालेल्या गाडीची वेळ</th>
                <td>:- {{date('Y-m-d', strtotime($vardiAhavalData->first_vehicle_departing_date_time))}} / {{date('H:i;s', strtotime($vardiAhavalData->first_vehicle_departing_date_time))}}</td>
            </tr>
            <tr>
                <th>घटनास्तळी पोह्चल्याची वेळ </th>
                <td>:- {{date('Y-m-d', strtotime($vardiAhavalData->time_of_arrival_at_the_scene))}} / {{date('H:i:s', strtotime($vardiAhavalData->time_of_arrival_at_the_scene))}}</td>
            </tr>
            <tr>
                <th>अग्निशमन केंद्रापासून घटनास्तळाचे अंतर</th>
                <td>:- {{$vardiAhavalData->distance}} कि.मी </td>
            </tr>
        </table>

        <hr>
        <h4 class="text-center">२. वर्दीची सविस्तर माहिती</h4>

        <table class="vardi">
            <tr>
                <th>आग लागलेल्या ठिकाणच्या मालमत्तेचे  वर्णन</th>
                <td>:- {{$vardiAhavalData->property_description}}</td>
            </tr>
            <tr>
                <th>आगीचा प्रकार</th>
                <td>:- 
                    @if($vardiAhavalData->limit_of_fire == "Low")
                    कमी
                    @elseif($vardiAhavalData->limit_of_fire == "Medium")
                    मध्यम
                    @else
                    उच्च
                    @endif
                </td>
            </tr>
            <tr>
                <th>आगीची मर्यदा</th>
                <td>:- {{$vardiAhavalData->limit_of_fire}}</td>
            </tr>
            <tr>
                <th>आगीच शक्य कारण </th>
                <td>:- {{$vardiAhavalData->possible_cause_of_fire}}</td>
            </tr>
            <tr>
                <th>नुकसानीचे वर्णन</th>
                <td>:- {{$vardiAhavalData->description_of_damage}}</td>
            </tr>
            <tr>
                <th>अंदाजित नुकसान
                    <ol>
                        <li>मालमत्ता</li>
                        <li>आजुबाजुचा परिसर </li>
                        <li>जागेचे नुकसान</li>
                        <li>वस्तुचे नुकसान</li>
                    </ol>
                </th>
                <td>
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li>:- {{$vardiAhavalData->property_damage}} (लाखात ) विमा कंपनी सर्वेक्षणानुसार </li>
                        <li>:- {{$vardiAhavalData->area_damage}}</li>
                        <li>:- {{$vardiAhavalData->space_loss}}</li>
                        <li>:- {{$vardiAhavalData->property_loss}} (लाखात ) विमा कंपनी सर्वेक्षणानुसार </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>अखेरच्या क्षणी घटनास्तळी असलेल्या अधिकारीचें नाव</th>
                <td>:- {{$vardiAhavalData->officer_name_present_at_last_moment}}</td>
            </tr>
            <tr>
                <th>घटनास्तळावरून निघाल्याची तारीख </th>
                <td>:- {{date('Y-m-d', strtotime($vardiAhavalData->date_of_departure_from_scene))}} </td>
            </tr>
            <tr>
                <th>घटनास्तळावरून निघाल्याची वेळ</th>
                <td>:- {{date('H-i-s', strtotime($vardiAhavalData->time_of_departure_from_scene))}}</td>
            </tr>
            <tr>
                <th>एकुण वेळ</th>
                <td>:- {{$vardiAhavalData->total_time}}</td>
            </tr>
            <tr>
                <th>एकुण तास</th>
                <td>:- {{$vardiAhavalData->total_hour}}</td>
            </tr>
        </table>

        <hr>
        <h4 class="text-center">३.आगीमधून विमोचन व वाचवलेल्या व्यक्ती</h4>

        <div class="row rescuetable">
            <div class="col-md-6">
               <table>
                <caption class="text-center" style="padding:10px"><b>अग्निशमन विभागा व्यतिरिक्त केलेले विमोचन कार्य</b></caption>
                    <tr>
                        <th>पुरुष संख्या</th>
                        <th>स्त्री संख्या</th>
                    </tr>
                    <tr>
                        <td>{{$vardiAhavalData->male_one}}</td>
                        <td>{{$vardiAhavalData->woman_one}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
               <table>
                <caption class="text-center"><b>अग्निशमन विभागाने बचाव वाहनाचा वापर न करता केलेले विमोचन कार्य</b></caption>
                    <tr>
                        <th>पुरुष संख्या</th>
                        <th>स्त्री संख्या</th>
                    </tr>
                    <tr>
                        <td>{{$vardiAhavalData->male_two}}</td>
                        <td>{{$vardiAhavalData->woman_two}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
               <table>
                <caption class="text-center"><b>अग्निशमन विभागाने बचाव वाहनाचा वापर केलेले विमोचन कार्य</b></caption>
                    <tr>
                        <th>पुरुष संख्या</th>
                        <th>स्त्री संख्या</th>
                    </tr>
                    <tr>
                        <td>{{$vardiAhavalData->male_three}}</td>
                        <td>{{$vardiAhavalData->woman_three}}</td>
                    </tr>
                </table>
            </div>
            
        </div>

        <hr>
        <h4 class="text-center">४. जखमीबाबतची माहिती </h4>
        <div class="row rescuetable">
            <div class="col-md-6">
               <table>
                    <caption class="text-center"><b>मयत</b></caption>
                    <tr>
                        <th>पुरुष संख्या</th>
                        <th>स्त्री संख्या</th>
                    </tr>
                    <tr>
                        <td>{{$vardiAhavalData->deceased_male}}</td>
                        <td>{{$vardiAhavalData->deceased_woman}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
               <table>
                    <caption class="text-center"><b>जखमी</b></caption>
                    <tr>
                        <th>पुरुष संख्या</th>
                        <th>स्त्री संख्या</th>
                    </tr>
                    <tr>
                        <td>{{$vardiAhavalData->wounded_male}}</td>
                        <td>{{$vardiAhavalData->wounded_woman}}</td>
                    </tr>
                </table>
            </div>            
        </div>

        <hr>
        <h4 class="text-center">५. घटना पुस्तकाचा तपशील </h4>
        <div class="row rescue-table">
            <div class="col-md-12">
               <table>
                    <thead>
                        <tr>
                          <th scope="col">फायर स्टेशनचे नाव</th>
                          <th scope="col">वाहन प्रकार</th>
                          <th scope="col">वाहन क्रमांक</th>
                          <th scope="col">वाहन सुटण्याची तारीख वेळ</th>
                          <th scope="col">वाहनाच्या आगमनाची तारीख वेळ</th>
                          <th scope="col">पोहचण्याची तारीख वेळ</th>
                          <th scope="col">केंद्रावर परतण्याची वेळ</th>
                          <th scope="col">एकूण कि.मी</th>
                          <th scope="col">पंपिंग तास</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$actionTakenData->center_name}}</td>
                          <td>{{$actionTakenData->type_of_vehicle}}</td>
                          <td>{{$actionTakenData->number_of_vehicle}}</td>
                          <td>{{ date('Y-m-d H:i:s', strtotime($actionTakenData->vehicle_arrival_time)) }}</td>
                          <td>{{date('Y-m-d', strtotime($actionTakenData->vehicle_departure_time))}} / {{date('H-i-s', strtotime($actionTakenData->vehicle_departure_time))}}</td>
                          <td>{{date('Y-m-d', strtotime($actionTakenData->vehicle_departure_from_scene_time))}} / {{date('H-i-s', strtotime($actionTakenData->vehicle_departure_from_scene_time))}}</td>
                          <td>{{date('Y-m-d', strtotime($actionTakenData->vehicle_arrival_at_center_time))}} / {{date('H-i-s', strtotime($actionTakenData->vehicle_arrival_at_center_time))}}</td>
                          {{-- <td>{{date('Y-m-d', strtotime($actionTakenData->vehicle_arrival_time))}} / {{date('H-i-s', strtotime($actionTakenData->vehicle_arrival_time))}}</td> --}}
                          <td>{{$actionTakenData->total_distance}} कि .मी </td>
                          <td>{{$actionTakenData->pumping_hours}} कि .मी </td>
                          {{-- <td>{{$actionTakenData->center_name}}</td> --}}
                        </tr>
                        @foreach($additionalHelpDetails as $data)
                        <tr>
                            <td>{{$data->center_name}}</td>
                            <td>{{$data->type_of_vehicle}}</td>
                            <td>{{$data->vehicle_number}}</td>
                            <td>{{ date('Y-m-d H:i:s', strtotime($data->vehicle_departure_time)) }}</td>
                            <td>{{date('Y-m-d', strtotime($data->vehicle_arrival_time))}} / {{date('H-i-s', strtotime($data->vehicle_arrival_time))}}</td>
                            <td>{{date('Y-m-d', strtotime($data->vehicle_return_time))}} / {{date('H-i-s', strtotime($data->vehicle_return_time))}}</td>
                            <td>{{date('Y-m-d', strtotime($data->vehicle_return_to_center_time))}} / {{date('H-i-s', strtotime($data->vehicle_return_to_center_time))}}</td>
                            <td>{{$data->total_distance}} कि .मी </td>
                            <td>{{$data->pumping_hours}} कि .मी </td>
                        </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>            
        </div>

        <hr>
        <h4 class="text-center">६. वर्दीवर गेलेल्या कमर्चारी वर्ग </h4>
        <div class="row rescue-table">
            <div class="col-md-12">
               <table>
                    <thead>
                        <tr>
                          <th scope="col">अ .क्र </th>
                          <th scope="col">अधिकारी / कर्मचाऱ्यांची नावे </th>
                          <th scope="col">पदनाम</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $serialNumber = 1; // Initialize the serial number
                        @endphp
                        @foreach($workers_Details as $data)
                        <tr>
                          <td>{{ $serialNumber++ }}</td>
                          <td>{{ $data->worker_name }}</td>
                          <td>{{ $data->designation_name }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                </table>
            </div>            
        </div>

        <p style="text-align: left">अशाप्रकारे विझविली :- {{$actionTakenData->number_of_vehicle}} , @foreach($additionalHelpDetails as $no) {{ $no->vehicle_number }}, @endforeach या  वाहनाच्या होजरीलच्या सहाय्याने आग पूर्णपणे  विझवली .</p>
        <p style="text-align: left">सदर घटनेची नोंद अग्निशमन केंद्र, पनवेल महानगरपालिका येथील घटनापुस्तक क्रमांक {{$vardiAhavalData->book_no}} मध्ये पुष्ठ क्र . {{$vardiAhavalData->page_no}} वर घेतलेली आहे . </p>
        <p style="text-align: left">सदरचा  नमुना(फॉरमॅट) हा स्टेट फायर एडवाइजरी काउंसिल यांनी दिलेल्या मार्गदर्शन तत्वावरून आहे .</p>
        <ul style="list-style-type:none; text-align:right; padding-top:8rem;">
            <li>प्र.अग्निशमन विभाग प्रमुख</li>
            <li>पनवेल महानगरपालिका</li>
        </ul>

    </div>
</body>
</html>
