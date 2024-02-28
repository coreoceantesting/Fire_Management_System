<x-admin.layout>
    <x-slot name="title">Expired Equipment</x-slot>
    <x-slot name="heading">Expired Equipment (कालबाह्य उपकरणे)</x-slot>


        <!-- Add Form -->
        <div class="row" id="addContainer" style="display:none;">
            <div class="col-sm-12">
                <div class="card">
                    <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="equipment_name"> Equipment Name(उपकरणाचे नाव) <span class="text-danger">*</span></label>
                                    <select class="form-control" id="equipment_name" name="equipment_name">
                                        <option value="">--Select Equipment--</option>
                                        @foreach($equipment_list as $list)
                                            <option value="{{$list->equipment_id}}">{{$list->equipment_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text equipment_name_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="available_quantity">Available Supplied Quantity(उपलब्ध पुरवठा केलेले प्रमाण) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="available_quantity" name="available_quantity" type="number" readonly>
                                    <span class="text-danger error-text available_quantity_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="quantity">Add Expired Quantity(कालबाह्य झालेले प्रमाण जोडा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="quantity" name="quantity" type="number" placeholder="Enter Quantity">
                                    <span class="text-danger error-text quantity_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="unit"> Select Unit(युनिट) <span class="text-danger">*</span></label>
                                    <select class="form-control" id="unit" name="unit">
                                        <option value="">--Select Unit--</option>
                                        <option value="nos">Nos</option>
                                        <option value="kg">KG</option>
                                    </select>
                                    <span class="text-danger error-text unit_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="remark">Remark(शेरा) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="remark" name="remark" type="text" placeholder="Enter Remark">
                                    <span class="text-danger error-text remark_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="date">Date(तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="date" name="date" value="{{now()->toDateString()}}" type="date" placeholder="Enter Date">
                                    <span class="text-danger error-text date_err"></span>
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
                                    <button id="addToTable" class="btn btn-primary">Add Expire Stock <i class="fa fa-plus"></i></button>
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
                                        <th>Equipment Name</th>
                                        <th>Total Expired/Returned Stock</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($equipment_list as $list)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $list->equipment_name }}</td>
                                            <td>{{ $list->total_expire_stock ?: '0' }}</td>
                                            <td>
                                                <button class="view-element btn btn-secondary px-2 py-1" title="View List" data-id="{{ $list->equipment_id }}"><i data-feather="list"></i></button>
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

        {{-- View equipment Stock List model --}}
        <div class="modal fade" id="viewStockModal" tabindex="-1" role="dialog" aria-labelledby="viewStockModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewStockModalLabel">View Expired/Returned Stock Details</h5>
                        <button type="button" class="close btn btn-secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Slip details will be displayed here -->
                        <div id="StockDetails"></div>
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
            url: '{{ route('store_expire_stock') }}',
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
                                    window.location.href = '{{ route('expire_stock') }}';
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
        // Event listener for "View Slip" button click
        $('.view-element').on('click', function() {
            var equipmentId = $(this).data('id');

            // Fetch slip details from the JSON endpoint
            $.ajax({
                url: '/view-expire-stock-list/' + equipmentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Generate HTML table with the predefined headers
                    var tableHtml = '';
                    if (data.equipment_expire_stock_list && data.equipment_expire_stock_list.length > 0) {
                    tableHtml += '<br><h3 class="text-center">Expire Stock List (कालबाह्य स्टॉक सूची) </h3><br>';
                    tableHtml += '<table id="stockTable" class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Equipment Name (उपकरणाचे नाव)</th>';
                    tableHtml += '<th scope="col">Date (तारीख)</th>';
                    tableHtml += '<th scope="col">Quantity / Unit (प्रमाण / युनिट)</th>';
                    tableHtml += '<th scope="col">Remark (शेरा)</th>';
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    // Loop through stock detail
                    data.equipment_expire_stock_list.forEach(function(list) {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + list.equipment_name + '</td>';
                        tableHtml += '<td>' + list.expire_equipment_date + '</td>';
                        tableHtml += '<td>' + list.expire_equipment_quantity + ' / ' + list.expire_equipment_unit + '</td>';
                        tableHtml += '<td>' + list.expire_equipment_remark + '</td>';
                        tableHtml += '</tr>';
                    });
                    tableHtml += '</tbody></table>';
                }else{
                    tableHtml += '<h3 class="text-center">No Stocks Expire Or Return </h3>';
                }

                    // Display table in the modal
                    $('#StockDetails').html(tableHtml);

                    // Initialize DataTable on the table
                    $('#stockTable').DataTable({
                        dom: '<"row"<"col-sm-4"l><"col-sm-4 text-left"f><"col-sm-4 mt-2"B>>rtip',
                        buttons: ["copy", "excel", "print"],
                        initComplete: function () {
                            $('.dt-buttons button').css('background-color', '#7758ae'); // Replace '#yourColor' with your desired background color
                            $('.dt-buttons button').css('border-color', '#7758ae'); // Optional: Change border color if needed
                            $('.dt-buttons button').css('color', '#fff'); // Optional: Change text color if needed
                        },
                    });
                    
                    // Show the modal
                    $('#viewStockModal').modal('show');
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

{{-- get available supplied stock --}}
<script>
    $(document).ready(function() {
        // Event listener for equipment name change
        $('#equipment_name').on('change', function() {
            var equipmentId = $(this).val();

            // Make an AJAX request to fetch the available quantity based on the selected equipment
            $.ajax({
                url: '/get-supplied-quantity/' + equipmentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the available quantity input field
                    $('#available_quantity').val(data.available_supplied_quantity);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

{{-- validation for available quntity --}}
<script>
    $(document).ready(function() {
        // Event listener for keyup on the quantity input field
        $('#quantity').on('keyup', function() {
            var quantity = parseInt($(this).val());
            var availableQuantity = parseInt($('#available_quantity').val());

            // Check if the entered quantity is greater than the available quantity
            if (quantity > availableQuantity) {
                $('.quantity_err').text('Entered quantity exceeds the available supplied quantity');
                $('#addSubmit').prop('disabled', true);
            }else if(quantity < 0){
                $('.quantity_err').text('Entered quantity must be greater than 0');
                $('#addSubmit').prop('disabled', true);
            } else {
                $('.quantity_err').text('');
                $('#addSubmit').prop('disabled', false);
            }
        });
    });
</script>
