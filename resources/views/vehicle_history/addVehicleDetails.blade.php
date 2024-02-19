<x-admin.layout>
    <style>
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
    
        .blink {
            animation: blink 1s infinite;
        }
    </style>
    <x-slot name="title">Add Vehicle Details</x-slot>
    <x-slot name="heading">Add Vehicle Details (वाहनाचे तपशील जोडा)</x-slot>


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="mb-3 row">

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_name">Vehicle Name(वाहनाचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_name" name="vehicle_name" type="text" placeholder="Enter Vehicle Name">
                                    <span class="text-danger error-text vehicle_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="company_name">Company Name(कंपनीचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="company_name" name="company_name" type="text" placeholder="Enter Company Name">
                                    <span class="text-danger error-text company_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_no">Vehicle Number(वाहन क्रमांक) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_no" name="vehicle_no" type="text" placeholder="Enter Vehicle Number">
                                    <span class="text-danger error-text vehicle_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="rc_no">RC Number(आरसी क्रमांक) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="rc_no" name="rc_no" type="text" placeholder="Enter RC Number">
                                    <span class="text-danger error-text rc_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="rc_upload">Upload RC (आरसी अपलोड करा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="rc_upload" name="rc_upload" type="file" placeholder="Upload RC Book">
                                    <span class="text-danger error-text rc_upload_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="puc_start_date">PUC Start Date(पीयूसी सुरू होण्याची तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="puc_start_date" name="puc_start_date" type="date" placeholder="Enter PUC Start Date">
                                    <span class="text-danger error-text puc_start_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="puc_end_date">PUC End Date(पीयूसी समाप्ती तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="puc_end_date" name="puc_end_date" type="date" placeholder="Enter PUC End Date">
                                    <span class="text-danger error-text puc_end_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="puc_upload">Upload PUC (पीयूसी अपलोड करा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="puc_upload" name="puc_upload" type="file" placeholder="Upload PUC">
                                    <span class="text-danger error-text puc_upload_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="insurance_start_date">Insurance Start Date(विमा सुरू होण्याची तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="insurance_start_date" name="insurance_start_date" type="date" placeholder="Enter Insurance Start Date">
                                    <span class="text-danger error-text insurance_start_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="insurance_end_date">Insurance End Date(विमा समाप्ती तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="insurance_end_date" name="insurance_end_date" type="date" placeholder="Enter Insurance End Date">
                                    <span class="text-danger error-text insurance_end_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="insurance_upload">Upload Insurance Certificate (विमा प्रमाणपत्र अपलोड करा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="insurance_upload" name="insurance_upload" type="file" placeholder="Upload Insurance certificate">
                                    <span class="text-danger error-text insurance_upload_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_fitness_start_date">Vehicle Fitness Start Date(वाहन फिटनेस सुरू तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_fitness_start_date" name="vehicle_fitness_start_date" type="date" placeholder="Enter Vehicle Fitness Start Date">
                                    <span class="text-danger error-text vehicle_fitness_start_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_fitness_end_date">Vehicle Fitness End Date(वाहन फिटनेस समाप्ती तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_fitness_end_date" name="vehicle_fitness_end_date" type="date" placeholder="Enter Vehicle Fitness End Date">
                                    <span class="text-danger error-text vehicle_fitness_end_date_err"></span>
                                </div>

                                <div class="col-md-5">
                                    <label class="col-form-label" for="vehicle_fitness_upload">Upload Vehicle Fitness certificate (वाहन फिटनेस प्रमाणपत्र अपलोड करा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_fitness_upload" name="vehicle_fitness_upload" type="file" placeholder="Upload Vehicle Fitness certificate">
                                    <span class="text-danger error-text vehicle_fitness_upload_err"></span>
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

        <!-- Edit Form -->
        <div class="row" id="editContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">Edit Vehicle Details</h4>
                    </header>
                    <form class="theme-form" name="editForm" action="{{ route('update_vehicle_details') }}" method="POST" id="editForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="vehicle_history_id" id="vehicle_history_id" value="">
                        <div class="card-body">
                            <div class="mb-3 row">

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_name">Vehicle Name(वाहनाचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_name" name="vehicle_name" type="text" placeholder="Enter Vehicle Name">
                                    <span class="text-danger error-text vehicle_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="company_name">Company Name(कंपनीचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="company_name" name="company_name" type="text" placeholder="Enter Company Name">
                                    <span class="text-danger error-text company_name_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_no">Vehicle Number(वाहन क्रमांक) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_no" name="vehicle_no" type="text" placeholder="Enter Vehicle Number">
                                    <span class="text-danger error-text vehicle_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="rc_no">RC Number(आरसी क्रमांक) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="rc_no" name="rc_no" type="text" placeholder="Enter RC Number">
                                    <span class="text-danger error-text rc_no_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="rc_upload">Upload RC (आरसी अपलोड करा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="rc_upload" name="rc_upload" type="file" placeholder="Upload RC Book">
                                    <a href="" id="view_rc" target="blank">View Document</a>
                                    <span class="text-danger error-text rc_upload_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="puc_start_date">PUC Start Date(पीयूसी सुरू होण्याची तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="puc_start_date" name="puc_start_date" type="date" placeholder="Enter PUC Start Date">
                                    <span class="text-danger error-text puc_start_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="puc_end_date">PUC End Date(पीयूसी समाप्ती तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="puc_end_date" name="puc_end_date" type="date" placeholder="Enter PUC End Date">
                                    <span class="text-danger error-text puc_end_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="puc_upload">Upload PUC (पीयूसी अपलोड करा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="puc_upload" name="puc_upload" type="file" placeholder="Upload PUC">
                                    <a href="" id="view_puc" target="blank">View Document</a>
                                    <span class="text-danger error-text puc_upload_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="insurance_start_date">Insurance Start Date(विमा सुरू होण्याची तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="insurance_start_date" name="insurance_start_date" type="date" placeholder="Enter Insurance Start Date">
                                    <span class="text-danger error-text insurance_start_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="insurance_end_date">Insurance End Date(विमा समाप्ती तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="insurance_end_date" name="insurance_end_date" type="date" placeholder="Enter Insurance End Date">
                                    <span class="text-danger error-text insurance_end_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="insurance_upload">Upload Insurance Certificate (विमा प्रमाणपत्र अपलोड करा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="insurance_upload" name="insurance_upload" type="file" placeholder="Upload Insurance certificate">
                                    <a href="" id="view_insurance" target="blank">View Document</a>
                                    <span class="text-danger error-text insurance_upload_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_fitness_start_date">Vehicle Fitness Start Date(वाहन फिटनेस सुरू तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_fitness_start_date" name="vehicle_fitness_start_date" type="date" placeholder="Enter Vehicle Fitness Start Date">
                                    <span class="text-danger error-text vehicle_fitness_start_date_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_fitness_end_date">Vehicle Fitness End Date(वाहन फिटनेस समाप्ती तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_fitness_end_date" name="vehicle_fitness_end_date" type="date" placeholder="Enter Vehicle Fitness End Date">
                                    <span class="text-danger error-text vehicle_fitness_end_date_err"></span>
                                </div>

                                <div class="col-md-5">
                                    <label class="col-form-label" for="vehicle_fitness_upload">Upload Vehicle Fitness certificate (वाहन फिटनेस प्रमाणपत्र अपलोड करा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_fitness_upload" name="vehicle_fitness_upload" type="file" placeholder="Upload Vehicle Fitness certificate">
                                    <a href="" id="view_vehicle_fitness" target="blank">View Document</a>
                                    <span class="text-danger error-text vehicle_fitness_upload_err"></span>
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


        {{-- listing --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add Vehicle Detail <i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <b class="text-danger" style="float: right;padding-top:1rem;">लाल रंग : कागदपत्रांची मुदत लवकरच संपेल...!</b>
                            </div>
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
                                        <th>Vehicle Name</th>
                                        <th>Vehicle Number</th>
                                        <th>RC Number</th>
                                        <th>PUC Expire Date</th>
                                        <th>Insurance Expire Date</th>
                                        <th>fitness Expire Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicle_list as $list)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $list->vehicle_name }}</td>
                                            <td>{{ $list->vehicle_no }}</td>
                                            <td>{{ $list->rc_no }}</td>
                                            <td>{{ $list->puc_end_date }}</td>
                                            <td>{{ $list->insurance_end_date }}</td>
                                            <td>{{ $list->vehicle_fitness_end_date }}</td>
                                            <td>
                                                <button class="view-details btn btn-secondary px-2 py-1" title="View Details" data-id="{{ $list->vehicle_history_id }}"><i data-feather="eye"></i></button>
                                                <button class="edit-details btn btn-primary px-2 py-1" title="Edit Details" data-id="{{ $list->vehicle_history_id }}"><i data-feather="edit"></i></button>
                                                <button class="btn btn-warning action-element px-2 py-1" title="Take Action" data-id="{{ $list->vehicle_history_id }}"><i data-feather="book"></i></button>
                                                <button class="btn btn-info list-element px-2 py-1" title="View Action List" data-id="{{ $list->vehicle_history_id }}"><i data-feather="list"></i></button>
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Retire Vehicle" data-id="{{ $list->vehicle_history_id }}"><i data-feather="trash-2"></i></button>
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

        {{-- View Vehicle Details model --}}
        <div class="modal fade" id="viewVehicleDetails" tabindex="-1" role="dialog" aria-labelledby="viewVehicleDetailsLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewVehicleDetailsLabel">View Vehicle Details</h5>
                        <button type="button" class="close btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Vehicle Details will be displayed here -->
                        <div id="VehicleDetails"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>




</x-admin.layout>


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('store_vechicle_details') }}',
            type: 'POST',
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data)
            {
                $("#addSubmit").prop('disabled', false);
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
                                    window.location.href = '{{ route('add_vechicle_details') }}';
                                });
                        }
                    } else {
                        swal("Error!", data.error2, "error");
                    }
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

