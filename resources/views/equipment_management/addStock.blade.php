<x-admin.layout>
    <x-slot name="title">Add In Stock</x-slot>
    <x-slot name="heading">Add In Stock (स्टॉक जोडा)</x-slot>


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
                                    <label class="col-form-label" for="date">Date(तारीख) <span class="text-danger">*</span></label>
                                    <input class="form-control" id="date" name="date" value="{{now()->toDateString()}}" type="date" placeholder="Enter Date">
                                    <span class="text-danger error-text date_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="quantity">quantity(प्रमाण) <span class="text-danger">*</span></label>
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
                                    <label class="col-form-label" for="work_order">Work Order(कामाचे आदेश)</label>
                                    <input class="form-control" id="work_order" name="work_order" type="file" placeholder="Upload Work Order">
                                    <span class="text-danger error-text work_order_err"></span>
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
                                    <button id="addToTable" class="btn btn-primary">Add Stock <i class="fa fa-plus"></i></button>
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
                                        <th>Total Stock</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($equipment_list as $list)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $list->equipment_name }}</td>
                                            <td>{{ $list->total_stock ?: '0' }}</td>
                                            <td>
                                                <button class="view-element btn btn-secondary px-2 py-1" title="View Slip" data-id="{{ $list->equipment_id }}"><i data-feather="info"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
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
                        <h5 class="modal-title" id="viewStockModalLabel">View Stock Details</h5>
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
            url: '{{ route('store_stock') }}',
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
                                    window.location.href = '{{ route('add_stock') }}';
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
                url: '/view-stock-list/' + equipmentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Generate HTML table with the predefined headers
                    var tableHtml = '';
                    if (data.equipment_stock_list && data.equipment_stock_list.length > 0) {
                    tableHtml += '<br><h3 class="text-center"> Stock List (स्टॉक यादी) </h3><br>';
                    tableHtml += '<table class="table table-bordered">';
                    tableHtml += '<thead><tr>';
                    tableHtml += '<th scope="col">Equipment Name (उपकरणाचे नाव)</th>';
                    tableHtml += '<th scope="col">Date (तारीख)</th>';
                    tableHtml += '<th scope="col">Quantity / Unit (प्रमाण / युनिट)</th>';
                    tableHtml += '<th scope="col">Work Order (कामाचे आदेश)</th>';
                    tableHtml += '</tr></thead>';
                    tableHtml += '<tbody>';
                    // Loop through stock detail
                    data.equipment_stock_list.forEach(function(list) {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + list.equipment_name + '</td>';
                        tableHtml += '<td>' + list.date + '</td>';
                        tableHtml += '<td>' + list.quantity + ' / ' + list.unit + '</td>';
                        tableHtml += '<td>';
                        if (list.work_order) {
                            // If work order exists, create a link or display the file name
                            tableHtml += '<a href="/storage/' + list.work_order + '" target="_blank">View Work Order</a>';
                        } else {
                            tableHtml += 'NA';
                        }
                        tableHtml += '</td>';
                        tableHtml += '</tr>';
                    });
                    tableHtml += '</tbody></table>';
                }else{
                    tableHtml += '<h3 class="text-center">No Stocks Added</h3>';
                }

                    // Display table in the modal
                    $('#StockDetails').html(tableHtml);
                    
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
