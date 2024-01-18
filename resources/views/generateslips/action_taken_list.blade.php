<x-admin.layout>
    <x-slot name="title">Generate Slip</x-slot>
    <x-slot name="heading">Generate Slip</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">

                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="datetime">Date & Time (तारीख वेळ) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="datetime" name="datetime" type="datetime-local">
                                    <span class="text-danger error-text datetime_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="caller_name">Caller Name (कॉलरचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="caller_name" name="caller_name" type="text" placeholder="Enter Caller Name">
                                    <span class="text-danger error-text caller_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="caller_mobile_no">Caller Mobile Number (कॉलर मोबाईल नंबर) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="caller_mobile_no" name="caller_mobile_no" type="number" placeholder="Enter Caller Mobile Number">
                                    <span class="text-danger error-text caller_mobile_no_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="incident_location">Incident Location Address (घटना ठिकाण पत्ता) <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="incident_location" id="incident_location" placeholder="Enter Incident Location Address" cols="30" rows="5"></textarea>
                                    {{-- <input class="form-control" id="vehicle_number" name="vehicle_number" type="text" placeholder="Enter Vehicle Number"> --}}
                                    <span class="text-danger error-text incident_location_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="landmark">LandMark (लँडमार्क) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="landmark" name="landmark" type="text" placeholder="Enter LandMark">
                                    <span class="text-danger error-text landmark_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="incident_reason">Incident Reason (घटनेचे कारण) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="incident_reason" name="incident_reason" type="text" placeholder="Enter Incident Reason">
                                    <span class="text-danger error-text incident_reason_err"></span>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        {{-- Edit Form --}}
        <div class="row" id="editContainer" style="display:none;">
            <div class="col">
                <form class="form-horizontal form-bordered" method="post" id="editForm">
                    @csrf
                    <section class="card">
                        <header class="card-header">
                            <h4 class="card-title">Edit Vehicle Details</h4>
                        </header>

                        <div class="card-body py-2">

                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_number">Vehicle Number <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_number" name="vehicle_number" type="text" placeholder="Enter Vehicle Number">
                                    <span class="text-danger error-text vehicle_number_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_type"> Select Vehicle Type <span class="text-danger">*</span></label>
                                    <select class="form-control" id="vehicle_type" name="vehicle_type">
                                        <option value="">--Select Vehicle Type--</option>
                                        <option value="Water tenders">Water tenders</option>
                                        <option value="Rescue vehicle">Rescue vehicle</option>
                                        <option value="Fire engine">Fire engine</option>
                                        <option value="Ladder truck">Ladder truck</option>
                                    </select>
                                    <span class="text-danger error-text vehicle_type_err"></span>
                                </div>
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
        


        {{-- Listing Table --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-3">
                                <div class="btn-group">
                                    {{-- <button id="addToTable" class="btn btn-primary">Generate Slip <i class="fa fa-plus"></i></button> --}}
                                    {{-- <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button> --}}
                                </div>
                            </div>
                            {{-- <form action="{{ route('filter') }}" method="GET" class="col-sm-9">
                                @csrf
                                <div class="row align-items-center">
                                    <div class="col-sm-3 form-group">
                                        <label for="start-date">Start Date</label>
                                        <input required type="date" class="form-control" name="start_date" id="start-date" @if(request()->has('start_date')) value="{{ request('start_date') }}" @endif>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label for="end-date">End Date</label>
                                        <input required type="date" class="form-control" name="end_date" id="end-date" @if(request()->has('end_date')) value="{{ request('end_date') }}" @endif>
                                    </div>
                                    <div class="col-sm-3" style="margin-top: 26px;">
                                        <button type="submit" id="apply-filter" class="btn btn-primary">Apply Filter</button>
                                        <a class="btn btn-success" href="{{ route('slips_list') }}">Clear</a>
                                    </div>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                    
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
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
                                            <td>{{ $list->caller_name }}</td>
                                            <td>{{ $list->caller_mobile_no }}</td>
                                            <td>{{ $list->slip_date }}</td>
                                            <td>{{ $list->slip_status }}</td>
                                            <td>
                                                {{-- <button class="download-pdf btn btn-secondary px-2 py-1"
                                                        title="Download PDF"
                                                        data-id="{{ $list->slip_id }}"
                                                        data-pdf-file-name="{{ $list->pdf_name }}"
                                                >
                                                    <i data-feather="download"></i>
                                                </button> --}}

                                                <button class="view-element btn btn-secondary px-2 py-1" title="View Slip" data-id="{{ $list->slip_id }}"><i data-feather="eye"></i></button>
                                                @if($list->is_additional_form_submitted == '0') 
                                                <button class="btn btn-danger action-element px-2 py-1" title="Additional Help" data-id="{{ $list->slip_id }}">Additional Help</button>
                                                @endif
                                                @if($list->is_occurance_book_submitted == '0')
                                                <button class="btn btn-info occurance-book-element px-2 py-1" title="Occurance Book" data-id="{{ $list->slip_id }}">Occurance Book</button> 
                                                @endif
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
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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

{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        console.log(formdata);
        $.ajax({
            url: '{{ route('store_slip') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
                if (!data.error2)
                    swal("Successful!", data.success, "success")
                        .then((action) => {
                            window.location.href = data.pdf_url;
                            // window.location.href = '{{ route('slips_list') }}';
                        });
                else
                    swal("Error!", data.error2, "error");
            },
            statusCode: {
                422: function(responseObject, textStatus, jqXHR) {
                    $("#addSubmit").prop('disabled', false);
                    resetErrors();
                    printErrMsg(responseObject.responseJSON.errors);
                },
                500: function(responseObject, textStatus, errorThrown) {
                    $("#addSubmit").prop('disabled', false);
                    swal("Error occured!", "Something went wrong please try again", "error");
                }
            }
        });

    });
</script>


<!-- Edit -->
<script>
    $("#buttons-datatables").on("click", ".edit-element", function(e) {
        e.preventDefault();
        var model_id = $(this).attr("data-id");
        var url = "{{ route('vehicle_details.edit', ":model_id") }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.vehicle.vehicle_id);
                    $("#editForm input[name='vehicle_number']").val(data.vehicle.vehicle_number);
                    $("#editForm select[name='vehicle_type']").val(data.vehicle.vehicle_type);
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


<!-- Update -->
<script>
    $(document).ready(function() {
        $("#editForm").submit(function(e) {
            e.preventDefault();
            $("#editSubmit").prop('disabled', true);
            var formdata = new FormData(this);
            formdata.append('_method', 'PUT');
            var model_id = $('#edit_model_id').val();
            var url = "{{ route('vehicle_details.update', ":model_id") }}";
            //
            $.ajax({
                url: url.replace(':model_id', model_id),
                type: 'POST',
                data: formdata,
                contentType: false,
                processData: false,
                success: function(data)
                {
                    $("#editSubmit").prop('disabled', false);
                    if (!data.error2)
                        swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('vehicle_details.index') }}';
                            });
                    else
                        swal("Error!", data.error2, "error");
                },
                statusCode: {
                    422: function(responseObject, textStatus, jqXHR) {
                        $("#editSubmit").prop('disabled', false);
                        resetErrors();
                        printErrMsg(responseObject.responseJSON.errors);
                    },
                    500: function(responseObject, textStatus, errorThrown) {
                        $("#editSubmit").prop('disabled', false);
                        swal("Error occured!", "Something went wrong please try again", "error");
                    }
                }
            });

        });
    });
