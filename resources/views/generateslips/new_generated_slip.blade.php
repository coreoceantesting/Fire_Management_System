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

        {{-- Take Action Form --}}
        <div class="row" id="takeActionForm" style="display: none">
            <div class="col">
                <form class="form-horizontal form-bordered" action="{{ route('store_slip_action_form') }}" id="slipactionform" method="POST">
                    @csrf
                    <input type="hidden" name="slip_id" id="slip_id" value="">
                    <section class="card">
                        <header class="card-header">
                            <h4 class="card-title">Take Action</h4>
                        </header>
                        <div class="card-body py-2">
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="call_time" class="control-label">Call Date & Time (कॉल तारीख आणि वेळ) :</label>
                                    <input class="form-control" type="datetime-local" name="call_time" required>
                                </div>
                                
                                <div class="col-md-5">
                                    <label for="vehicle_departure_time" class="control-label">Vehicle Departure Date & Time (वाहन सुटण्याची तारीख आणि वेळ):</label>
                                    <input class="form-control" type="datetime-local" name="vehicle_departure_time" required>
                                </div>
                            </div>
                            
                            <!-- Worker Details Section -->
                            <div class="form-group row" id="worker-details-container">
                                <div class="col-md-3 worker-details">
                                    <label for="worker_name[]" class="control-label">Worker Name (कर्मचारीच नाव):</label>
                                    <input class="form-control" type="text" name="worker_name[]" required>
                    
                                    <label for="worker_designation[]" class="control-label">Worker Designation (कर्मचारीचं पदनाम):</label>
                                    <select class="form-control" name="worker_designation[]" required>
                                        <!-- Populate dropdown options from master data -->
                                        <option value="">--Select Designation--</option>
                                        @foreach ($designation_list as $list)
                                            <option value="{{ $list->designation_id }}">{{ $list->designation_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-warning" id="addWorkerDetails">Add Worker</button>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-warning" id="removeWorkerDetails">Remove Worker</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a class="btn btn-success" href="{{ route('new_generated_slip') }}">Cancel</a>
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
                                                <button class="btn btn-danger action-element px-2 py-1" title="Take Action" data-id="{{ $list->slip_id }}">Take Action</button> 
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
    document.getElementById('datetime').value = formattedDateTime;
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
                url: '/view-slip/' + slipId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Generate HTML table with the predefined headers
                    var tableHtml = '<table class="table table-bordered">';
                    
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

{{-- Take Action Form --}}
<script>
    // JavaScript to handle "Take Action" button click
    $(document).ready(function() {
        $('.action-element').on('click', function() {
            // Display the form
            var slip_id = $(this).data('id');
            $('#slip_id').val(slip_id);
            $('#takeActionForm').show();
        });

        var workerDetailsTemplate = $('#worker-details-container .worker-details').clone();

        $('#addWorkerDetails').on('click', function() {
            var newWorkerDetails = workerDetailsTemplate.clone();
            $('#worker-details-container').append(newWorkerDetails);
        });

        $('#removeWorkerDetails').on('click', function() {
            $('#worker-details-container .worker-details:last').remove();
        });


        // submitting form
        $('#slipactionform').submit(function(event) {
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
                            window.location.href = '{{ route('new_generated_slip') }}';
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



