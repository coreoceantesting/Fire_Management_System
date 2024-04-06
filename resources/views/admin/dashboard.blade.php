<x-admin.layout>
    <style>
        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
    
        .blink {
            animation: blink 1s infinite;
        }
    </style>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="heading">Dashboard (डॅशबोर्ड) </x-slot>
    {{-- <x-slot name="subheading">Test</x-slot> --}}


    {{-- new dashboard --}}
    <div class="row">
        <div class="col-xl-6">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="card card-animate" id="totalSlipsCardNew">
                            <div class="card-body" style="background-color: papayawhip">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b>Total Slips (एकूण स्लिप्स)</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{$totalSlipCount}}">{{$totalSlipCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0"><i class="ri-arrow-up-line align-middle"></i>
                                                16.24 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="award" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!--end col-->
                    <div class="col-xl-6 col-md-6">
                        <!-- card -->
                        <div class="card card-animate" id="todaySlipsCardNew">
                            <div class="card-body" style="background-color: deepskyblue">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b>Today's Slips (आजच्या स्लिप्स)</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{$todaysSlipCount}}">{{$todaysSlipCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0"><i class="ri-arrow-up-line align-middle"></i>
                                                16.24 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="award" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                    <div class="col-xl-6 col-md-6">
                        <!-- card -->
                        <div class="card card-animate" id="monthlySlipsCardNew">
                            <div class="card-body" style="background-color: mistyrose">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                           <b> Montly Slips (मासिक स्लिप्स)</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{$monthlySlipCount}}">{{$monthlySlipCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i>
                                                3.96 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="box" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                    <div class="col-xl-6 col-md-6">
                        <!-- card -->
                        <div class="card card-animate" id="yearlySlipsCardNew">
                            <div class="card-body" style="background-color: skyblue">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b>Yearly Slips (वार्षिक स्लिप्स)</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{$yearlySlipCount}}">{{$yearlySlipCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-danger mb-0">
                                                <i class="ri-arrow-down-line align-middle"></i>
                                                0.24 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="list" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                    <div class="col-xl-6 col-md-6">
                        {{-- card --}}
                        <div class="card card-animate" id="actiontakenSlipsNew" style="background-color: lemonchiffon">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b>Action Taken Slips(कारवाई केलेल्या स्लिप्स)</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{$actionTakenSlipCount}}">{{$actionTakenSlipCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                7.05 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="external-link" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!--end col-->
                    <div class="col-xl-6 col-md-6">
                        <!-- card -->
                        <div class="card card-animate" id="vardiahavalSlipsCardNew">
                            <div class="card-body" style="background-color: paleturquoise">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a class="fw-medium text-dark mb-0">
                                            <b>Vardi Ahaval(वर्दी अहवाल)</b>
                                        </a>
                                        <h2 class="mt-4 ff-secondary fw-semibold">
                                            <span class="counter-value text-primary" data-target="{{$vardiAhavalSlipCount}}">{{$vardiAhavalSlipCount}}</span>
                                        </h2>
                                        <p class="mb-0 text-muted" style="display: none">
                                            <span class="badge bg-light text-success mb-0">
                                                <i class="ri-arrow-up-line align-middle"></i>
                                                7.05 %
                                            </span>
                                            vs. previous
                                            month
                                        </p>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0 d-none">
                                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                <i data-feather="file-text" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card-->
                    </div><!-- end col -->
                </div><!--end row-->
            </div>
        </div><!--end col-->

        <div class="col-xl-6">
            <div class="card border-primary card-height-100">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">Today's List (आजची यादी)</h4>
                    <div class="flex-shrink-0">
                        <a href="{{route('todays_list')}}" class="btn btn-soft-primary btn-sm">
                            View All
                        </a>
                    </div>
                </div><!-- end card header -->
                <!-- card body -->
                <div class="card-body">
                    @php
                        $serialNumber = 1;
                    @endphp
                    <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                    <div class="table-responsive">
                        <table id="todaysListNew" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Caller Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todaysSlipList as $list)
                                    <tr>
                                        <td>{{ $serialNumber++ }}</td>
                                        <td>{{ $list->caller_name }}</td>
                                        <td>{{ $list->slip_date }}</td>
                                        <td>
                                            <button class="download-pdf btn btn-secondary px-2 py-1"
                                                    title="Download PDF"
                                                    data-id="{{ $list->slip_id }}"
                                                    data-pdf-file-name="{{ $list->pdf_name }}"
                                            >
                                                <i data-feather="download"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div> <!-- .card-->
        </div><!--end col-->

        <div class="col-xl-6">
            <div class="card border-primary card-height-100" style="display: block">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">
                        Equipments Stock Details (उपकरणे स्टॉक तपशील)
                    </h4>
                    <div>
                        <a href="{{route('overall_stock_detail')}}" class="btn btn-soft-secondary btn-sm">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $serialNumber = 1;
                    @endphp
                    <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                    <div class="table-responsive">
                        <table id="stockDetailsNew" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Equipment</th>
                                    {{-- <th>Total Stock</th> --}}
                                    <th>Remaining Stock</th>
                                    <th>InProcess Stock</th>
                                    <th>Expire Stock</th>
                                    {{-- <th>Overall Supply Stock</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipment_list as $list)
                                    <tr>
                                        <td>{{ $serialNumber++ }}</td>
                                        <td>{{ $list->equipment_name }}</td>
                                        {{-- <td>{{ $list->total_stock ?: '0' }}</td> --}}
                                        <td>{{ $list->total_stock - $list->total_supply_quantity ?: '0' }}</td>
                                        <td>{{ $list->total_supply_quantity - $list->total_expire_quantity ?: '0' }}</td>
                                        <td>{{ $list->total_expire_quantity ?: '0' }}</td>
                                        {{-- <td>{{ $list->total_supply_quantity ?: '0' }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div><!--end col-->

        <div class="col-xl-6">
            <div class="card border-primary card-height-100" style="display: block">
                <div class="card-header bg-primary align-items-center d-flex">
                    <h4 class="card-title text-white mb-0 flex-grow-1">
                        Vehicle History (वाहन इतिहास)
                    </h4>
                    <div>
                        <a href="{{route('add_vechicle_details')}}" class="btn btn-soft-secondary btn-sm">
                            View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $serialNumber = 1;
                    @endphp
                    <div id="users-by-country" data-colors='["--vz-light"]' class="text-center d-none" style="height: 252px"></div>

                    <div class="table-responsive">
                        <table id="vehicledetails" class="table table-bordered nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Vehicle Name</th>
                                    <th>Vehicle Number</th>
                                    <th>PUC Expire Date</th>
                                    <th>Insurance Expire Date</th>
                                    <th>Fitness Expire Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicle_history_details as $list)
                                    <tr>
                                        <td>{{ $serialNumber++ }}</td>
                                        <td>{{ $list->vehicle_name }}</td>
                                        <td>{{ $list->vehicle_no }}</td>
                                        <td>{{ $list->puc_end_date }}</td>
                                        <td>{{ $list->insurance_end_date }}</td>
                                        <td>{{ $list->vehicle_fitness_end_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div><!--end col-->




    </div><!--end row-->

    @push('scripts')
    <script>
        $(document).ready(function() {

            $('#todaySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('todays_list') }}";
            });

            $('#monthlySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('monthly_list') }}";
            });

            $('#yearlySlipsCardNew').on('click', function() {
                window.location.href = "{{ route('yearly_list') }}";
            });

            $('#actiontakenSlipsNew').on('click', function() {
                window.location.href = "{{ route('action_taken_list') }}";
            });

            $('#vardiahavalSlipsCardNew').on('click', function() {
                window.location.href = "{{ route('vardi_ahaval_list') }}";
            });

            $('#totalSlipsCardNew').on('click', function() {
                window.location.href = "{{ route('slips_list') }}";
            });

            $('#todaysListNew,#stockDetailsNew,#vehicledetails').dataTable({searching: false, paging: false, info: false});

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


    {{-- blink date if documents expire within 10 days --}}
    <script>
        $(document).ready(function() {
            var currentDate = new Date();

            $('#vehicledetails tbody tr').each(function() {
                var pucEndDate = new Date($(this).find('td:nth-child(4)').text()); // Adjust the index based on your table structure

                // Calculate the difference in days
                var timeDiff = pucEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(4)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink'); // Add class for styling
                }
            });

            $('#buttons-datatables tbody tr').each(function() {
                var insuranceEndDate = new Date($(this).find('td:nth-child(5)').text()); // Adjust the index based on your table structure

                // Calculate the difference in days
                var timeDiff = insuranceEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(5)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink'); // Add class for styling
                }
            });

            $('#buttons-datatables tbody tr').each(function() {
                var fitnessEndDate = new Date($(this).find('td:nth-child(6)').text()); // Adjust the index based on your table structure

                // Calculate the difference in days
                var timeDiff = fitnessEndDate.getTime() - currentDate.getTime();
                var daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                if (daysDiff <= 10 && daysDiff >= 0) {
                    $(this).find('td:nth-child(6)').addClass('text-danger blink');
                    $(this).find('td:nth-child(2)').addClass('text-danger blink');
                    $(this).find('td:nth-child(3)').addClass('text-danger blink'); // Add class for styling
                }
            });

        });
    </script>



    @endpush

</x-admin.layout>
