@extends('template.template', ['title' => 'Attendance', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Employee Attendances</h3>
            <div class="card-datatable table-responsive pt-0 mt-3">
                <table class="datatables-basic table cell-border" id="datatables-basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Fullname</th>
                            <th>Check-In Time</th>
                            <th>Check-Out Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($absences as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $attendance->employee->name ?? '' }}</td>
                                <td>{{ explode(':', $attendance->start_time)[0] . ':' . explode(':', $attendance->start_time)[1] }}</td>
                                <td>{{ explode(':', $attendance->end_time)[0] . ':' . explode(':', $attendance->end_time)[1] }}</td>
                                <td>
                                    @if ($attendance->type == 'clock_in' || ($attendance->type == 'clock_out' && $attendance->late))
                                        <span class="badge p-1 bg-danger">Absen Masuk Terlambat</span>
                                    @elseif ($attendance->type == 'clock_in' || ($attendance->type == 'clock_out' && !$attendance->late))
                                        <span class="badge p-1 bg-success">Absen Masuk</span>
                                    @elseif ($attendance->type == 'forgot_clock_in' || $attendance->type == 'forgot_clock_out')
                                        <span class="badge p-1 bg-warning">Lupa Absen Masuk</span>
                                    @else
                                        <span class="badge p-1 bg-success">Absen Masuk</span>
                                    @endif
                                </td>
                                {{-- <td>{{ $attendance->created_at }}</td> --}}
                                <td>
                                    <a href="{{ route('attendance.detail', $attendance->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
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
