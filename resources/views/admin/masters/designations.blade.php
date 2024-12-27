<x-admin.layout>
    <x-slot name="title">Staff Details</x-slot>
    <x-slot name="heading">Staff Details (कर्मचारी तपशील)</x-slot>
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
                                    <label class="col-form-label" for="worker_name">Staff Name(कामगाराचे नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="worker_name" name="worker_name" type="text" placeholder="Enter Worker Name">
                                    <span class="text-danger error-text worker_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="designation_name">Designation Name(पदनाम नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="designation_name" name="designation_name" type="text" placeholder="Enter Designation Name">
                                    <span class="text-danger error-text designation_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="designation_initial">Initial(आरंभिक) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="designation_initial" name="designation_initial" type="text" placeholder="Enter Designation Initial">
                                    <span class="text-danger error-text designation_initial_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="fire_station">Fire Station (अग्निशमन केंद्र)<span class="text-danger">*</span></label>
                                    <select class="form-control" name="fire_station" id="fire_station">
                                        <option value="">Select Option</option>
                                        @foreach ($fire_stations as $list)
                                            <option value="{{$list->fire_station_id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text fire_station_err"></span>
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
                            <h4 class="card-title">Edit Staff Details</h4>
                        </header>

                        <div class="card-body py-2">

                            <input type="hidden" id="edit_model_id" name="edit_model_id" value="">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="worker_name">Staff Name(कर्मचारी नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="worker_name" name="worker_name" type="text" placeholder="Enter Worker Name">
                                    <span class="text-danger error-text worker_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="designation_name">Designation Name(पदनाम नाव) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="designation_name" name="designation_name" type="text" placeholder="Enter Designation Name">
                                    <span class="text-danger error-text designation_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="designation_initial">Designation Initial(पदनाम आरंभिक) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="designation_initial" name="designation_initial" type="text" placeholder="Enter Designation Initial">
                                    <span class="text-danger error-text designation_initial_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="fire_station">Fire Station (अग्निशमन केंद्र)<span class="text-danger">*</span></label>
                                    <select class="form-control" name="fire_station" id="fire_station">
                                        <option value="">Select Option</option>
                                        @foreach ($fire_stations as $list)
                                            <option value="{{$list->fire_station_id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text fire_station_err"></span>
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
                    @php
                        $serialNumber = 1;
                    @endphp
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Staff Name</th>
                                        <th>Designation</th>
                                        <th>Fire Station Name</th>
                                        <th>Initial</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($designation_list as $list)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $list->worker_name }}</td>
                                            <td>{{ $list->designation_name }}</td>
                                            <td>{{ $list->fire_station_name ?? 'NA' }}</td>
                                            <td>{{ $list->designation_initial }}</td>
                                            <td>
                                                <button class="edit-element btn btn-secondary px-2 py-1" title="Edit Designation" data-id="{{ $list->designation_id }}"><i data-feather="edit"></i></button>
                                                <button class="btn btn-danger rem-element px-2 py-1" title="Delete Designation" data-id="{{ $list->designation_id }}"><i data-feather="trash-2"></i> </button>
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
            url: '{{ route('designations.store') }}',
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
                            window.location.href = '{{ route('designations.index') }}';
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
        var url = "{{ route('designations.edit', ":model_id") }}";

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
                    $("#editForm input[name='edit_model_id']").val(data.designation.designation_id);
                    $("#editForm input[name='worker_name']").val(data.designation.worker_name);
                    $("#editForm input[name='designation_name']").val(data.designation.designation_name);
                    $("#editForm input[name='designation_initial']").val(data.designation.designation_initial);
                    $("#editForm select[name='fire_station']").val(data.designation.fire_station);
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
            var url = "{{ route('designations.update', ":model_id") }}";
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
                                window.location.href = '{{ route('designations.index') }}';
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
            title: "Are you sure to delete this designation?",
            // text: "Make sure if you have filled Vendor details before proceeding further",
            icon: "info",
            buttons: ["Cancel", "Confirm"]
        })
        .then((justTransfer) =>
        {
            if (justTransfer)
            {
                var model_id = $(this).attr("data-id");
                var url = "{{ route('designations.destroy', ":model_id") }}";

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
