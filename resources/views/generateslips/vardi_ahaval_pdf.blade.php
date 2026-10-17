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
        <p style="text-align:left">Sr.No :- {{ $slipData->slip_unique_number }}</p>
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
                <p style="text-align: right;">वर्दीची तारीख : {{ !empty($slipData->slip_date) ? date('d-m-Y', strtotime($slipData->slip_date)) : '-' }}</p>
            </div>   
            <div class="col-md-6">
                <p style="text-align: left;">कॉलचा प्रकार : {{ $vardiAhavalData->space_loss ?? 'अस्सल' }}</p>
            </div>
            <div class="col-md-6">
                <p style="text-align: right;">घटनास्थळी असलेल्या कर्मचाऱ्यांचे नाव: - {{ $vardiAhavalData->vardi_employee_name ?? (!in_array($vardiAhavalData->officer_name_present_at_last_moment ?? '', ['vehicle', 'Fire Type of vehicle', 'fire rescue', 'Zane Hayes']) ? $vardiAhavalData->officer_name_present_at_last_moment : ($vardiAhavalData->vardi_officer_name ?? '-')) }}</p>
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
            @if(!empty($vardiAhavalData->vardi_business))
            <tr>
                <th>धंदा</th>
                <td>:- {{$vardiAhavalData->vardi_business}}</td>
            </tr>
            @endif
            <tr>
                <th>मालकाचे नाव</th>
                <td>:- {{$vardiAhavalData->owner_name}}</td>
            </tr>
            <tr>
                <th>वापर करणाऱ्याचे नाव / भाडेकऱ्यांचे नाव</th>
                <td>:- {{$vardiAhavalData->vaparkarta_name}}</td>
            </tr>
            <tr>
                <th>वर्दीची वेळ</th>
                <td>:-  
                    @php
                        $incidentTime = !empty($vardiAhavalData->incident_time) ? $vardiAhavalData->incident_time : (!empty($actionTakenData->call_time) ? $actionTakenData->call_time : (!empty($slipData->slip_date) ? $slipData->slip_date : null));
                    @endphp
                    @if($incidentTime)
                        {{ date('d-m-Y', strtotime($incidentTime)) }} / {{ date('H:i:s', strtotime($incidentTime)) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>वर्दीवर प्रथम रवाना झालेल्या गाडीची वेळ</th>
                <td>:- 
                    @php
                        $firstVehicleTime = !empty($vardiAhavalData->first_vehicle_departing_date_time) ? $vardiAhavalData->first_vehicle_departing_date_time : (!empty($actionTakenData->vehicle_departure_time) ? $actionTakenData->vehicle_departure_time : null);
                    @endphp
                    @if($firstVehicleTime)
                        {{ date('d-m-Y', strtotime($firstVehicleTime)) }} / {{ date('H:i:s', strtotime($firstVehicleTime)) }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>घटनास्थळी पोहोचल्याची वेळ</th>
                <td>:- 
                    @php
                        $arrivalSceneTime = !empty($vardiAhavalData->time_of_arrival_at_the_scene) ? $vardiAhavalData->time_of_arrival_at_the_scene : (!empty($actionTakenData->vehicle_arrival_time) ? $actionTakenData->vehicle_arrival_time : null);
                    @endphp
                    @if($arrivalSceneTime)
                        @if(preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', trim($arrivalSceneTime)))
                            {{ trim($arrivalSceneTime) }}
                        @else
                            {{ date('d-m-Y', strtotime($arrivalSceneTime)) }} / {{ date('H:i:s', strtotime($arrivalSceneTime)) }}
                        @endif
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>अग्निशमन केंद्रापासून घटनास्थळाचे अंतर</th>
                <td>:- {{ $vardiAhavalData->distance ?? ($vardiAhavalData->vardi_km ?? ($actionTakenData->total_distance ?? '-')) }} कि.मी </td>
            </tr>
        </table>

        <hr>
        <h4 class="text-center">२. वर्दीची सविस्तर माहिती</h4>

        <table class="vardi">
            <tr>
                <th>कॉलचा प्रकार</th>
                <td>:- {{ $vardiAhavalData->space_loss ?? 'अस्सल' }}</td>
            </tr>
            <tr>
                <th>नुकसानीचे वर्णन</th>
                <td>:- 
                    @php
                        $damageDesc = !empty($vardiAhavalData->vardi_damage) && !preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', trim($vardiAhavalData->vardi_damage)) 
                            ? $vardiAhavalData->vardi_damage 
                            : (!empty($vardiAhavalData->description_of_damage) && !preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', trim($vardiAhavalData->description_of_damage)) 
                                ? $vardiAhavalData->description_of_damage 
                                : ($vardiAhavalData->property_description ?? '-'));
                    @endphp
                    {{ $damageDesc }}
                </td>
            </tr>
            @if(!empty($vardiAhavalData->vardi_construction))
            <tr>
                <th>बांधकाम इत्यादी</th>
                <td>:- {{ $vardiAhavalData->vardi_construction }}</td>
            </tr>
            @endif
            <tr>
                <th>वर्दीचा प्रकार / आगीचा प्रकार</th>
                <td>:- 
                    @if(!empty($vardiAhavalData->vardi_uniform_type))
                        {{ $vardiAhavalData->vardi_uniform_type }}
                    @elseif(!empty($vardiAhavalData->type_of_fire))
                        {{ $vardiAhavalData->type_of_fire }}
                    @elseif($vardiAhavalData->limit_of_fire == "Low")
                        कमी (Low)
                    @elseif($vardiAhavalData->limit_of_fire == "Medium")
                        मध्यम (Medium)
                    @elseif($vardiAhavalData->limit_of_fire == "High")
                        उच्च (High)
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>आगीचे / वर्दीचे शक्य कारण</th>
                <td>:- {{ $vardiAhavalData->vardi_approximate ?? ($vardiAhavalData->possible_cause_of_fire ?? '-') }}</td>
            </tr>
            <tr>
                <th>आगीचे कारण</th>
                <td>:- 
                    @if($vardiAhavalData->reason_of_fire == 'Natural')
                        नैसर्गिक (Natural)
                    @elseif($vardiAhavalData->reason_of_fire == 'Human')
                        मानवी (Human)
                    @else
                        {{ $vardiAhavalData->reason_of_fire ?? '-' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>आग लागलेल्या ठिकाणच्या मालमत्तेचे वर्णन</th>
                <td>:- 
                    @php
                        $propDesc = !empty($vardiAhavalData->property_description) && !preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', trim($vardiAhavalData->property_description)) 
                            ? $vardiAhavalData->property_description 
                            : ($vardiAhavalData->vardi_damage ?? '-');
                    @endphp
                    {{ $propDesc }}
                </td>
            </tr>
            <tr>
                <th>अंदाजित नुकसान (वित्तहानी बाबतची माहिती)
                    <ol>
                        <li>प्रत्यक्ष वित्तहानी (मालमत्ता)</li>
                        <li>वाचविलेली वित्तहानी (आजुबाजुचा परिसर)</li>
                        <li>इमारतीतील वास्तूचे नुकसान (जागेचे नुकसान)</li>
                        <li>विमा सर्वेक्षण / वस्तुचे नुकसान</li>
                    </ol>
                </th>
                <td>
                    @php
                        $propDamage = !empty($vardiAhavalData->direct_financial_loss) ? $vardiAhavalData->direct_financial_loss : $vardiAhavalData->property_damage;
                        if (preg_match('/^\d{1,2}:\d{2}(:\d{2})?$/', trim($propDamage ?? ''))) {
                            $propDamage = !empty($vardiAhavalData->direct_financial_loss) ? $vardiAhavalData->direct_financial_loss : '-';
                        }

                        $areaDamage = !empty($vardiAhavalData->financial_loss_saved) ? $vardiAhavalData->financial_loss_saved : $vardiAhavalData->area_damage;
                        if (str_contains($areaDamage ?? '', 'अधिकाऱ्याचे नाव') || str_contains($areaDamage ?? '', 'officer') || str_contains($areaDamage ?? '', 'Finn Horn')) {
                            $areaDamage = !empty($vardiAhavalData->financial_loss_saved) ? $vardiAhavalData->financial_loss_saved : '-';
                        }

                        $spaceLoss = !empty($vardiAhavalData->structural_damage_to_build) ? $vardiAhavalData->structural_damage_to_build : $vardiAhavalData->space_loss;
                        if ($spaceLoss == 'अस्सल' || $spaceLoss == 'बोगस') {
                            $spaceLoss = !empty($vardiAhavalData->structural_damage_to_build) ? $vardiAhavalData->structural_damage_to_build : '-';
                        }

                        $propLoss = !empty($vardiAhavalData->property_loss) ? $vardiAhavalData->property_loss : null;
                        if (str_contains($propLoss ?? '', 'केंद्राचे नाव') || str_contains($propLoss ?? '', 'Fire station') || str_contains($propLoss ?? '', 'कळंबोली') || str_contains($propLoss ?? '', 'Kane Benjamin')) {
                            $propLoss = null;
                        }
                        if (empty($propLoss)) {
                            $propLoss = !empty($vardiAhavalData->vardi_insurance) ? 'विमा: ' . ($vardiAhavalData->vardi_insurance == 'Yes' ? 'होय' : ($vardiAhavalData->vardi_insurance == 'No' ? 'नाही' : $vardiAhavalData->vardi_insurance)) : '-';
                        }
                    @endphp
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li>:- {{ $propDamage ?? '-' }} @if(!empty($propDamage) && $propDamage != '-' && !str_contains($propDamage, 'लाखात') && !str_contains($propDamage, 'Direct')) (लाखात ) विमा कंपनी सर्वेक्षणानुसार @endif</li>
                        <li>:- {{ $areaDamage ?? '-' }}</li>
                        <li>:- {{ $spaceLoss ?? '-' }}</li>
                        <li>:- {{ $propLoss ?? '-' }} @if(!empty($propLoss) && $propLoss != '-' && !str_contains($propLoss, 'विमा') && !str_contains($propLoss, 'लाखात')) (लाखात ) विमा कंपनी सर्वेक्षणानुसार @endif</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <th>अखेरच्या क्षणी घटनास्थळी असलेल्या अधिकाऱ्यांचे नाव</th>
                <td>:- 
                    @php
                        $officerName = $vardiAhavalData->officer_name_present_at_last_moment ?? '';
                        if (empty($officerName) || in_array($officerName, ['vehicle', 'Fire Type of vehicle', 'fire rescue', 'Zane Hayes'])) {
                            $officerName = $vardiAhavalData->vardi_officer_name ?? (!empty($vardiAhavalData->area_damage) && !str_contains($vardiAhavalData->area_damage, 'अधिकाऱ्याचे नाव') ? $vardiAhavalData->area_damage : '-');
                        }
                    @endphp
                    {{ $officerName }}
                </td>
            </tr>
            @if(!empty($vardiAhavalData->vardi_employee_name))
            <tr>
                <th>कर्मचारी - हुद्दा / नाव</th>
                <td>:- {{ $vardiAhavalData->vardi_employee_name }}</td>
            </tr>
            @endif
            @php
                $depDate = null;
                $depTime = null;

                if (!empty($vardiAhavalData->date_of_departure_from_scene) && strtotime($vardiAhavalData->date_of_departure_from_scene)) {
                    $depDate = date('d-m-Y', strtotime($vardiAhavalData->date_of_departure_from_scene));
                } elseif (!empty($vardiAhavalData->time_of_departure_from_scene) && strtotime($vardiAhavalData->time_of_departure_from_scene)) {
                    $depDate = date('d-m-Y', strtotime($vardiAhavalData->time_of_departure_from_scene));
                } elseif (!empty($actionTakenData->vehicle_departure_from_scene_time) && strtotime($actionTakenData->vehicle_departure_from_scene_time)) {
                    $depDate = date('d-m-Y', strtotime($actionTakenData->vehicle_departure_from_scene_time));
                } elseif (!empty($slipData->slip_date) && strtotime($slipData->slip_date)) {
                    $depDate = date('d-m-Y', strtotime($slipData->slip_date));
                }

                if (!empty($vardiAhavalData->vardi_leaving_time)) {
                    $depTime = $vardiAhavalData->vardi_leaving_time;
                } elseif (!empty($vardiAhavalData->time_of_departure_from_scene) && strtotime($vardiAhavalData->time_of_departure_from_scene)) {
                    $depTime = date('H:i:s', strtotime($vardiAhavalData->time_of_departure_from_scene));
                } elseif (!empty($actionTakenData->vehicle_departure_from_scene_time) && strtotime($actionTakenData->vehicle_departure_from_scene_time)) {
                    $depTime = date('H:i:s', strtotime($actionTakenData->vehicle_departure_from_scene_time));
                }
            @endphp
            <tr>
                <th>घटनास्थळावरून निघाल्याची तारीख</th>
                <td>:- {{ $depDate ?? '-' }}</td>
            </tr>
            <tr>
                <th>घटनास्थळावरून निघाल्याची वेळ</th>
                <td>:- {{ $depTime ?? '-' }}</td>
            </tr>
            @if(!empty($vardiAhavalData->vardi_return_time) || !empty($actionTakenData->vehicle_arrival_at_center_time))
            <tr>
                <th>घटनास्थळ वरून फायर स्टेशनला परत आल्याची वेळ</th>
                <td>:- {{ $vardiAhavalData->vardi_return_time ?? (!empty($actionTakenData->vehicle_arrival_at_center_time) ? date('H:i:s', strtotime($actionTakenData->vehicle_arrival_at_center_time)) : '-') }}</td>
            </tr>
            @endif
            <tr>
                <th>एकुण काम केलेली वेळ</th>
                <td>:- {{ $vardiAhavalData->total_time ?? '-' }}</td>
            </tr>
            <tr>
                <th>तास / मिनिटे</th>
                <td>:- {{ $vardiAhavalData->total_hour ?? '-' }}</td>
            </tr>
            @if(!empty($vardiAhavalData->vardi_total_distance) || !empty($actionTakenData->total_distance))
            <tr>
                <th>एकूण अंतर</th>
                <td>:- {{ $vardiAhavalData->vardi_total_distance ?? $actionTakenData->total_distance }} कि.मी</td>
            </tr>
            @endif
            @if(!empty($vardiAhavalData->vardi_pump_run) || !empty($actionTakenData->pumping_hours))
            <tr>
                <th>पंप चालविलेला तास</th>
                <td>:- {{ $vardiAhavalData->vardi_pump_run ?? $actionTakenData->pumping_hours }} तास</td>
            </tr>
            @endif
            <tr>
                <th>पनवेल महानगरपालिकेच्या हद्दीत आहे का ?</th>
                <td>:- 
                    @if($vardiAhavalData->is_in_panvel == "No")
                        नाही 
                    @else
                        होय
                    @endif
                </td>
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

                <table>
                    <caption class="text-center" style="padding:10px"><b>व्यक्तींचे नाव</b></caption>
                    <tr>
                        <th>पुरुषांचे नाव</th>
                        <th>महिलांचे नाव</th>
                    </tr>
                    @php
                        $male_rescue_details_array = $male_rescue_details[1] ?? [];
                        $woman_rescue_details_array = $woman_rescue_details[1] ?? [];
                        $maxRows = max(count($male_rescue_details_array), count($woman_rescue_details_array));
                    @endphp
                    @for ($i = 0; $i < $maxRows; $i++)
                        <tr>
                            <td>
                                @if (isset($male_rescue_details_array[$i]))
                                    {{ $male_rescue_details_array[$i]->male_name }}
                                @endif
                            </td>
                            <td>
                                @if (isset($woman_rescue_details_array[$i]))
                                    {{ $woman_rescue_details_array[$i]->women_name }}
                                @endif
                            </td>
                        </tr>
                    @endfor
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

                <table>
                    <caption class="text-center" style="padding:10px"><b>व्यक्तींचे नाव</b></caption>
                    <tr>
                        <th>पुरुषांचे नाव</th>
                        <th>महिलांचे नाव</th>
                    </tr>
                    @php
                        $male_rescue_details_array = $male_rescue_details[2] ?? [];
                        $woman_rescue_details_array = $woman_rescue_details[2] ?? [];
                        $maxRows = max(count($male_rescue_details_array), count($woman_rescue_details_array));
                    @endphp
                    @for ($i = 0; $i < $maxRows; $i++)
                        <tr>
                            <td>
                                @if (isset($male_rescue_details_array[$i]))
                                    {{ $male_rescue_details_array[$i]->male_name }}
                                @endif
                            </td>
                            <td>
                                @if (isset($woman_rescue_details_array[$i]))
                                    {{ $woman_rescue_details_array[$i]->women_name }}
                                @endif
                            </td>
                        </tr>
                    @endfor
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

                <table>
                    <caption class="text-center" style="padding:10px"><b>व्यक्तींचे नाव</b></caption>
                    <tr>
                        <th>पुरुषांचे नाव</th>
                        <th>महिलांचे नाव</th>
                    </tr>
                    @php
                        $male_rescue_details_array = $male_rescue_details[3] ?? [];
                        $woman_rescue_details_array = $woman_rescue_details[3] ?? [];
                        $maxRows = max(count($male_rescue_details_array), count($woman_rescue_details_array));
                    @endphp
                    @for ($i = 0; $i < $maxRows; $i++)
                        <tr>
                            <td>
                                @if (isset($male_rescue_details_array[$i]))
                                    {{ $male_rescue_details_array[$i]->male_name }}
                                @endif
                            </td>
                            <td>
                                @if (isset($woman_rescue_details_array[$i]))
                                    {{ $woman_rescue_details_array[$i]->women_name }}
                                @endif
                            </td>
                        </tr>
                    @endfor
                </table>

            </div>
            
        </div>

        <hr>
        <h4 class="text-center">४. जखमीबाबतची माहिती </h4>
        <div class="row rescuetable">
            <div class="col-md-4">
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

                <table>
                    <caption class="text-center" style="padding:10px"><b>व्यक्तींचे नाव</b></caption>
                    <tr>
                        <th>पुरुषांचे नाव</th>
                        <th>महिलांचे नाव</th>
                    </tr>
                    @php
                        $male_rescue_details_array = $male_rescue_details[4] ?? [];
                        $woman_rescue_details_array = $woman_rescue_details[4] ?? [];
                        $maxRows = max(count($male_rescue_details_array), count($woman_rescue_details_array));
                    @endphp
                    @for ($i = 0; $i < $maxRows; $i++)
                        <tr>
                            <td>
                                @if (isset($male_rescue_details_array[$i]))
                                    {{ $male_rescue_details_array[$i]->male_name }}
                                @endif
                            </td>
                            <td>
                                @if (isset($woman_rescue_details_array[$i]))
                                    {{ $woman_rescue_details_array[$i]->women_name }}
                                @endif
                            </td>
                        </tr>
                    @endfor
                </table>

            </div>
            <div class="col-md-4">
               <table>
                    <caption class="text-center"><b>Injured (जखमी)</b></caption>
                    <tr>
                        <th>पुरुष संख्या</th>
                        <th>स्त्री संख्या</th>
                    </tr>
                    <tr>
                        <td>{{$vardiAhavalData->wounded_male}}</td>
                        <td>{{$vardiAhavalData->wounded_woman}}</td>
                    </tr>
                </table>

                <table>
                    <caption class="text-center" style="padding:10px"><b>व्यक्तींचे नाव</b></caption>
                    <tr>
                        <th>पुरुषांचे नाव</th>
                        <th>महिलांचे नाव</th>
                    </tr>
                    @php
                        $male_rescue_details_array = $male_rescue_details[6] ?? [];
                        $woman_rescue_details_array = $woman_rescue_details[6] ?? [];
                        $maxRows = max(count($male_rescue_details_array), count($woman_rescue_details_array));
                    @endphp
                    @for ($i = 0; $i < $maxRows; $i++)
                        <tr>
                            <td>
                                @if (isset($male_rescue_details_array[$i]))
                                    {{ $male_rescue_details_array[$i]->male_name }}
                                @endif
                            </td>
                            <td>
                                @if (isset($woman_rescue_details_array[$i]))
                                    {{ $woman_rescue_details_array[$i]->women_name }}
                                @endif
                            </td>
                        </tr>
                    @endfor
                </table>
            </div>
            <div class="col-md-4">
               <table>
                    <caption class="text-center"><b>Critically Injured (गंभीर जखमी)</b></caption>
                    <tr>
                        <th>पुरुष संख्या</th>
                        <th>स्त्री संख्या</th>
                    </tr>
                    <tr>
                        <td>{{$vardiAhavalData->casualty_male}}</td>
                        <td>{{$vardiAhavalData->casualty_woman}}</td>
                    </tr>
                </table>

                <table>
                    <caption class="text-center" style="padding:10px"><b>व्यक्तींचे नाव</b></caption>
                    <tr>
                        <th>पुरुषांचे नाव</th>
                        <th>महिलांचे नाव</th>
                    </tr>
                    @php
                        $male_rescue_details_array = $male_rescue_details[6] ?? [];
                        $woman_rescue_details_array = $woman_rescue_details[6] ?? [];
                        $maxRows = max(count($male_rescue_details_array), count($woman_rescue_details_array));
                    @endphp
                    @for ($i = 0; $i < $maxRows; $i++)
                        <tr>
                            <td>
                                @if (isset($male_rescue_details_array[$i]))
                                    {{ $male_rescue_details_array[$i]->male_name }}
                                @endif
                            </td>
                            <td>
                                @if (isset($woman_rescue_details_array[$i]))
                                    {{ $woman_rescue_details_array[$i]->women_name }}
                                @endif
                            </td>
                        </tr>
                    @endfor
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
                          <td>{{date('Y-m-d', strtotime($actionTakenData->vehicle_arrival_time)) }} / {{date('H-i-s', strtotime($actionTakenData->vehicle_arrival_time))}}</td>
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
                            <td>{{ date('Y-m-d', strtotime($data->vehicle_departure_time)) }} / {{date('H-i-s', strtotime($data->vehicle_departure_time))}}</td>
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
            <li>मुख्य अग्निशमन अधिकारी</li>
            <li>पनवेल महानगरपालिका</li>
        </ul>

    </div>
</body>
</html>
