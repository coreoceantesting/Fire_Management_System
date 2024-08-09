<x-admin.layout>
    <x-slot name="title">Edit Vardi Ahaval</x-slot>
    <x-slot name="heading">Edit Vardi Ahaval (वरदी अहवाल संपादित करा)</x-slot>

    {{-- vardi ahaval Form --}}
    <div class="row" id="editContainer">
        <div class="col">
            <form class="form-horizontal form-bordered" action="{{ route('update_vardi_ahaval', $vardi_details->slip_id) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_model_id_new" name="edit_model_id_new" value="{{ $vardi_details->slip_id }}">
                <section class="card">
                    {{-- Vardi ( वर्दी ) --}}
                    <header class="card-header">
                        <h4 class="card-title text-center"><b>Vardi ( वर्दी )</b></h4>
                    </header>

                    <div class="card-body py-2">

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="vardi_name">Name of Vardi Issuer (वरदी देणेराचे नाव) <span class="text-danger">*</span></label>
                                <input class="form-control" id="vardi_name" name="vardi_name" type="text" placeholder="Enter Name of Vardi Issuer" value="{{ $vardi_details->vardi_name }}">
                                <span class="text-danger error-text vardi_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="vardi_contact_no">Vardi Issuer's No ( वर्दी जारीकर्ता क्र) <span class="text-danger">*</span></label>
                                <input class="form-control" id="vardi_contact_no" name="vardi_contact_no" type="text" placeholder="Enter Vardi Issuer's No" value="{{ $vardi_details->vardi_contact_no }}">
                                <span class="text-danger error-text vardi_contact_no_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="vardi_place">Vardi Location ( वर्दीचे ठिकाण ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="vardi_place" name="vardi_place" type="text" placeholder="Enter Vardi Location" value="{{ $vardi_details->vardi_place }}">
                                <span class="text-danger error-text vardi_place_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="owner_name">Owner's Name ( मालकाचे नाव ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="owner_name" name="owner_name" type="text" placeholder="Enter Owner's Name" value="{{ $vardi_details->owner_name }}">
                                <span class="text-danger error-text owner_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="vaparkarta_name">Name Of Vaparkarta ( वापर करणाऱयांचे नाव  ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="vaparkarta_name" name="vaparkarta_name" type="text" placeholder="Enter Vaparkarta Name" value="{{ $vardi_details->vaparkarta_name }}">
                                <span class="text-danger error-text vaparkarta_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="incident_time">Incident Time ( वर्दीची वेळ ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="incident_time" name="incident_time" type="datetime-local" value="{{ $vardi_details->incident_time }}">
                                <span class="text-danger error-text incident_time_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="first_vehicle_departing_date_time">Timing Of The First Vehicle Departing On Verdi ( वर्दीवर प्रथम रवाना झालेल्या गाडीची वेळ   ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="first_vehicle_departing_date_time" name="first_vehicle_departing_date_time" type="datetime-local" value="{{ $vardi_details->first_vehicle_departing_date_time }}">
                                <span class="text-danger error-text first_vehicle_departing_date_time_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="time_of_arrival_at_the_scene">Time Of Arrival At The Scene ( घटनास्थळी पोह्चल्याची वेळ ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="time_of_arrival_at_the_scene" name="time_of_arrival_at_the_scene" type="datetime-local" value="{{ $vardi_details->time_of_arrival_at_the_scene }}">
                                <span class="text-danger error-text time_of_arrival_at_the_scene_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="time_of_arrival_at_the_scene">Distance Of Incident Site From Fire Station ( अग्निशमन केंद्रापासून घटनास्तळाचे अंतर ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="distance" name="distance" type="number" placeholder="Distance Of Incident Site From Fire Station In KM" value="{{ $vardi_details->distance }}">
                                <span class="text-danger error-text distance_err"></span>
                            </div>
                        </div>

                    </div>

                    <hr>
                    {{--Vardi Details( वर्दीची सविस्तर माहिती  )  --}}
                    <header class="card-header">
                        <h4 class="card-title text-center"><b>Vardi Details( वर्दीची सविस्तर माहिती  )</b></h4>
                    </header>

                    <div class="card-body py-2">

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="property_description">Property Description Of The Fire Location (आग लागलेल्या ठिकाणच्या मालमतेचे वर्णन ) <span class="text-danger">*</span></label>
                                {{-- <input class="form-control" id="property_description" name="property_description" type="text" placeholder="Enter Property Description Of The Fire Location"> --}}
                                <textarea class="form-control" name="property_description" id="property_description" placeholder="Enter Property Description Of The Fire Location" cols="30" rows="3">{{ $vardi_details->property_description }}</textarea>
                                <span class="text-danger error-text property_description_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="type_of_fire">Type of fire ( आगीचा प्रकार ) <span class="text-danger">*</span></label>
                                <select class="form-control" name="type_of_fire" id="type_of_fire">
                                    <option value="">--Select Type Of Fire--</option>
                                    <option value="A-solid" @if( $vardi_details->type_of_fire == 'A-solid' ) selected @endif>A-solid</option>
                                    <option value="B-liquid" @if( $vardi_details->type_of_fire == 'B-liquid' ) selected @endif>B-liquid</option>
                                    <option value="C-gas" @if( $vardi_details->type_of_fire == 'C-gas' ) selected @endif>C-gas</option>
                                    <option value="D-metal" @if( $vardi_details->type_of_fire == 'D-metal' ) selected @endif>D-metal</option>
                                    <option value="E-Electrical" @if( $vardi_details->type_of_fire == 'E-Electrical' ) selected @endif>E-Electrical</option>
                                </select>
                                <span class="text-danger error-text type_of_fire_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="limit_of_fire">Limit of fire ( आगीची मर्यदा )</label>
                                <select class="form-control" name="limit_of_fire" id="limit_of_fire">
                                    <option value="">--Select Type Of Fire--</option>
                                    <option value="Low" @if( $vardi_details->limit_of_fire == 'Low' ) selected @endif>Low(कमी)</option>
                                    <option value="Medium" @if( $vardi_details->limit_of_fire == 'Medium' ) selected @endif>Medium(मध्यम)</option>
                                    <option value="High" @if( $vardi_details->limit_of_fire == 'High' ) selected @endif>High(उच्च)</option>
                                </select>
                                {{-- <input class="form-control" id="limit_of_fire" name="limit_of_fire" type="text" placeholder="Enter Limit Of Fire"> --}}
                                <span class="text-danger error-text limit_of_fire_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="possible_cause_of_fire">Possible Cause Of Fire ( आगीचं शक्य कारण ) <span class="text-danger">*</span></label>
                                {{-- <input class="form-control" id="possible_cause_of_fire" name="possible_cause_of_fire" type="text" placeholder="Enter Possible Cause Of Fire"> --}}
                                <textarea class="form-control" name="possible_cause_of_fire" id="possible_cause_of_fire" placeholder="Enter Possible Cause Of Fire" cols="30" rows="3">{{ $vardi_details->possible_cause_of_fire }}</textarea>
                                <span class="text-danger error-text possible_cause_of_fire_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="description_of_damage">Description Of Damage ( नुकसानीचे वर्णन )</label>
                                {{-- <input class="form-control" id="description_of_damage" name="description_of_damage" type="text" placeholder="Enter Description Of Damage"> --}}
                                <textarea class="form-control" name="description_of_damage" id="description_of_damage" placeholder="Enter Description Of Damage" cols="30" rows="3">{{ $vardi_details->description_of_damage }}</textarea>
                                <span class="text-danger error-text description_of_damage_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="property_damage">Estimated Property Damage ( अंदाजित मालमत्तेचे नुकसान )</label>
                                <input class="form-control" id="property_damage" name="property_damage" type="text" placeholder="Enter Estimated property damage" value="{{ $vardi_details->property_damage }}">
                                <small>(in lakhs) as per insurance company survey ((लाखात) विमा कंपनी सर्वेक्षण नुसार)</small>
                                <span class="text-danger error-text property_damage_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="area_damage">Estimated Surrounding Area Damage ( अंदाजित आजुबाजुचा परिसर नुकसान ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="area_damage" name="area_damage" type="text" placeholder="Enter Estimated property damage" value="{{ $vardi_details->area_damage }}">
                                <span class="text-danger error-text area_damage_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="space_loss">Estimated Space Loss ( अंदाजित आजुबाजुचा परिसर नुकसान )</label>
                                <input class="form-control" id="space_loss" name="space_loss" type="text" placeholder="Enter Estimated Space Loss" value="{{ $vardi_details->space_loss }}">
                                <span class="text-danger error-text space_loss_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="property_loss">Estimated loss of property ( अंदाजित आजुबाजुचा परिसर नुकसान )</label>
                                <input class="form-control" id="property_loss" name="property_loss" type="text" placeholder="Enter Estimated loss of property" value="{{ $vardi_details->property_loss }}">
                                <small>(in lakhs) as per insurance company survey ((लाखात) विमा कंपनी सर्वेक्षण नुसार)</small>
                                <span class="text-danger error-text property_loss_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="officer_name_present_at_last_moment">Name of the officer present at the scene at the last moment ( अखेरच्या क्षणी घटनास्थळी उपस्थित असलेल्या अधिकाऱ्यांचे नाव ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="officer_name_present_at_last_moment" name="officer_name_present_at_last_moment" type="text" placeholder="Enter Name of the officer present at the scene at the last moment" value="{{ $vardi_details->officer_name_present_at_last_moment }}">
                                <span class="text-danger error-text officer_name_present_at_last_moment_err"></span>
                            </div>
                            @php
                                $vardi_details->date_of_departure_from_scene = date('Y-m-d', strtotime($vardi_details->date_of_departure_from_scene));
                            @endphp
                            <div class="col-md-4">
                                <label class="col-form-label" for="date_of_departure_from_scene">Date of departure from the scene ( घटनास्तळावरून निघाल्याची तारीख ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="date_of_departure_from_scene" name="date_of_departure_from_scene" type="date" placeholder="Enter Date of departure from the scene" value="{{ $vardi_details->date_of_departure_from_scene }}">
                                <span class="text-danger error-text date_of_departure_from_scene_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="time_of_departure_from_scene">Time to leave the scene ( घटनास्तळावरून निघाल्याची वेळ ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="time_of_departure_from_scene" name="time_of_departure_from_scene" type="time" placeholder="Time to leave the scene" value="{{ $vardi_details->time_of_departure_from_scene }}">
                                <span class="text-danger error-text time_of_departure_from_scene_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="total_time">Total Time ( एकुण वेळ ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="total_time" name="total_time" type="text" placeholder="Enter Total Time" value="{{ $vardi_details->total_time }}">
                                <span class="text-danger error-text total_time_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="total_hour">Total Hours ( एकुण तास ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="total_hour" name="total_hour" type="text" placeholder="Enter Total Hour" value="{{ $vardi_details->total_hour }}">
                                <span class="text-danger error-text total_hour_err"></span>
                            </div>
                            <div class="col-md-4"></div>

                            <div class="col-md-6">
                                <label class="col-form-label" for="is_in_panvel">Is Panvel within the municipal corporation limits? ( पनवेल महानगरपालिकेच्या हद्दीत आहे का ? ) <span class="text-danger">*</span></label>
                                <select class="form-control" name="is_in_panvel" id="is_in_panvel">
                                    <option value="">Select Option</option>
                                    <option value="yes" @if( $vardi_details->is_in_panvel == 'yes' ) selected @endif>Yes / होय</option>
                                    <option value="No" @if( $vardi_details->is_in_panvel == 'No' ) selected @endif>No / नाही</option>
                                </select>
                                <span class="text-danger error-text is_in_panvel_err"></span>
                            </div>

                            <div class="col-md-6" id="addressDiv" @if( $vardi_details->is_in_panvel == 'No' ) style="display: block" @else style="display: none" @endif>
                                <label class="col-form-label" for="address">Address ( पत्ता ) <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="address" id="address" cols="30" rows="2">{{ $vardi_details->address }}</textarea>
                                <span class="text-danger error-text address_err"></span>
                            </div>
                        </div>

                    </div>

                    <hr>
                    {{--Rescuers And Rescuers From Fire( आगीमधुन विमोचन व वाचवलेल्या व्यक्ती )  --}}
                    <header class="card-header">
                        <h4 class="card-title text-center"><b>Rescuers And Rescuers From Fire( आगीमधुन विमोचन व वाचवलेल्या व्यक्ती )</b></h4>
                    </header>

                    <div class="card-body py-2">

                        <div class="mb-3 row">
                            <h4 class="card-title text-center">Rescue Work Done By Other Than Fire Department (अग्निशमन विभागा व्यतिरिक्त केलेले विमोचन कार्य)</h4>
                            <hr>
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_one">Male Number(पुरुष संख्या) <span class="text-danger">*</span></label>
                                <input class="form-control" id="male_one" name="male_one" type="text" placeholder="Enter Male Numbers" value="{{ $vardi_details->male_one }}">
                                <span class="text-danger error-text male_one_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="woman_one">Woman Number(स्त्री संख्या) <span class="text-danger">*</span></label>
                                <input class="form-control" id="woman_one" name="woman_one" type="text" placeholder="Enter Woman Numbers" value="{{ $vardi_details->woman_one }}">
                                <span class="text-danger error-text woman_one_err"></span>
                            </div>
                        </div>

                        @if (isset($male_rescue_details[1]))
                            <h5>Male Names (पुरुषांचे नाव)</h5>
                            @foreach($male_rescue_details[1] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="male_name[]" type="text" value="{{ $detail->male_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach                            
                        @endif

                        @if (isset($woman_rescue_details[1]))
                            <h5>Women Names (महिलांचे नाव)</h5>
                            @foreach($woman_rescue_details[1] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="women_name[]" type="text" value="{{ $detail->women_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach                            
                        @endif

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_name">Male Name (पुरुषांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="male_name" name="male_name[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text male_name_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="women_name">Women Name (महिलांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="women_name" name="women_name[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text women_name_err"></span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success mt-5" id="add-field">Add</button>
                            </div>
                        </div>
                        <div id="additional-fields"></div>

                        <div class="mb-3 row">
                            <h4 class="card-title text-center">A Rescue Operation Performed By The Fire Department Without The Use Of A Rescue Vehicle (अग्निशमन विभागाने बचाव वाहनाचा वापर न करता केलेले विमोचन कार्य )</h4>
                            <hr>
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_two">Male Number (पुरुष संख्या) <span class="text-danger">*</span></label>
                                <input class="form-control" id="male_two" name="male_two" type="text" placeholder="Enter Male Numbers" value="{{ $vardi_details->male_two }}">
                                <span class="text-danger error-text male_two_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="woman_two">Woman Number (स्त्री संख्या) <span class="text-danger">*</span></label>
                                <input class="form-control" id="woman_two" name="woman_two" type="text" placeholder="Enter Woman Numbers" value="{{ $vardi_details->woman_two }}">
                                <span class="text-danger error-text woman_two_err"></span>
                            </div>
                        </div>

                        @if (isset($male_rescue_details[2]))
                            <h5>Male Names (पुरुषांचे नाव)</h5>
                            @foreach($male_rescue_details[2] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="male_name_two[]" type="text" value="{{ $detail->male_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach                            
                        @endif
                        
                        @if (isset($woman_rescue_details[2]))
                            <h5>Women Names (महिलांचे नाव)</h5>
                            @foreach($woman_rescue_details[2] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="women_name_two[]" type="text" value="{{ $detail->women_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach                            
                        @endif

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_name_two">Male Name (पुरुषांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="male_name_two" name="male_name_two[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text male_name_two_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="women_name_two">Women Name (महिलांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="women_name_two" name="women_name_two[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text women_name_two_err"></span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success mt-5" id="add-field-two">Add</button>
                            </div>
                        </div>
                        <div id="additional-fields-two"></div>

                        <div class="mb-3 row">
                            <h4 class="card-title text-center">A Rescue Vehicle Was Used By The Fire Department For Rescue Operations (अग्निशमन विभागाने बचाव वाहनाचा वापर केलेले विमोचन कार्य)</h4>
                            <hr>
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_three">Male Number (पुरुष संख्या) <span class="text-danger">*</span></label>
                                <input class="form-control" id="male_three" name="male_three" type="text" placeholder="Enter Male Numbers" value="{{ $vardi_details->male_three }}">
                                <span class="text-danger error-text male_three_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="woman_three">Woman Number (स्त्री संख्या) <span class="text-danger">*</span></label>
                                <input class="form-control" id="woman_three" name="woman_three" type="text" placeholder="Enter Woman Numbers" value="{{ $vardi_details->woman_three }}">
                                <span class="text-danger error-text woman_three_err"></span>
                            </div>
                        </div>

                        @if (isset($male_rescue_details[3]))
                            <h5>Male Names (पुरुषांचे नाव)</h5>
                            @foreach($male_rescue_details[3] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="male_name_three[]" type="text" value="{{ $detail->male_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                        @if (isset($woman_rescue_details[3]))
                            <h5>Women Names (महिलांचे नाव)</h5>
                            @foreach($woman_rescue_details[3] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="women_name_three[]" type="text" value="{{ $detail->women_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_name_three">Male Name (पुरुषांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="male_name_three" name="male_name_three[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text male_name_three_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="women_name_three">Women Name (महिलांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="women_name_three" name="women_name_three[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text women_name_three_err"></span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success mt-5" id="add-field-three">Add</button>
                            </div>
                        </div>
                        <div id="additional-fields-three"></div>

                    </div>

                    <hr>
                    {{--Rescuers And Rescuers From Fire( आगीमधुन विमोचन व वाचवलेल्या व्यक्ती )  --}}
                    <header class="card-header">
                        <h4 class="card-title text-center"><b>Information About The Injured( जखमीबाबतची माहिती )</b></h4>
                    </header>

                    <div class="card-body py-2">

                        <div class="mb-3 row">
                            <h4 class="card-title text-center">Deceased (मयत)</h4>
                            <hr>
                            <div class="col-md-4">
                                <label class="col-form-label" for="deceased_male">Male Number (पुरुष संख्या ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="deceased_male" name="deceased_male" type="text" placeholder="Enter Deceased Male Numbers" value="{{ $vardi_details->deceased_male }}">
                                <span class="text-danger error-text deceased_male_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="deceased_woman">Woman Number (स्त्री संख्या ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="deceased_woman" name="deceased_woman" type="text" placeholder="Enter Woman Numbers" value="{{ $vardi_details->deceased_woman }}">
                                <span class="text-danger error-text deceased_woman_err"></span>
                            </div>
                        </div>

                        @if (isset($male_rescue_details[4]))
                            <h5>Male Names (पुरुषांचे नाव)</h5>
                            @foreach($male_rescue_details[4] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="male_name_four[]" type="text" value="{{ $detail->male_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @if (isset($woman_rescue_details[4]))
                            <h5>Women Names (महिलांचे नाव)</h5>
                            @foreach($woman_rescue_details[4] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="women_name_four[]" type="text" value="{{ $detail->women_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_name_four">Male Name (पुरुषांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="male_name_four" name="male_name_four[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text male_name_four_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="women_name_four">Women Name (महिलांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="women_name_four" name="women_name_four[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text women_name_four_err"></span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success mt-5" id="add-field-four">Add</button>
                            </div>
                        </div>
                        <div id="additional-fields-four"></div>

                        <div class="mb-3 row">
                            <h4 class="card-title text-center">Wounded (जखमी)</h4>
                            <hr>
                            <div class="col-md-4">
                                <label class="col-form-label" for="wounded_male">Male Number (पुरुष संख्या ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="wounded_male" name="wounded_male" type="text" placeholder="Enter Male Numbers" value="{{ $vardi_details->wounded_male }}">
                                <span class="text-danger error-text wounded_male_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="wounded_woman">Woman Number (स्त्री संख्या ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="wounded_woman" name="wounded_woman" type="text" placeholder="Enter Woman Numbers" value="{{ $vardi_details->wounded_woman }}">
                                <span class="text-danger error-text wounded_woman_err"></span>
                            </div>
                        </div>

                        @if (isset($male_rescue_details[5]))
                            <h5>Male Names (पुरुषांचे नाव)</h5>
                            @foreach($male_rescue_details[5] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="male_name_five[]" type="text" value="{{ $detail->male_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach                            
                        @endif
                        
                        @if (isset($woman_rescue_details[5]))
                            <h5>Women Names (महिलांचे नाव)</h5>
                            @foreach($woman_rescue_details[5] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="women_name_five[]" type="text" value="{{ $detail->women_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_name_five">Male Name (पुरुषांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="male_name_five" name="male_name_five[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text male_name_five_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="women_name_five">Women Name (महिलांचे नाव) <span class="text-danger">*</span></label>
                                <input class="form-control" id="women_name_five" name="women_name_five[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text women_name_five_err"></span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success mt-5" id="add-field-five">Add</button>
                            </div>
                        </div>
                        <div id="additional-fields-five"></div>

                        <div class="mb-3 row">
                            <h4 class="card-title text-center">Casualty (मृत्यू)</h4>
                            <hr>
                            <div class="col-md-4">
                                <label class="col-form-label" for="casualty_male">Male Number (पुरुष संख्या ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="casualty_male" name="casualty_male" type="text" placeholder="Enter Male Numbers" value="{{ $vardi_details->casualty_male }}">
                                <span class="text-danger error-text casualty_male_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="casualty_woman">Woman Number (स्त्री संख्या ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="casualty_woman" name="casualty_woman" type="text" placeholder="Enter Woman Numbers" value="{{ $vardi_details->casualty_woman }}">
                                <span class="text-danger error-text casualty_woman_err"></span>
                            </div>
                        </div>

                        @if (isset($male_rescue_details[6]))
                            <h5>Male Names (पुरुषांचे नाव)</h5>
                            @foreach($male_rescue_details[6] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="male_name_six[]" type="text" value="{{ $detail->male_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                        @if (isset($woman_rescue_details[6]))
                            <h5>Women Names (महिलांचे नाव)</h5>
                            @foreach($woman_rescue_details[6] as $type => $detail)
                                <div class="mb-3 row field-row">
                                    <div class="col-md-4">
                                        <input class="form-control" name="women_name_six[]" type="text" value="{{ $detail->women_name }}">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-field">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="male_name_six">Male Name (पुरुषांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="male_name_six" name="male_name_six[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text male_name_six_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="women_name_six">Women Name (महिलांचे नाव)<span class="text-danger">*</span></label>
                                <input class="form-control" id="women_name_six" name="women_name_six[]" placeholder="Enter Name" type="text" multiple>
                                <span class="text-danger error-text women_name_six_err"></span>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-success mt-5" id="add-field-six">Add</button>
                            </div>
                        </div>
                        <div id="additional-fields-six"></div>

                    </div>

                    <hr>
                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label class="col-form-label" for="book_no">Book No( घटना पुस्तक क्रं ) <span class="text-danger">*</span></label>
                            <input class="form-control" id="book_no" name="book_no" type="text" placeholder="Enter Book No" value="{{ $vardi_details->book_no }}">
                            <span class="text-danger error-text book_no_err"></span>
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label" for="page_no">Page No( पृष्ठ क्रं ) <span class="text-danger">*</span></label>
                            <input class="form-control" id="page_no" name="page_no" type="text" placeholder="Enter Page No" value="{{ $vardi_details->page_no }}">
                            <span class="text-danger error-text page_no_err"></span>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary" id="editSubmit">Submit</button>
                        <a href="{{ route('vardi_ahaval_list') }}" class="btn btn-warning">Back</a>
                    </div>
                </section>
            </form>
        </div>
    </div>

</x-admin.layout>

{{-- time calculation --}}
<script>
    // Get the input elements
    var firstVehicleDeparting = document.getElementById('first_vehicle_departing_date_time');
    var timeOfDeparture = document.getElementById('time_of_departure_from_scene');
    var totalTimeInput = document.getElementById('total_time');
    var totalHourInput = document.getElementById('total_hour');

    // Attach an event listener to detect changes in the input fields
    firstVehicleDeparting.addEventListener('change', updateTotalTime);
    timeOfDeparture.addEventListener('change', updateTotalTime);

    function updateTotalTime() {
        // Get the values from the input fields
        var startTime = new Date(firstVehicleDeparting.value);
        var endTime = new Date(`${firstVehicleDeparting.value.split('T')[0]}T${timeOfDeparture.value}`);

        // Check if end date is earlier than start date (yesterday's start date and today's end date)
        if (endTime < startTime) {
            // Adjust the end date to tomorrow
            endTime.setDate(endTime.getDate() + 1);
        }

        var dateObject = new Date(startTime);
        var dateObjectTwo = new Date(endTime);

        // Get the time in HH:mm:ss format
        var timeone = dateObject.toLocaleTimeString('en-US', { hour12: false });
        var timetwo = dateObjectTwo.toLocaleTimeString('en-US', { hour12: false });

        // Calculate the time difference
        var timeDiff = endTime - startTime;
        var hours = Math.floor(timeDiff / 3600000); // 1 hour = 3600000 milliseconds

        // Display the values in the total time and total hour input fields
        totalTimeInput.value = timeone + ' To ' + timetwo;
        totalHourInput.value = formatTimeDifference(timeDiff);
    }

    function formatTimeDifference(timeDiff) {
        // Format the time difference in HH:mm format
        var hours = Math.floor(timeDiff / 3600000);
        var minutes = Math.floor((timeDiff % 3600000) / 60000);
        return hours + ':' + (minutes < 10 ? '0' : '') + minutes;
    }
</script>

<script>
    document.getElementById('is_in_panvel').addEventListener('change', function() {
        var addressDiv = document.getElementById('addressDiv');
        if (this.value === 'No') {
            addressDiv.style.display = 'block';
        } else {
            addressDiv.style.display = 'none';
        }
    });
</script>

{{-- editForm --}}
<script>
    $(document).ready(function() {
        // Form submission handling
        $('#editForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        swal("Successful!", data.success, "success").then((action) => {
                            window.location.href = '{{ route('vardi_ahaval_list') }}';
                        });
                    } else {
                        swal("Error!", data.error, "error");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

    });
</script>

{{-- add more functionlity for rescures name --}}
<script>
    document.getElementById('add-field').addEventListener('click', function() {
        var additionalDiv = document.getElementById('additional-fields');
        var newInputField = document.createElement('div');
        newInputField.className = 'mb-3 row';
        newInputField.innerHTML = `
            <div class="col-md-4">
                <input class="form-control" name="male_name[]" type="text" placeholder="Enter Name" required>
                <span class="text-danger error-text male_name_err"></span>
            </div>
            <div class="col-md-4">
                <input class="form-control" name="women_name[]" type="text" placeholder="Enter Name" required>
                <span class="text-danger error-text women_name_err"></span>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-photo">Remove</button>
            </div>
        `;
        additionalDiv.appendChild(newInputField);

        // Add event listener to the remove button
        newInputField.querySelector('.remove-photo').addEventListener('click', function() {
            additionalDiv.removeChild(newInputField);
        });
    });

    // two
    document.getElementById('add-field-two').addEventListener('click', function() {
        var additionalDiv = document.getElementById('additional-fields-two');
        var newInputField = document.createElement('div');
        newInputField.className = 'mb-3 row';
        newInputField.innerHTML = `
            <div class="col-md-4">
                <input class="form-control" name="male_name_two[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text male_name_two_err"></span>
            </div>
            <div class="col-md-4">
                <input class="form-control" name="women_name_two[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text women_name_two_err"></span>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-photo">Remove</button>
            </div>
        `;
        additionalDiv.appendChild(newInputField);

        // Add event listener to the remove button
        newInputField.querySelector('.remove-photo').addEventListener('click', function() {
            additionalDiv.removeChild(newInputField);
        });
    });

    // three
    document.getElementById('add-field-three').addEventListener('click', function() {
        var additionalDiv = document.getElementById('additional-fields-three');
        var newInputField = document.createElement('div');
        newInputField.className = 'mb-3 row';
        newInputField.innerHTML = `
            <div class="col-md-4">
                <input class="form-control" name="male_name_three[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text male_name_three_err"></span>
            </div>
            <div class="col-md-4">
                <input class="form-control" name="women_name_three[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text women_name_three_err"></span>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-photo">Remove</button>
            </div>
        `;
        additionalDiv.appendChild(newInputField);

        // Add event listener to the remove button
        newInputField.querySelector('.remove-photo').addEventListener('click', function() {
            additionalDiv.removeChild(newInputField);
        });
    });

    // four
    document.getElementById('add-field-four').addEventListener('click', function() {
        var additionalDiv = document.getElementById('additional-fields-four');
        var newInputField = document.createElement('div');
        newInputField.className = 'mb-3 row';
        newInputField.innerHTML = `
            <div class="col-md-4">
                <input class="form-control" name="male_name_four[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text male_name_four_err"></span>
            </div>
            <div class="col-md-4">
                <input class="form-control" name="women_name_four[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text women_name_four_err"></span>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-photo">Remove</button>
            </div>
        `;
        additionalDiv.appendChild(newInputField);

        // Add event listener to the remove button
        newInputField.querySelector('.remove-photo').addEventListener('click', function() {
            additionalDiv.removeChild(newInputField);
        });
    });

    // five
    document.getElementById('add-field-five').addEventListener('click', function() {
        var additionalDiv = document.getElementById('additional-fields-five');
        var newInputField = document.createElement('div');
        newInputField.className = 'mb-3 row';
        newInputField.innerHTML = `
            <div class="col-md-4">
                <input class="form-control" name="male_name_five[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text male_name_five_err"></span>
            </div>
            <div class="col-md-4">
                <input class="form-control" name="women_name_five[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text women_name_five_err"></span>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-photo">Remove</button>
            </div>
        `;
        additionalDiv.appendChild(newInputField);

        // Add event listener to the remove button
        newInputField.querySelector('.remove-photo').addEventListener('click', function() {
            additionalDiv.removeChild(newInputField);
        });
    });

    // six
    document.getElementById('add-field-six').addEventListener('click', function() {
        var additionalDiv = document.getElementById('additional-fields-six');
        var newInputField = document.createElement('div');
        newInputField.className = 'mb-3 row';
        newInputField.innerHTML = `
            <div class="col-md-4">
                <input class="form-control" name="male_name_six[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text male_name_six_err"></span>
            </div>
            <div class="col-md-4">
                <input class="form-control" name="women_name_six[]" placeholder="Enter Name" type="text" required>
                <span class="text-danger error-text women_name_six_err"></span>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-photo">Remove</button>
            </div>
        `;
        additionalDiv.appendChild(newInputField);

        // Add event listener to the remove button
        newInputField.querySelector('.remove-photo').addEventListener('click', function() {
            additionalDiv.removeChild(newInputField);
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Remove fields
        $(document).on('click', '.remove-field', function() {
            $(this).closest('.field-row').remove();
        });
    });
</script>