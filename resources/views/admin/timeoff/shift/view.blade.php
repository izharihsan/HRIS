@extends('template.template', ['title' => 'Shifts', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Shifts</h3>
                <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> New Shift</a>
            </div>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Title</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($shifts as $shift)
                            <tr>
                                <td>{{ $shift->id }}</td>
                                <td>{{ $shift->title }}</td>
                                <td>{{ $shift->start_time }}</td>
                                <td>{{ $shift->end_time }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#add-new-record">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#add-new-record">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ DataTable with Buttons -->
@endsection
