@extends('template.template', ['title' => 'Schedule', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Schedules</h3>
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-record"><i class="fas fa-plus me-1"></i> New Schedule</a>
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
                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#edit-record-{{ $schedule->id }}">Edit</button>

                                    <!-- Edit Record Modal -->
                                    <div class="modal fade text-left" id="edit-record-{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-record-{{ $schedule->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-record-{{ $schedule->id }}">Edit Schedule</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <div class="mb-3">
                                                            <label for="user_id" class="form-label">User</label>
                                                            <select class="form-select" id="user_id" name="user_id" required>
                                                                <option value="">Select User</option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $schedule->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date" class="form-label">Date</label>
                                                            <input type="date" class="form-control" id="date" name="date" value="{{ $schedule->date }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="shift_id" class="form-label">Shift</label>
                                                            <select class="form-select" id="shift_id" name="shift_id" required>
                                                                <option value="">Select Shift</option>
                                                                @foreach ($shifts as $shift)
                                                                    <option value="{{ $shift->id }}" {{ $schedule->shift_id == $shift->id ? 'selected' : '' }}>{{ $shift->title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-record-{{ $schedule->id }}">Delete</button>

                                    <!-- Delete Record Modal -->
                                    <div class="modal fade text-left" id="delete-record-{{ $schedule->id }}" tabindex="-1" role="dialog" aria-labelledby="delete-record-{{ $schedule->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('schedules.delete', $schedule->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-record-{{ $schedule->id }}">Delete Schedule</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p>Are you sure you want to delete this schedule?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add New Record Modal -->
    <div class="modal fade text-left" id="add-new-record" tabindex="-1" role="dialog" aria-labelledby="add-new-record" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-new-record">Add New Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User</label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="shift_id" class="form-label">Shift</label>
                            <select class="form-select" id="shift_id" name="shift_id" required>
                                <option value="">Select Shift</option>
                                @foreach ($shifts as $shift)
                                    <option value="{{ $shift->id }}">{{ $shift->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--/ DataTable with Buttons -->
@endsection
