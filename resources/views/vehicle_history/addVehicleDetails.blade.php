<x-admin.layout>
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
                                    <label class="col-form-label" for="rc_upload">Upload RC (आरसी अपलोड करा)</label>
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
                                                {{-- <button class="view-element btn btn-secondary px-2 py-1" title="View List" data-id="{{ $list->vehicle_history_id }}"><i data-feather="list"></i></button> --}}
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

{{-- View Stock List  --}}
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

{{-- validation for available quntity --}}
<script>
    $(document).ready(function() {
        // Event listener for keyup on the quantity input field
        $('#quantity').on('keyup', function() {
            var quantity = parseInt($(this).val());

            // Check if the entered quantity is greater than the available quantity
            if (quantity < 0) {
                $('.quantity_err').text('Entered quantity must be greater than 0');
                $('#addSubmit').prop('disabled', true);
            } else {
                $('.quantity_err').text('');
                $('#addSubmit').prop('disabled', false);
            }
        });
    });
</script>
