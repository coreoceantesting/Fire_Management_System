<x-admin.layout>
    <x-slot name="title">Vehicle Details</x-slot>
    <x-slot name="heading">Vehicle Details (वाहन तपशील)</x-slot>
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
                                    <label class="col-form-label" for="vehicle_type">Vehicle Type Name(वाहनाच्या प्रकाराचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_type" name="vehicle_type" type="text" placeholder="Enter Vehicle Type Name">
                                    <span class="text-danger error-text vehicle_type_err"></span>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_number">Vehicle Number(वाहन क्रमांक) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_number" name="vehicle_number" type="text" placeholder="Enter Vehicle Number">
                                    <span class="text-danger error-text vehicle_number_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label for="fire_station_id" class="col-form-label">Fire Station Name (फायर स्टेशनचे नाव) <span class="text-danger">*</span>:</label>
                                    <select class="form-control" name="fire_station_id">
                                        <option value="">--Select Fire Station--</option>
                                        @foreach ($fire_station_list as $list)
                                            <option value="{{ $list->fire_station_id }}">{{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text fire_station_id_err"></span>
                                </div>
                                
                                {{-- <div class="col-md-4">
                                    <label class="col-form-label" for="role"> Select Vehicle Type <span class="text-danger">*</span></label>
                                    <select class="form-control" id="vehicle_type" name="vehicle_type">
                                        <option value="">--Select Vehicle Type--</option>
                                        <option value="Water tenders">Water tenders</option>
                                        <option value="Rescue vehicle">Rescue vehicle</option>
                                        <option value="Fire engine">Fire engine</option>
                                        <option value="Ladder truck">Ladder truck</option>
                                    </select>
                                    <span class="text-danger error-text vehicle_type_err"></span>
                                </div> --}}
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
                                    <label class="col-form-label" for="vehicle_type">Vehicle Type Name(वाहनाच्या प्रकाराचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_type" name="vehicle_type" type="text" placeholder="Enter Vehicle Type Name">
                                    <span class="text-danger error-text vehicle_type_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_number">Vehicle Number(वाहन क्रमांक) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vehicle_number" name="vehicle_number" type="text" placeholder="Enter Vehicle Number">
                                    <span class="text-danger error-text vehicle_number_err"></span>
                                </div>

                                <div class="col-md-4">
                                    <label for="fire_station_id" class="col-form-label">Fire Station Name (फायर स्टेशनचे नाव) <span class="text-danger">*</span>:</label>
                                    <select class="form-control" name="fire_station_id" id="fire_station_id">
                                        <option value="">--Select Fire Station--</option>
                                        @foreach ($fire_station_list as $list)
                                            <option value="{{ $list->fire_station_id }}">{{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text fire_station_id_err"></span>
                                </div>
                                
                                {{-- <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_type"> Select Vehicle Type <span class="text-danger">*</span></label>
                                    <select class="form-control" id="vehicle_type" name="vehicle_type">
                                        <option value="">--Select Vehicle Type--</option>
                                        <option value="Water tenders">Water tenders</option>
                                        <option value="Rescue vehicle">Rescue vehicle</option>
                                        <option value="Fire engine">Fire engine</option>
                                        <option value="Ladder truck">Ladder truck</option>
                                    </select>
                                    <span class="text-danger error-text vehicle_type_err"></span>
                                </div> --}}
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

        {{-- listing --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <button id="addToTable" class="btn btn-primary">Add <i class="fa fa-plus"></i></button>
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
                                        <th>Name</th>
                                        <th>Vehicle Name</th>
                                        <th>Fire Station Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicle_list as $list)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $list->vehicle_number }}</td>
                                            <td>{{ $list->vehicle_type }}</td>
                                            <td>{{ $list->name }}</td>
                                            <td>
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Vehicle Detail" data-id="{{ $list->vehicle_id }}"><i data-feather="edit"></i></button>
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vehicle Detail" data-id="{{ $list->vehicle_id }}"><i data-feather="trash-2"></i> </button>
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


{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('vehicle_details.store') }}',
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
                            window.location.href = '{{ route('vehicle_details.index') }}';
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
                    $("#editForm input[name='vehicle_type']").val(data.vehicle.vehicle_type);
                    $("#editForm select[name='fire_station_id']").val(data.vehicle.fire_station_id);
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
