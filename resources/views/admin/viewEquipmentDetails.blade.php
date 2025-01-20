<x-admin.layout>
    <x-slot name="title">Equipments Details</x-slot>
    <x-slot name="heading">Equipments Details (उपकरणांची माहिती)</x-slot>

    <div class="row" id="addContainer">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Position</th>
                                <th>Equipment Name</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0 )
                                @foreach ($data as $position => $groupedData)
                                    <tr>
                                        <td rowspan="{{ $groupedData->count() + 1 }}" class="text-center font-weight-bold">
                                            {{ $position }}
                                        </td>
                                    </tr>
                                    @foreach ($groupedData as $item)
                                        <tr>
                                            <td>{{ $item->equipment_name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center font-weight-bold">
                                        No Data Found
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