{{-- edit --}}
<script>
    $(document).ready(function() {
        $('.edit-details').on('click', function() {
            // Display the form
            var vehicle_history_id = $(this).data('id');
            $('#vehicle_history_id').val(vehicle_history_id);

            $.ajax({
                url: '/view-vehicle-detail/' + vehicle_history_id,
                type: 'GET',
                success: function(data) {
                    // Update your UI with the fetched data
                    // For example, assuming you have a field in your form with id 'slip_name'
                    $("#editForm input[name='vehicle_name']").val(data.vehicle_detail.vehicle_name);
                    $("#editForm input[name='company_name']").val(data.vehicle_detail.company_name);
                    $("#editForm input[name='vehicle_no']").val(data.vehicle_detail.vehicle_no);
                    $("#editForm input[name='rc_no']").val(data.vehicle_detail.rc_no);
                    var rcUrl = 'storage/' + data.vehicle_detail.rc_upload;
                    var pucUrl = 'storage/' + data.vehicle_detail.puc_upload;
                    var insuranceUrl = 'storage/' + data.vehicle_detail.insurance_upload;
                    var fitnessUrl = 'storage/' + data.vehicle_detail.vehicle_fitness_upload;
                    $("#view_rc").attr("href", rcUrl);
                    $("#view_puc").attr("href", pucUrl);
                    $("#view_insurance").attr("href", insuranceUrl);
                    $("#view_vehicle_fitness").attr("href", fitnessUrl);
                    $("#editForm input[name='puc_start_date']").val(data.vehicle_detail.puc_start_date);
                    $("#editForm input[name='puc_end_date']").val(data.vehicle_detail.puc_end_date);
                    $("#editForm input[name='insurance_start_date']").val(data.vehicle_detail.insurance_start_date);
                    $("#editForm input[name='insurance_end_date']").val(data.vehicle_detail.insurance_end_date);
                    $("#editForm input[name='vehicle_fitness_start_date']").val(data.vehicle_detail.vehicle_fitness_start_date);
                    $("#editForm input[name='vehicle_fitness_end_date']").val(data.vehicle_detail.vehicle_fitness_end_date);

                    // Show the form
                    $('#editContainer').show();
                    $('#addContainer').hide();
                    $('#btnCancel').show();
                },
                error: function(error) {
                    // Handle error response
                    console.log(error);
                }
            });

            $('#editContainer').show();
        });
    });
