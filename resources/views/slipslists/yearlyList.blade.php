<x-admin.layout>
    <x-slot name="title">Yearly Slip List</x-slot>
    <x-slot name="heading">Yearly Slip List</x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}

        {{-- Listing Table --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <form action="{{ route('yearly_slips_filter') }}" method="GET" class="row">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="start-date">Start Date</label>
                                        <input required type="date" class="form-control" name="start_date" id="start-date" @if(request()->has('start_date')) value="{{ request('start_date') }}" @endif>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="end-date">End Date</label>
                                        <input required type="date" class="form-control" name="end_date" id="end-date" @if(request()->has('end_date')) value="{{ request('end_date') }}" @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="status" class="control-label">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="">---Select Status---</option>
                                            <option value="Pending" @if(request('status') == 'Pending') selected @endif>Pending</option>
                                            <option value="Action Form Submitted" @if(request('status') == 'Action Form Submitted') selected @endif>Action Form Submitted</option>
                                            <option value="Occurrence Book Submitted" @if(request('status') == 'Occurrence Book Submitted') selected @endif>Occurrence Book Submitted</option>
                                            <option value="Vardi Ahval Submitted" @if(request('status') == 'Vardi Ahval Submitted') selected @endif>Vardi Ahval Submitted</option>
                                            <option value="Additional Help Submitted" @if(request('status') == 'Additional Help Submitted') selected @endif>Additional Help Submitted</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3" style="margin-top: 43px;">
                                        <button type="submit" id="apply-filter" class="btn btn-primary">Apply Filter</button>
                                        <a class="btn btn-success" href="{{ route('yearly_list') }}">Clear</a>
                                    </div>
                                </div>
                            </form>
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

