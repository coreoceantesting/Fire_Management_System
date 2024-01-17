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

        {{-- Listing Table --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-3">
                                <div class="btn-group">
                                    <button id="addToTable" class="btn btn-primary">Generate Slip <i class="fa fa-plus"></i></button>
                                    <button id="btnCancel" class="btn btn-danger" style="display:none;">Cancel</button>
                                </div>
                            </div>
                            <form action="{{ route('filter') }}" method="GET" class="col-sm-9">
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
                            </form>
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
                                                <button class="download-pdf btn btn-secondary px-2 py-1"
                                                        title="Download PDF"
                                                        data-id="{{ $list->slip_id }}"
                                                        data-pdf-file-name="{{ $list->pdf_name }}"
                                                >
                                                    <i data-feather="download"></i>
                                                </button>

                                                {{-- <button class="edit-element btn btn-secondary px-2 py-1" title="Download PDF" data-id="{{ $list->slip_id }}"><i data-feather="file-text"></i></button> --}}
                                                {{-- <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vehicle Detail" data-id="{{ $list->vehicle_id }}"><i data-feather="trash-2"></i> </button> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
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