</script>

{{-- update --}}
<script>
    // submitting form
    $('#editForm').submit(function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Create FormData object
        var formData = new FormData(this);

        // Make an AJAX request with FormData
        $.ajax({
            url: $(this).attr('action'), 
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (!data.error2) {
                    if (data.errors) {
                        // Display validation errors
                        $.each(data.errors, function(field, messages) {
                            $('.' + field + '_err').text(messages);
                            $("[name='"+field+"']").addClass('is-invalid');
                        });
                    } else if (data.success) {
                        swal("Successful!", data.success, "success")
                            .then((action) => {
                                window.location.href = '{{ route('add_vechicle_details') }}';
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
</script>



{{-- View vehicle Detail --}}
<script>
    $(document).ready(function() {
        $('.view-details').on('click', function() {
            var vehicleId = $(this).data('id');

            // Fetch slip details from the JSON endpoint
            $.ajax({
                url: '/view-vehicle-detail/' + vehicleId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Generate HTML table with the predefined headers
                    var tableHtml = '';
                    if (data.vehicle_detail) {
                    tableHtml += '<br><h3 class="text-center"> Vehicle Details (वाहन तपशील) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<tr> <th> Vehicle Name (वाहनाचे नाव) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.vehicle_name +'</td></tr>';

                    tableHtml += '<tr> <th> Company Name (कंपनीचे नाव) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.company_name +'</td></tr>';

                    tableHtml += '<tr> <th> Vehicle Number (वाहन क्रमांक) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.vehicle_no +'</td></tr>';

                    tableHtml += '<tr> <th> RC Number (आरसी क्रमांक) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.rc_no +'</td></tr>';

                    tableHtml += '<tr> <th> Uploaded RC File (आरसी फाइल) </th>';
                    tableHtml += '<td><a href="storage/'+ data.vehicle_detail.rc_upload +'" target="_blank">View Document</a></td></tr>';

                    tableHtml += '<tr> <th> PUC Start Date (पीयूसी सुरू होण्याची तारीख) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.puc_start_date +'</td></tr>';

                    tableHtml += '<tr> <th> PUC End Date (पीयूसी समाप्ती तारीख) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.puc_end_date +'</td></tr>';

                    tableHtml += '<tr> <th> Upload PUC (पीयूसी अपलोड) </th>';
                    tableHtml += '<td><a href="storage/'+ data.vehicle_detail.puc_upload +'" target="_blank">View Document</a></td></tr>';

                    tableHtml += '<tr> <th> Insurance Start Date (विमा सुरू होण्याची तारीख) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.insurance_start_date +'</td></tr>';

                    tableHtml += '<tr> <th> Insurance End Date (विमा समाप्ती तारीख) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.insurance_end_date +'</td></tr>';

                    tableHtml += '<tr> <th> Insurance Certificate (विमा प्रमाणपत्र) </th>';
                    tableHtml += '<td><a href="storage/'+ data.vehicle_detail.insurance_upload +'" target="_blank">View Document</a></td></tr>';

                    tableHtml += '<tr> <th> Vehicle Fitness Start Date (वाहन फिटनेस सुरू तारीख) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.vehicle_fitness_start_date +'</td></tr>';

                    tableHtml += '<tr> <th> Vehicle Fitness End Date (वाहन फिटनेस समाप्ती तारीख) </th>';
                    tableHtml += '<td>'+ data.vehicle_detail.vehicle_fitness_end_date +'</td></tr>';

                    tableHtml += '<tr> <th> Vehicle Fitness certificate (वाहन फिटनेस प्रमाणपत्र)</th>';
                    tableHtml += '<td><a href="storage/'+ data.vehicle_detail.vehicle_fitness_upload +'" target="_blank">View Document</a></td></tr>';

                    tableHtml += '</table>';
                }else{
                    tableHtml += '<h3 class="text-center">No Detail Available</h3>';
                }

                    // Display table in the modal
                    $('#VehicleDetails').html(tableHtml);
                    
                    // Show the modal
                    $('#viewVehicleDetails').modal('show');
                },
                error: function(error) {
                    console.log(error);
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
            title: "Are you sure to delete this driver detail?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('driver_details.destroy', ":model_id") }}";

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

{{-- blink date if documents expire within 10 days --}}
<script>
    $(document).ready(function() {
        var currentDate = new Date();

        $('#buttons-datatables tbody tr').each(function() {
            var pucEndDate = new Date($(this).find('td:nth-child(5)').text()); // Adjust the index based on your table structure

            // Calculate the difference in days
            var timeDiff = pucEndDate.getTime() - currentDate.getTime();
            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (daysDiff <= 10 && daysDiff >= 0) {
                $(this).find('td:nth-child(5)').addClass('text-danger blink'); // Add class for styling
            }
        });

        $('#buttons-datatables tbody tr').each(function() {
            var insuranceEndDate = new Date($(this).find('td:nth-child(6)').text()); // Adjust the index based on your table structure

            // Calculate the difference in days
            var timeDiff = insuranceEndDate.getTime() - currentDate.getTime();
            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (daysDiff <= 10 && daysDiff >= 0) {
                $(this).find('td:nth-child(6)').addClass('text-danger blink'); // Add class for styling
            }
        });

        $('#buttons-datatables tbody tr').each(function() {
            var fitnessEndDate = new Date($(this).find('td:nth-child(7)').text()); // Adjust the index based on your table structure

            // Calculate the difference in days
            var timeDiff = fitnessEndDate.getTime() - currentDate.getTime();
            var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

            if (daysDiff <= 10 && daysDiff >= 0) {
                $(this).find('td:nth-child(7)').addClass('text-danger blink'); // Add class for styling
            }
        });

    });
</script>

{{-- retire vehicle --}}
<script>
    $("#buttons-datatables").on("click", ".rem-element", function(e) {
        e.preventDefault();
        swal({
            title: "Are you sure to retire this vehicle?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('vehicle.destroy', ":model_id") }}";

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
