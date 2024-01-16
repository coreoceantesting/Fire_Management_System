<x-admin.layout>
    <x-slot name="title">Driver Details</x-slot>
    <x-slot name="heading">Driver Details</x-slot>
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
                                    <label class="col-form-label" for="driver_name">Driver Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="driver_name" name="driver_name" type="text" placeholder="Enter Driver Name">
                                    <span class="text-danger error-text driver_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_id"> Select Vehicle <span class="text-danger">*</span></label>
                                    <select class="form-control" id="vehicle_id" name="vehicle_id">
                                        <option value="">--Select Vehicle--</option>
                                        @foreach($vehicle_list as $list)
                                            <option value="{{ $list->vehicle_id }}">{{ $list->vehicle_number }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text vehicle_id_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="driver_mob_no">Driver Mobile No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="driver_mob_no" name="driver_mob_no" type="text" placeholder="Enter Driver Mobile Number">
                                    <span class="text-danger error-text driver_mob_no_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="driver_gender"> Select Gender <span class="text-danger">*</span></label>
                                    <select class="form-control" id="driver_gender" name="driver_gender">
                                        <option value="">--Select Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <span class="text-danger error-text driver_gender_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="driver_job_status"> Select Job Status <span class="text-danger">*</span></label>
                                    <select class="form-control" id="driver_job_status" name="driver_job_status">
                                        <option value="">--Select Job Status--</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Temporary">Temporary</option>
                                    </select>
                                    <span class="text-danger error-text driver_job_status_err"></span>
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
                            <h4 class="card-title">Edit Driver Details</h4>
                        </header>

                        <div class="card-body py-2">

                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="driver_name">Driver Name <span class="text-danger">*</span></label>
                                    <input class="form-control" id="driver_name" name="driver_name" type="text" placeholder="Enter Driver Name">
                                    <span class="text-danger error-text driver_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="vehicle_id"> Select Vehicle <span class="text-danger">*</span></label>
                                    <select class="form-control" id="vehicle_id" name="vehicle_id">
                                        <option value="">--Select Vehicle--</option>
                                        @foreach($vehicle_list as $list)
                                            <option value="{{ $list->vehicle_id }}">{{ $list->vehicle_number }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text vehicle_id_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="driver_mob_no">Driver Mobile No <span class="text-danger">*</span></label>
                                    <input class="form-control" id="driver_mob_no" name="driver_mob_no" type="text" placeholder="Enter Driver Mobile Number">
                                    <span class="text-danger error-text driver_mob_no_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="driver_gender"> Select Gender <span class="text-danger">*</span></label>
                                    <select class="form-control" id="driver_gender" name="driver_gender">
                                        <option value="">--Select Gender--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <span class="text-danger error-text driver_gender_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="driver_job_status"> Select Job Status <span class="text-danger">*</span></label>
                                    <select class="form-control" id="driver_job_status" name="driver_job_status">
                                        <option value="">--Select Job Status--</option>
                                        <option value="Permanent">Permanent</option>
                                        <option value="Temporary">Temporary</option>
                                    </select>
                                    <span class="text-danger error-text driver_job_status_err"></span>
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
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Job Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drivers_list as $list)
                                        <tr>
                                            <td>{{ $list->driver_name }}</td>
                                            <td>{{ $list->driver_mob_no }}</td>
                                            <td>{{ $list->driver_job_status }}</td>
                                            <td>
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Vehicle Detail" data-id="{{ $list->driver_id }}"><i data-feather="edit"></i></button>
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Vehicle Detail" data-id="{{ $list->driver_id }}"><i data-feather="trash-2"></i> </button>
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
            url: '{{ route('driver_details.store') }}',
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
                            window.location.href = '{{ route('driver_details.index') }}';
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
        var url = "{{ route('driver_details.edit', ":model_id") }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.driver_detail.driver_id);
                    $("#editForm input[name='driver_name']").val(data.driver_detail.driver_name);
                    $("#editForm select[name='vehicle_id']").val(data.driver_detail.vehicle_id);
                    $("#editForm select[name='driver_gender']").val(data.driver_detail.driver_gender);
                    $("#editForm select[name='driver_job_status']").val(data.driver_detail.driver_job_status);
                    $("#editForm input[name='driver_mob_no']").val(data.driver_detail.driver_mob_no);
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
            var url = "{{ route('driver_details.update', ":model_id") }}";
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
                                window.location.href = '{{ route('driver_details.index') }}';
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
