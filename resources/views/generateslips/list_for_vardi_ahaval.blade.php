<x-admin.layout>
    <x-slot name="title">Vardi Ahaval List</x-slot>
    <x-slot name="heading">Vardi Ahaval List (वर्दी अहवाल यादी)</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        {{-- Additional Help Form --}}
        <div class="row" id="additionalhelp" style="display: none">
            <div class="col">
                <form class="form-horizontal form-bordered" action="{{ route('store_additional') }}" id="additional-help-store" method="POST">
                    @csrf
                    <input type="hidden" name="slip_id" id="slip_id" value="">
                    <section class="card">
                        <header class="card-header">
                            <h4 class="card-title">Additional Help</h4>
                        </header>
                        <div class="card-body py-2">
                            <!--Additinal Help Section -->
                            <div class="form-group row" id="additional-help-container">
                                <div class="additional-help">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="fire_station[]" class="control-label">Fire Station Name (फायर स्टेशनचे नाव):</label>
                                            <select class="form-control" name="fire_station[]" required>
                                                <option value="">--Select Fire Station--</option>
                                                @foreach ($fire_station_list as $list)
                                                    <option value="{{ $list->fire_station_id }}">{{ $list->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="no_of_fireman[]" class="control-label">No Of FireMan (फायरमनची संख्या):</label>
                                            <input class="form-control" type="number" name="no_of_fireman[]" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="vehicle_no[]" class="control-label">Vehicle Number (वाहन क्रमांक):</label>
                                            <select class="form-control" name="vehicle_no[]" required>
                                                <option value="">--Select Vehicle Number--</option>
                                                @foreach ($vehicle_list as $list)
                                                    <option value="{{ $list->vehicle_id }}">{{ $list->vehicle_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="inform_call_datetime[]" class="control-label">Inform Call Date & Time (कॉलची तारीख आणि वेळ):</label>
                                            <input class="form-control" type="datetime-local" name="inform_call_time[]" required>
                                        </div>
    
                                        <div class="col-md-4">
                                            <label for="departure_vehicle_datetime[]" class="control-label">Departure Vehicle Date & Time (वाहन सुटण्याची तारीख आणि वेळ):</label>
                                            <input class="form-control" type="datetime-local" name="departure_vehicle_datetime[]" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="vehicle_arrival_datetime[]" class="control-label">Vehicle Arrival Date & Time (वाहन येण्याची तारीख आणि वेळ):</label>
                                            <input class="form-control" type="datetime-local" name="vehicle_arrival_datetime[]" required>
                                        </div>
    
                                        <div class="col-md-4">                                            
                                            <label for="vehicle_return_to_firestation_datetime[]" class="control-label">Vehicle Return To Fire Station Date & Time (वाहन अग्निशमन केंद्रावर परतण्याची तारीख आणि वेळ):</label>
                                            <input class="form-control" type="datetime-local" name="vehicle_return_to_firestation_datetime[]" required>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-warning" id="addMore">Add More</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-warning" id="remove">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a class="btn btn-success" href="{{ route('action_taken_slips_list') }}">Cancel</a>
                        </div>
                    </section>
                </form>
            </div>
        </div>
        
        
        {{-- Occurance Book  --}}
        <div class="row" id="occurance-book" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" action="{{route('store_occurance_book')}}" method="POST" name="occurance_book_store" id="store-occurance-book" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="slip_id_new" id="slip_id_new" value="">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="datetime_new">Date & Time (तारीख वेळ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="datetime_new" name="datetime_new" type="datetime-local" required>
                                    <span class="text-danger error-text datetime_new_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="description">Description<span class="text-danger">*</span></label>
                                    <input class="form-control" id="description" name="description" type="text" placeholder="Enter Description" required>
                                    <span class="text-danger error-text description_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="remark">Remark<span class="text-danger">*</span></label>
                                    <input class="form-control" id="remark" name="remark" type="text" placeholder="Enter Remark" required>
                                    <span class="text-danger error-text remark_err"></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="occurancebookSubmit">Submit</button>
                            {{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- vardi ahaval Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col">
                <form class="form-horizontal form-bordered" action="{{ route('store_vardi_ahaval') }}" method="POST" id="editForm">
                    @csrf
                    <input type="hidden" id="edit_model_id_new" name="edit_model_id_new" value="">
                    <section class="card">
                        {{-- Vardi ( वर्दी ) --}}
                        <header class="card-header">
                            <h4 class="card-title text-center"><b>Vardi ( वर्दी )</b></h4>
                        </header>

                        <div class="card-body py-2">

                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vardi_name">Name of Vardi Issuer (वरदी देणेराचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vardi_name" name="vardi_name" type="text" placeholder="Enter Name of Vardi Issuer" readonly>
                                    <span class="text-danger error-text vardi_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vardi_contact_no">Vardi Issuer's No ( वर्दी जारीकर्ता क्र) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vardi_contact_no" name="vardi_contact_no" type="text" placeholder="Enter Vardi Issuer's No" readonly>
                                    <span class="text-danger error-text vardi_contact_no_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vardi_place">Vardi Location ( वर्दीचे ठिकाण ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vardi_place" name="vardi_place" type="text" placeholder="Enter Vardi Location">
                                    <span class="text-danger error-text vardi_place_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="owner_name">Owner's Name ( मालकाचे नाव ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="owner_name" name="owner_name" type="text" placeholder="Enter Owner's Name">
                                    <span class="text-danger error-text owner_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vaparkarta_name">Name Of Vaparkarta ( वापर करणाऱयांचे नाव  ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vaparkarta_name" name="vaparkarta_name" type="text" placeholder="Enter Vaparkarta Name">
                                    <span class="text-danger error-text vaparkarta_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="incident_time">Incident Time ( वर्दीची वेळ ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="incident_time" name="incident_time" type="datetime-local">
                                    <span class="text-danger error-text incident_time_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="first_vehicle_departing_date_time">Timing Of The First Vehicle Departing On Verdi ( वर्दीवर प्रथम रवाना झालेल्या गाडीची वेळ   ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="first_vehicle_departing_date_time" name="first_vehicle_departing_date_time" type="datetime-local">
                                    <span class="text-danger error-text first_vehicle_departing_date_time_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="time_of_arrival_at_the_scene">Time Of Arrival At The Scene ( घटनास्थळी पोह्चल्याची वेळ ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="time_of_arrival_at_the_scene" name="time_of_arrival_at_the_scene" type="datetime-local">
                                    <span class="text-danger error-text time_of_arrival_at_the_scene_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="time_of_arrival_at_the_scene">Distance Of Incident Site From Fire Station ( अग्निशमन केंद्रापासून घटनास्तळाचे अंतर ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="distance" name="distance" type="number" placeholder="Distance Of Incident Site From Fire Station In KM">
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
                                    <textarea class="form-control" name="property_description" id="property_description" placeholder="Enter Property Description Of The Fire Location" cols="30" rows="3"></textarea>
                                    <span class="text-danger error-text property_description_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="type_of_fire">Type of fire ( आगीचा प्रकार ) <span class="text-danger">*</span></label>
                                    <select class="form-control" name="type_of_fire" id="type_of_fire">
                                        <option value="">--Select Type Of Fire--</option>
                                        <option value="A-solid">A-solid</option>
                                        <option value="B-liquid">B-liquid</option>
                                        <option value="C-gas">C-gas</option>
                                        <option value="D-metal">D-metal</option>
                                        <option value="E-Electrical">E-Electrical</option>
                                    </select>
                                    <span class="text-danger error-text type_of_fire_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="limit_of_fire">Limit of fire ( आगीची मर्यदा ) <span class="text-danger">*</span></label>
                                    <select class="form-control" name="limit_of_fire" id="limit_of_fire">
                                        <option value="">--Select Type Of Fire--</option>
                                        <option value="Low">Low(कमी)</option>
                                        <option value="Medium">Medium(मध्यम)</option>
                                        <option value="High">High(उच्च)</option>
                                    </select>
                                    {{-- <input class="form-control" id="limit_of_fire" name="limit_of_fire" type="text" placeholder="Enter Limit Of Fire"> --}}
                                    <span class="text-danger error-text limit_of_fire_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="possible_cause_of_fire">Possible Cause Of Fire ( आगीचं शक्य कारण ) <span class="text-danger">*</span></label>
                                    {{-- <input class="form-control" id="possible_cause_of_fire" name="possible_cause_of_fire" type="text" placeholder="Enter Possible Cause Of Fire"> --}}
                                    <textarea class="form-control" name="possible_cause_of_fire" id="possible_cause_of_fire" placeholder="Enter Possible Cause Of Fire" cols="30" rows="3"></textarea>
                                    <span class="text-danger error-text possible_cause_of_fire_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="description_of_damage">Description Of Damage ( नुकसानीचे वर्णन ) <span class="text-danger">*</span></label>
                                    {{-- <input class="form-control" id="description_of_damage" name="description_of_damage" type="text" placeholder="Enter Description Of Damage"> --}}
                                    <textarea class="form-control" name="description_of_damage" id="description_of_damage" placeholder="Enter Description Of Damage" cols="30" rows="3"></textarea>
                                    <span class="text-danger error-text description_of_damage_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="property_damage">Estimated Property Damage ( अंदाजित मालमत्तेचे नुकसान ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="property_damage" name="property_damage" type="text" placeholder="Enter Estimated property damage">
                                    <small>(in lakhs) as per insurance company survey ((लाखात) विमा कंपनी सर्वेक्षण नुसार)</small>
                                    <span class="text-danger error-text property_damage_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="area_damage">Estimated Surrounding Area Damage ( अंदाजित आजुबाजुचा परिसर नुकसान ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="area_damage" name="area_damage" type="text" placeholder="Enter Estimated property damage">
                                    <span class="text-danger error-text area_damage_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="space_loss">Estimated Space Loss ( अंदाजित आजुबाजुचा परिसर नुकसान ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="space_loss" name="space_loss" type="text" placeholder="Enter Estimated Space Loss">
                                    <span class="text-danger error-text space_loss_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="property_loss">Estimated loss of property ( अंदाजित आजुबाजुचा परिसर नुकसान ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="property_loss" name="property_loss" type="text" placeholder="Enter Estimated loss of property">
                                    <small>(in lakhs) as per insurance company survey ((लाखात) विमा कंपनी सर्वेक्षण नुसार)</small>
                                    <span class="text-danger error-text property_loss_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="officer_name_present_at_last_moment">Name of the officer present at the scene at the last moment ( अखेरच्या क्षणी घटनास्थळी उपस्थित असलेल्या अधिकाऱ्यांचे नाव ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="officer_name_present_at_last_moment" name="officer_name_present_at_last_moment" type="text" placeholder="Enter Name of the officer present at the scene at the last moment">
                                    <span class="text-danger error-text officer_name_present_at_last_moment_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="date_of_departure_from_scene">Date of departure from the scene ( घटनास्तळावरून निघाल्याची तारीख ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="date_of_departure_from_scene" name="date_of_departure_from_scene" type="date" placeholder="Enter Date of departure from the scene">
                                    <span class="text-danger error-text date_of_departure_from_scene_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="time_of_departure_from_scene">Time to leave the scene ( घटनास्तळावरून निघाल्याची वेळ ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="time_of_departure_from_scene" name="time_of_departure_from_scene" type="time" placeholder="Time to leave the scene">
                                    <span class="text-danger error-text time_of_departure_from_scene_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="total_time">Total Time ( एकुण वेळ ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="total_time" name="total_time" type="text" placeholder="Enter Total Time">
                                    <span class="text-danger error-text total_time_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="total_hour">Total Hours ( एकुण तास ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="total_hour" name="total_hour" type="text" placeholder="Enter Total Hour">
                                    <span class="text-danger error-text total_hour_err"></span>
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
                                    <input class="form-control" id="male_one" name="male_one" type="text" placeholder="Enter Male Numbers">
                                    <span class="text-danger error-text male_one_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="woman_one">Woman Number(स्त्री संख्या) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="woman_one" name="woman_one" type="text" placeholder="Enter Woman Numbers">
                                    <span class="text-danger error-text woman_one_err"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <h4 class="card-title text-center">A Rescue Operation Performed By The Fire Department Without The Use Of A Rescue Vehicle (अग्निशमन विभागाने बचाव वाहनाचा वापर न करता केलेले विमोचन कार्य )</h4>
                                <hr>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="male_two">Male Number (पुरुष संख्या) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="male_two" name="male_two" type="text" placeholder="Enter Male Numbers">
                                    <span class="text-danger error-text male_two_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="woman_two">Woman Number (स्त्री संख्या) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="woman_two" name="woman_two" type="text" placeholder="Enter Woman Numbers">
                                    <span class="text-danger error-text woman_two_err"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <h4 class="card-title text-center">A Rescue Vehicle Was Used By The Fire Department For Rescue Operations (अग्निशमन विभागाने बचाव वाहनाचा वापर केलेले विमोचन कार्य)</h4>
                                <hr>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="male_three">Male Number (पुरुष संख्या) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="male_three" name="male_three" type="text" placeholder="Enter Male Numbers">
                                    <span class="text-danger error-text male_three_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="woman_three">Woman Number (स्त्री संख्या) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="woman_three" name="woman_three" type="text" placeholder="Enter Woman Numbers">
                                    <span class="text-danger error-text woman_three_err"></span>
                                </div>
                            </div>

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
                                    <input class="form-control" id="deceased_male" name="deceased_male" type="text" placeholder="Enter Deceased Male Numbers">
                                    <span class="text-danger error-text deceased_male_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="deceased_woman">Woman Number (स्त्री संख्या ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="deceased_woman" name="deceased_woman" type="text" placeholder="Enter Woman Numbers">
                                    <span class="text-danger error-text deceased_woman_err"></span>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <h4 class="card-title text-center">Wounded (जखमी)</h4>
                                <hr>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="wounded_male">Male Number (पुरुष संख्या ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="wounded_male" name="wounded_male" type="text" placeholder="Enter Male Numbers">
                                    <span class="text-danger error-text wounded_male_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="wounded_woman">Woman Number (स्त्री संख्या ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="wounded_woman" name="wounded_woman" type="text" placeholder="Enter Woman Numbers">
                                    <span class="text-danger error-text wounded_woman_err"></span>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="book_no">Book No( घटना पुस्तक क्रं ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="book_no" name="book_no" type="text" placeholder="Enter Book No">
                                <span class="text-danger error-text book_no_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="page_no">Page No( पृष्ठ क्रं ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="page_no" name="page_no" type="text" placeholder="Enter Page No">
                                <span class="text-danger error-text page_no_err"></span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary" id="editSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </section>
                </form>
            </div>
        </div>
        


        {{-- Listing Table --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <form action="{{ route('vardi_ahaval_filter') }}" method="GET" class="row">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="start-date">Start Date</label>
                                        <input required type="date" class="form-control" name="start_date" id="start-date" @if(request()->has('start_date')) value="{{ request('start_date') }}" @endif>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="end-date">End Date</label>
                                        <input required type="date" class="form-control" name="end_date" id="end-date" @if(request()->has('end_date')) value="{{ request('end_date') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status" class="control-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">---Select Status---</option>
                                            <option value="1" @if(request('status') == '1') selected @endif>Vardi Ahaval Submitted</option>
                                            <option value="0" @if(request('status') == '0') selected @endif>Vardi Ahaval Not Submitted</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" style="margin-top: 43px;">
                                        <button type="submit" id="apply-filter" class="btn btn-primary">Apply Filter</button>
                                        <a class="btn btn-success" href="{{ route('vardi_ahaval_list') }}">Clear</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @php
                        $serialNumber = 1;
                    @endphp
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Caller Name</th>
                                        <th>Caller Mobile Number</th>
                                        <th>Date</th>
                                        <th>Slip Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($slip_list as $list)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $list->caller_name }}</td>
                                            <td>{{ $list->caller_mobile_no }}</td>
                                            <td>{{ $list->slip_date }}</td>
                                            <td>{{ $list->slip_status }}</td>
                                            <td>
                                                @can('actionpermissions.view_generate_slip')
                                                <button class="view-element btn btn-secondary px-2 py-1" title="View Slip" data-id="{{ $list->slip_id }}"><i data-feather="eye"></i></button>
                                                @endcan
                                                @can('actionpermissions.create_vardi_book')
                                                @if($list->is_vardi_ahaval_submitted == '0')
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Create Vardi Ahaval" data-id="{{ $list->slip_id }}"><i data-feather="edit"></i> Report (वर्दी अहवाल)</button>
                                                @endif
                                                @endcan
                                                @can('actionpermissions.download_vardi_ahaval')
                                                @if($list->is_vardi_ahaval_submitted == '1')
                                                <button class="download-pdf btn btn-secondary px-2 py-1"
                                                        title="Download PDF"
                                                        data-id="{{ $list->slip_id }}"
                                                        data-pdf-file-name="{{ $list->vardi_ahaval_pdf_name }}"
                                                >
                                                    <i data-feather="download"></i>
                                                </button>
                                                @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Generated Slip View model --}}
        <div class="modal fade" id="viewSlipModal" tabindex="-1" role="dialog" aria-labelledby="viewSlipModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewSlipModalLabel">View Slip Details</h5>
                        <button type="button" class="close btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Slip details will be displayed here -->
                        <div id="slipDetails"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>





</x-admin.layout>

{{-- Current Date & Time --}}
<script>
    const now = new Date();
    const year = now.getFullYear();
    const month = (now.getMonth() + 1).toString().padStart(2, '0');
    const day = now.getDate().toString().padStart(2, '0');
    const hours = now.getHours().toString().padStart(2, '0');
    const minutes = now.getMinutes().toString().padStart(2, '0');

    const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
    document.getElementById('datetime_new').value = formattedDateTime;
</script>

{{-- for pdf --}}
<script>
    $(document).ready(function() {
        $("#buttons-datatables").on("click", ".download-pdf", function(e) {
            e.preventDefault();
            var pdfFileName = $(this).data("pdf-file-name");
            var pdfUrl = "{{ url('/vardi_ahaval/') }}/" + pdfFileName;

            // Open the PDF in a new tab/window
            window.open(pdfUrl, '_blank');
        });
    });
</script>

{{-- View Generated Slip  --}}
<script>
    $(document).ready(function() {
        // Event listener for "View Slip" button click
        $('.view-element').on('click', function() {
            var slipId = $(this).data('id');

            // Fetch slip details from the JSON endpoint
            $.ajax({
                url: '/view-action-taken-slip/' + slipId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Generate HTML table with the predefined headers
                    var tableHtml = '<h3 class="text-center"> Slip Details (स्लिप तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    
                    // Use predefined headers
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Slip Date (स्लिप तारीख)</th>';
                    tableHtml += '<th scope="col">Caller Name (कॉलरचे नाव)</th>';
                    tableHtml += '<th scope="col">Caller Mobile Number (कॉलर मोबाईल नंबर)</th>';
                    tableHtml += '<th scope="col">Incident Location (घटनेचे ठिकाण)</th>';
                    tableHtml += '<th scope="col">LandMark (लँडमार्क)</th>';
                    tableHtml += '<th scope="col">Incident Reason (घटनेचे कारण)</th>';
                    tableHtml += '<th scope="col">Slip Status (स्लिप स्थिती)</th>';
                    tableHtml += '</tr></thead>';

                    // Create table body
                    tableHtml += '<tbody>';
                    tableHtml += '<tr>';
                    tableHtml += '<th scope="row">' + data.slip_data.slip_date + '</th>';
                    tableHtml += '<td>' + data.slip_data.caller_name + '</td>';
                    tableHtml += '<td>' + data.slip_data.caller_mobile_no + '</td>';
                    tableHtml += '<td>' + data.slip_data.incident_location_address + '</td>';
                    tableHtml += '<td>' + data.slip_data.land_mark + '</td>';
                    tableHtml += '<td>' + data.slip_data.incident_reason + '</td>';
                    tableHtml += '<td>' + data.slip_data.slip_status + '</td>';
                    tableHtml += '</tr>';
                    tableHtml += '</tbody></table>';

                    // Table 2: Slip Action Form Details
                    tableHtml += '<br><h3 class="text-center"> Slip Action Form Details (स्लिप अँक्शन फॉर्म तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    // ... (headers here)
                    tableHtml += '<th scope="col">Call Date & Time (कॉल तारीख आणि वेळ)</th>';
                    tableHtml += '<th scope="col">Name of the Centre (केंद्राचे नाव)</th>';
                    tableHtml += '<th scope="col">Type of vehicle (वाहनाचा प्रकार)</th>';
                    tableHtml += '<th scope="col">Vehicle No (वाहनाचा नंबर)</th>';
                    tableHtml += '<th scope="col">Vehicle Departure Date & Time (वाहन सुटण्याची तारीख आणि वेळ)</th>';
                    tableHtml += '<th scope="col">Arrival Time (पोहचल्याची तारीख आणि वेळ)</th>';
                    tableHtml += '<th scope="col">Time of departure from the scene (घटनास्तळावरुन निघाल्याची तारीख आणि वेळ)</th>';
                    tableHtml += '<th scope="col">Time of arrival at the centre (केंद्रामध्ये आल्याची वेळ)</th>';
                    tableHtml += '<th scope="col">Total Distance In KM (एकूण अतंर)</th>';
                    tableHtml += '<th scope="col">Pumping hours (पंपिंग तास)</th>';
                    // ... (remaining headers here)
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    // ... (slip_action_form_data here)
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + data.slip_action_form_data.call_time + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.center_name + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.type_of_vehicle + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.number_of_vehicle + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.vehicle_departure_time + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.vehicle_arrival_time + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.vehicle_departure_from_scene_time + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.vehicle_arrival_at_center_time + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.total_distance + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.pumping_hours + '</td>';
                    // ... (remaining data here)
                    tableHtml += '</tr>';
                    tableHtml += '</tbody></table>';

                    // Table 3: Worker Details
                    tableHtml += '<br><h3 class="text-center"> Worker Details (कामगार तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Worker Name (कर्मचारीच नाव)</th>';
                    tableHtml += '<th scope="col">Worker Designation (कर्मचारीचं पदनाम)</th>';
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    // Loop through worker details
                    data.worker_details.forEach(function(worker) {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + worker.worker_name + '</td>';
                        tableHtml += '<td>' + worker.designation_name + '</td>';
                        tableHtml += '</tr>';
                    });
                    tableHtml += '</tbody></table>';

                    // Table 4: Additional Help Details
                    if (data.additional_help_details && data.additional_help_details.length > 0) {
                        tableHtml += '<br><h3 class="text-center"> Additional Help Details (अतिरिक्त मदत तपशील) </h3><br>';
                        tableHtml += '<table class="table table-bordered">';
                        tableHtml += '<thead><tr>';
                        tableHtml += '<th scope="col">Fire Station Name (फायर स्टेशनचे नाव)</th>';
                        tableHtml += '<th scope="col">Type Of Vehicle (वाहन प्रकार)</th>';
                        tableHtml += '<th scope="col">Vehicle Number (वाहन क्रमांक)</th>';
                        tableHtml += '<th scope="col">No Of Fireman (फायरमनची संख्या)</th>';
                        tableHtml += '<th scope="col">Inform Call DateTime (कॉलची तारीख वेळ)</th>';
                        tableHtml += '<th scope="col">Vehicle Departure DateTime (वाहन सुटण्याची तारीख वेळ)</th>';
                        tableHtml += '<th scope="col">Vehicle Arrival DateTime (वाहनाच्या आगमनाची तारीख वेळ)</th>';
                        tableHtml += '<th scope="col">Vehicle Return DateTime (वाहन परतीची तारीख वेळ)</th>';
                        tableHtml += '<th scope="col">Time to return to the center (केंद्रावर परतण्याची वेळ)</th>';
                        tableHtml += '<th scope="col">Total K.M (एकूण कि.मी)</th>';
                        tableHtml += '<th scope="col">Pumping Hours (पंपिंग तास)</th>';
                        tableHtml += '</tr></thead>';
                        tableHtml += '<tbody>';
                        // Loop through worker details
                        data.additional_help_details.forEach(function(help) {
                            tableHtml += '<tr>';
                            tableHtml += '<td>' + help.name + '</td>';
                            tableHtml += '<td>' + help.type_of_vehicle + '</td>';
                            tableHtml += '<td>' + help.vehicle_number + '</td>';
                            tableHtml += '<td>' + help.no_of_fireman + '</td>';
                            tableHtml += '<td>' + help.inform_call_time + '</td>';
                            tableHtml += '<td>' + help.vehicle_departure_time + '</td>';
                            tableHtml += '<td>' + help.vehicle_arrival_time + '</td>';
                            tableHtml += '<td>' + help.vehicle_return_time + '</td>';
                            tableHtml += '<td>' + help.vehicle_return_to_center_time + '</td>';
                            tableHtml += '<td>' + help.total_distance + '</td>';
                            tableHtml += '<td>' + help.pumping_hours + '</td>';
                            tableHtml += '</tr>';
                        });
                        tableHtml += '</tbody></table>';
                    } else {
                        tableHtml += '<p class="text-center">No Additional Help Details available</p>';
                    }

                    // Table 5: Occurrence Book Details
                    if (data.occurance_book_details && Object.keys(data.occurance_book_details).length > 0) {
                        tableHtml += '<br><h3 class="text-center"> Occurrence Book Details (घटना पुस्तक तपशील) </h3><br>';
                        tableHtml += '<table class="table table-bordered">';
                        tableHtml += '<thead><tr>';
                        tableHtml += '<th scope="col">Occurrence Book Date (घटना पुस्तक तारीख)</th>';
                        tableHtml += '<th scope="col">Occurrence Book Description (घटना पुस्तक वर्णन)</th>';
                        tableHtml += '<th scope="col">Occurrence Book Remark (घटना पुस्तक टिप्पणी)</th>';
                        tableHtml += '</tr></thead>';
                        tableHtml += '<tbody>';

                        tableHtml += '<tr>';
                        tableHtml += '<td>' + data.occurance_book_details.occurance_book_date + '</td>';
                        tableHtml += '<td>' + data.occurance_book_details.occurance_book_description + '</td>';
                        tableHtml += '<td>' + data.occurance_book_details.occurance_book_remark + '</td>';
                        tableHtml += '</tr>';

                        tableHtml += '</tbody></table>';
                    } else {
                        tableHtml += '<p class="text-center">No Occurrence Book Details available</p>';
                    }

                    // Display table in the modal
                    $('#slipDetails').html(tableHtml);
                    
                    // Show the modal
                    $('#viewSlipModal').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

{{-- Additional Help Form --}}
<script>
    // JavaScript to handle "Take Action" button click
    $(document).ready(function() {
        $('.action-element').on('click', function() {
            // Display the form
            var slip_id = $(this).data('id');
            $('#slip_id').val(slip_id);
            $('#additionalhelp').show();
        });

        var additionalHelpTemplate = $('#additional-help-container .additional-help').clone();

        $('#addMore').on('click', function() {
            var newAdditionalHelp = additionalHelpTemplate.clone();
            $('#additional-help-container').append(newAdditionalHelp);
        });

        $('#remove').on('click', function() {
            $('#additional-help-container .additional-help:last').remove();
        });


        // submitting form
        $('#additional-help-store').submit(function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Serialize the form data
            var formData = $(this).serialize();

            // Make an AJAX request
            $.ajax({
                url: $(this).attr('action'), // Get the form action attribute
                type: 'POST',
                data: formData,
                success: function(data) {
                    
                    if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('action_taken_slips_list') }}';
                        });
                else
                    swal("Error!", data.error2, "error");


                },
                error: function(error) {
                    // Handle error response
                    console.log(error);
                }
            });
        });

    });
</script>

{{-- Occurance Book Form --}}
<script>
    // JavaScript to handle "Take Action" button click
    $(document).ready(function() {
        $('.occurance-book-element').on('click', function() {
            // Display the form
            var slip_id = $(this).data('id');
            $('#slip_id_new').val(slip_id);
            $('#occurance-book').show();
        });

        // submitting form
        $('#store-occurance-book').submit(function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Serialize the form data
            var formData = $(this).serialize();

            // Make an AJAX request
            $.ajax({
                url: $(this).attr('action'), // Get the form action attribute
                type: 'POST',
                data: formData,
                success: function(data) {
                    
                    if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = '{{ route('action_taken_slips_list') }}';
                        });
                else
                    swal("Error!", data.error2, "error");


                },
                error: function(error) {
                    // Handle error response
                    console.log(error);
                }
            });
        });

    });
</script>

<!-- get slip data -->
<script>
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('slip_details', ":model_id") }}";

        $.ajax({
            url: url.replace(':model_id', model_id),
            type: 'GET',
            data: {
                '_token': "{{ csrf_token() }}"
            },
            success: function(data, textStatus, jqXHR) {
                editFormBehaviour();
                if (!data.error)
                {
                    console.log(data);
                    $("#editForm input[name='edit_model_id_new']").val(data.slip_data.slip_id);
                    $("#editForm input[name='vardi_name']").val(data.slip_data.caller_name);
                    $("#editForm input[name='vardi_contact_no']").val(data.slip_data.caller_mobile_no);
                    $("#editForm input[name='vardi_place']").val(data.slip_data.incident_location_address);
                    $("#editForm input[name='incident_time']").val(data.slip_data.call_time);
                    $("#editForm input[name='first_vehicle_departing_date_time']").val(data.slip_data.vehicle_departure_time);
                    $("#editForm input[name='time_of_arrival_at_the_scene']").val(data.slip_data.vehicle_arrival_time);
                    const dateTimeParts = data.slip_data.vehicle_departure_from_scene_time.split(' ');
                    $("#editForm input[name='date_of_departure_from_scene']").val(dateTimeParts[0]);
                    $("#editForm input[name='time_of_departure_from_scene']").val(dateTimeParts[1]);
                }
                else
                {
                    alert(data.error);
                }
            },
            error: function(error, jqXHR, textStatus, errorThrown) {
                alert("Some thing went wrong");
            },
        });
    });
</script>

{{-- store vardi ahaval --}}
<script>
    $(document).ready(function() {
        // submitting form
        $('#editForm').submit(function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Serialize the form data
                var formData = $(this).serialize();
                // alert(formData);

                // Make an AJAX request
                $.ajax({
                    url: $(this).attr('action'), // Get the form action attribute
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        if (!data.error2) {
                            if (data.errors) {
                                // Display validation errors
                                $.each(data.errors, function(field, messages) {
                                    $('.' + field + '_err').text(messages); // Display all messages if there are multiple
                                    $("[name='"+field+"']").addClass('is-invalid');
                                });
                            } else if (data.success) {
                                swal("Successful!", data.success, "success")
                                    .then((action) => {
                                        window.location.href = '{{ route('vardi_ahaval_list') }}';
                                    });
                            }
                        } else {
                            swal("Error!", data.error2, "error");
                        }
                    },
                    error: function(error) {
                        // Handle error response
                        console.log(error);
                    }
                });
            });
    });
</script>

{{-- vardi ahval pdf --}}
<script>
    $(document).ready(function() {
        $('.pdf-element').on('click', function() {
            var slipId = $(this).data('id');

            // Make an Ajax request to generate the PDF
            $.ajax({
                url: '/generate-vardi-ahaval-pdf/' + slipId,
                method: 'GET',
                success: function(response) {
                    // If the PDF is generated successfully, show a confirmation
                    console.log('PDF generated successfully');
                    if (confirm('PDF generated successfully. Do you want to open it?')) {
                        // Open the PDF in a new tab or window
                        window.open(response.pdfUrl, '_blank');
                    }
                },
                error: function(error) {
                    console.error('Error generating PDF', error);
                    alert('Error generating PDF. Please try again.');
                }
            });
        });
    });
</script>

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



