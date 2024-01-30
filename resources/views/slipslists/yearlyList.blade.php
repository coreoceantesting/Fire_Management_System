<x-admin.layout>
    <x-slot name="title">Yearly Slip List</x-slot>
    <x-slot name="heading">Yearly Slip List</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        {{-- Listing Table --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @php
                        $serialNumber = 1;
                    @endphp
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="buttons-datatables" class="table table-bordered nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Caller Name</th>
                                        <th>Caller Mobile Number</th>
                                        <th>Date</th>
                                        <th>Slip Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($yearlySlipList as $list)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $list->caller_name }}</td>
                                            <td>{{ $list->caller_mobile_no }}</td>
                                            <td>{{ $list->slip_date }}</td>
                                            <td>{{ $list->slip_status }}</td>
                                            <td>
                                                @can('actionpermissions.download_generate_slip')
                                                <button class="download-pdf btn btn-secondary px-2 py-1"
                                                        title="Download PDF"
                                                        data-id="{{ $list->slip_id }}"
                                                        data-pdf-file-name="{{ $list->pdf_name }}"
                                                >
                                                    <i data-feather="download"></i>
                                                </button>
                                                @endcan
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

</x-admin.layout>


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

