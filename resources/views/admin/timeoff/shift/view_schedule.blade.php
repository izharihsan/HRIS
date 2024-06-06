@extends('template.template', ['title' => 'Shifts', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Shifts & Schedule</h3>
            <hr>
            <div>
                <h5>Shift Name: {{ $shifts->title }}</h5>
                <h5>Start Time: {{ $shifts->start_time }}</h5>
                <h5>End Time: {{ $shifts->end_time }}</h5>

                <h5>Schedules</h5>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible py-3" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <div class="alert-message">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('shifts.schedule.save') }}" method="POST">
                    <input type="hidden" name="shift_id" value="{{ $shifts->id }}">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Employees</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shifts->schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->day }}</td>
                                    <td>
                                        <div class="col-md-12 mb-4">
                                            <input type="hidden" name="id[]" value="{{ $schedule->id }}">
                                            <select id="" class="select2 form-select" multiple name="{{ $schedule->day }}[]">
                                                @foreach ($users as $employee)
                                                    <option value="{{ $employee->id }}" {{ in_array($employee->id, $schedule->user_ids) ? 'selected' : '' }}>{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="{{ route('shifts') }}" class="btn btn-secondary btn-lg">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
