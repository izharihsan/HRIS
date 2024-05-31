@extends('template.template', ['title' => 'Schedule', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Schedules</h3>
                <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> New Schedule</a>
            </div>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->id }}</td>
                                <td>{{ $schedule->user->name }}</td>
                                <td>{{ Carbon\Carbon::parse($schedule->date)->format('d-m-Y') }}</td>
                                <td>{{ $schedule->shift->title }}</td>
                                <td>
                                    @if ($schedule->absence_id != null)
                                        <span class="badge bg-success">Attend</span>
                                    @elseif (Carbon\Carbon::parse($schedule->date)->isToday())
                                        <span class="badge bg-danger">Pending</span>
                                    @else
                                        <span class="badge bg-warning">Not Attend</span>
                                    @endif
                                </td>
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
