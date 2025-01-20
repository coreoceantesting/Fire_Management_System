<x-admin.layout>
    <x-slot name="title">Add Equipments</x-slot>
    <x-slot name="heading">Add Equipments (उपकरणे जोडा)</x-slot>

    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" name="addForm" id="addForm" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="mb-3 row">
                            <input type="hidden" name="vechicle_id" value="{{ $id }}">
                            <div class="col-md-4">
                                <label class="col-form-label" for="position">Position ( पद ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="position" name="position" type="text" placeholder="Enter Position Name" required>
                                <span class="text-danger error-text position_err"></span>
                            </div>
                        </div>
                        <div id="equipmentFields">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Equipment Name ( पद )</th>
                                        <th>Quantity ( प्रमाण )</th>
                                        <th><button type="button" class="btn btn-primary btn-sm" id="addMoreBtn"><i class="fa fa-plus" aria-hidden="true"></i> Add More</button></th>
                                    </tr>
                                </thead>
                                <tbody id="equipmentRows">
                                    <tr>
                                        <td><input class="form-control" id="equipment_name" name="equipment_name[]" type="text" placeholder="Enter Equipment Name" required></td>
                                        <td><input class="form-control" id="quantity" name="quantity[]" type="number" placeholder="Enter quantity" required></td>
                                        <td><button type="button" class="btn btn-danger btn-sm removeRowBtn" >Remove</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="addSubmit">Submit</button>
                        {{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin.layout>

<script>
    document.getElementById('addMoreBtn').addEventListener('click', function() {
        // Get the table body element where new rows will be added
        const equipmentRows = document.getElementById('equipmentRows');
        
        // Create a new row element
        const newRow = document.createElement('tr');
        
        // Set the content for the new row
        newRow.innerHTML = `
            <td><input class="form-control" name="equipment_name[]" type="text" placeholder="Enter Equipment Name"></td>
            <td><input class="form-control" name="quantity[]" type="number" placeholder="Enter quantity"></td>
            <td><button type="button" class="btn btn-danger btn-sm removeRowBtn">Remove</button></td>
        `;
        
        // Append the new row to the table body
        equipmentRows.appendChild(newRow);
    });

    // Event delegation to handle remove button clicks
    document.getElementById('equipmentFields').addEventListener('click', function(event) {
        if (event.target.classList.contains('removeRowBtn')) {
            const rows = document.querySelectorAll('#equipmentRows tr');
            
            // Prevent removal if there's only one row left
            if (rows.length > 1) {
                event.target.closest('tr').remove();  // Remove the row
            } else {
                alert("At least one row must remain.");
            }
        }
    });

</script>
{{-- Add --}}
<script>
    $("#addForm").submit(function(e) {
        e.preventDefault();
        $("#addSubmit").prop('disabled', true);

        var formdata = new FormData(this);
        $.ajax({
            url: '{{ route('store_equipment_details') }}',
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