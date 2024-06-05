@extends('template.template', ['title' => 'Attendance', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Employee Attendances</h3>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Timestamp</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($absences as $attendance)
                            <tr>
                                <td>{{ $attendance->id }}</td>
                                <td>{{ $attendance->user->name ?? '' }}</td>
                                <td>
                                    @if ($attendance->type == 'clock_in')
                                        <span>Clock In</span>
                                    @elseif ($attendance->type == 'forgot_clock_in')
                                        <span>Forgot Clock In</span>
                                    @elseif ($attendance->type == 'clock_out')
                                        <span>Clock Out</span>
                                    @else
                                        <span>Forgot Clock Out</span>
                                    @endif

                                    <span class="badge p-1 bg-{{ $attendance->late ? 'danger' : 'success' }}">
                                        {{ $attendance->late ? 'Late' : 'Present' }}
                                    </span>
                                </td>
                                <td>{{ $attendance->timestamp }}</td>
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
