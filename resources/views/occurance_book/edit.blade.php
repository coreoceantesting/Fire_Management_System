<x-admin.layout>
    <x-slot name="title">Edit Occurrence Book</x-slot>
    <x-slot name="heading">Edit Occurrence Book (घटना पुस्तक संपादित करा)</x-slot>

    {{-- Occurrence Book Form --}}
    <div class="row" id="occurance-book">
        <div class="col-sm-12">
            <div class="card">
                <form class="theme-form" action="{{ route('update_occurance_book', $occurance_book_details->slip_id) }}" method="POST" name="occurance_book_store" id="store-occurance-book" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="slip_id_new" id="slip_id_new" value="{{ $occurance_book_details->slip_id }}">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="datetime_new">Date & Time (तारीख वेळ) <span class="text-danger">*</span></label>
                                <input class="form-control" id="datetime_new" name="datetime_new" type="datetime-local" value="{{ $occurance_book_details->occurance_book_date }}" required>
                                <span class="text-danger error-text datetime_new_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="description">Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Enter Description" required>{{ $occurance_book_details->occurance_book_description }}</textarea>
                                <span class="text-danger error-text description_err"></span>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" for="remark">Remark<span class="text-danger">*</span></label>
                                <input class="form-control" id="remark" name="remark" type="text" placeholder="Enter Remark" value="{{ $occurance_book_details->occurance_book_remark }}" required>
                                <span class="text-danger error-text remark_err"></span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label" for="photos">Upload Photo <span class="text-danger">*</span></label>
                                <input class="form-control" id="photos" name="photos[]" type="file" accept="image/*" multiple>
                                <span class="text-danger error-text photos_err"></span>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-success mt-5" id="add-more-photos">Add More Photos</button>
                            </div>
                        </div>
                        <div id="additional-photos"></div>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <label class="col-form-label">Existing Photos</label>
                                <div class="existing-photos">
                                    @foreach($occurance_book_images as $photo)
                                        <div class="photo-item">
                                            <img src="{{ asset('storage/'.$photo->photo_path) }}" alt="Photo" width="100">
                                            <button type="button" class="btn btn-danger btn-sm remove-photo" data-photo-id="{{ $photo->photo_id }}">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" id="occurancebookSubmit">Submit</button>
                        <a class="btn btn-primary" href="{{ route('action_taken_slips_list') }}">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin.layout>

<script>
    $(document).ready(function() {
        document.getElementById('add-more-photos').addEventListener('click', function() {
            var additionalPhotosDiv = document.getElementById('additional-photos');
            var newPhotoInput = document.createElement('div');
            newPhotoInput.className = 'mb-3 row';
            newPhotoInput.innerHTML = `
                <div class="col-md-4">
                    <input class="form-control" name="photos[]" type="file" accept="image/*" required>
                    <span class="text-danger error-text photos_err"></span>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-photo">Remove</button>
                </div>
            `;
            additionalPhotosDiv.appendChild(newPhotoInput);

            // Add event listener to the remove button
            newPhotoInput.querySelector('.remove-photo').addEventListener('click', function() {
                additionalPhotosDiv.removeChild(newPhotoInput);
            });
        });

        // Remove existing photo functionality
        $('.remove-photo').on('click', function() {
            var photoId = $(this).data('photo-id');
            $(this).parent('.photo-item').remove();
            $('<input>').attr({
                type: 'hidden',
                name: 'remove_photos[]',
                value: photoId
            }).appendTo('#store-occurance-book');
        });

        // Form submission handling
        $('#store-occurance-book').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        swal("Successful!", data.success, "success").then((action) => {
                            window.location.href = '{{ route('action_taken_slips_list') }}';
                        });
                    } else {
                        swal("Error!", data.error, "error");
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>