</script>


<!-- Delete -->
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to delete this vehicle details?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('vehicle_details.destroy', ":model_id") }}";

                $.ajax({
                    url: url.replace(':model_id', model_id),
                    type: 'POST',
                    data: {
                        '_method': "DELETE",
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data, textStatus, jqXHR) {
                        if (!data.error && !data.error2) {
                            swal("Success!", data.success, "success")
                                .then((action) => {
                                    window.location.reload();
                                });
                        } else {
                            if (data.error) {
                                swal("Error!", data.error, "error");
                            } else {
                                swal("Error!", data.error2, "error");
                            }
                        }
                    },
                    error: function(error, jqXHR, textStatus, errorThrown) {
                        swal("Error!", "Something went wrong", "error");
                    },
                });
            }
        });
    });
</script>

{{-- for pdf --}}
<script>
    $(document).ready(function() {
        $("#buttons-datatables").on("click", ".download-pdf", function(e) {
            e.preventDefault();
            var pdfFileName = $(this).data("pdf-file-name");
            var pdfUrl = "{{ url('/slips/') }}/" + pdfFileName;

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
                    tableHtml += '<br><h3 class="text-center"> Slip Action Form Details (स्लिप अॅक्शन फॉर्म तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    // ... (headers here)
                    tableHtml += '<th scope="col">Call Date & Time (कॉल तारीख आणि वेळ)</th>';
                    tableHtml += '<th scope="col">Vehicle Departure Date & Time (वाहन सुटण्याची तारीख आणि वेळ)</th>';
                    // ... (remaining headers here)
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    // ... (slip_action_form_data here)
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + data.slip_action_form_data.call_time + '</td>';
                    tableHtml += '<td>' + data.slip_action_form_data.vehicle_departure_time + '</td>';
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
                    tableHtml += '<br><h3 class="text-center"> Additional Help Details (अतिरिक्त मदत तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Fire Station Name (फायर स्टेशनचे नाव)</th>';
                    tableHtml += '<th scope="col">Vehicle Number (वाहन क्रमांक)</th>';
                    tableHtml += '<th scope="col">No Of Fireman (फायरमनची संख्या)</th>';
                    tableHtml += '<th scope="col">Inform Call DateTime (कॉलची तारीख वेळ)</th>';
                    tableHtml += '<th scope="col">Vehicle Departure DateTime (वाहन सुटण्याची तारीख वेळ)</th>';
                    tableHtml += '<th scope="col">Vehicle Arrival DateTime (वाहनाच्या आगमनाची तारीख वेळ)</th>';
                    tableHtml += '<th scope="col">Vehicle Return DateTime (वाहन परतीची तारीख वेळ)</th>';
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    // Loop through worker details
                    data.additional_help_details.forEach(function(help) {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + help.name + '</td>';
                        tableHtml += '<td>' + help.vehicle_number + '</td>';
                        tableHtml += '<td>' + help.no_of_fireman + '</td>';
                        tableHtml += '<td>' + help.inform_call_time + '</td>';
                        tableHtml += '<td>' + help.vehicle_departure_time + '</td>';
                        tableHtml += '<td>' + help.vehicle_arrival_time + '</td>';
                        tableHtml += '<td>' + help.vehicle_return_time + '</td>';
                        tableHtml += '</tr>';
                    });
                    tableHtml += '</tbody></table>';

                    // Table 5: Occurance Book Details
                    tableHtml += '<br><h3 class="text-center"> Occurance Book Details (घटना पुस्तक तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Occurance Book Date (घटना पुस्तक तारीख)</th>';
                    tableHtml += '<th scope="col">Occurance Book Description (घटना पुस्तक वर्णन)</th>';
                    tableHtml += '<th scope="col">Occurance Book Remark (घटना पुस्तक टिप्पणी)</th>';
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';

                    tableHtml += '<tr>';
                    tableHtml += '<td>' + data.occurance_book_details.occurance_book_date + '</td>';
                    tableHtml += '<td>' + data.occurance_book_details.occurance_book_description + '</td>';
                    tableHtml += '<td>' + data.occurance_book_details.occurance_book_remark + '</td>';
                    tableHtml += '</tr>';

                    tableHtml += '</tbody></table>';

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



