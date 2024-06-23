@extends('template.template', ['title' => 'Dashboards', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-3"><span class="fw-light">Dashboards</h4>
        <!-- Card Border Shadow -->
        <div class="row">
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-primary"><i
                                        class="ti ti-users-group ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $totalKaryawan }}</h4>
                        </div>
                        <p class="mb-1">Total Karyawan</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-info"><i class="ti ti-man ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $totalKaryawanLakilaki }}</h4>
                        </div>
                        <p class="mb-1">Karyawan Laki-laki</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="ti ti-woman ti-md"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $totalKaryawanPerempuan }}</h4>
                        </div>
                        <p class="mb-1">Karyawan Perempuan</p>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Card Border Shadow -->
        <div class="row">
            <!-- On route vehicles Table -->
            <div class="col-12 order-5">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">History Absensi</h5>
                        </div>
                    </div>

                    <div class="card-datatable table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Timestamp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absencesHistoryWithLimit as $attendance)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attendance->employee->name ?? '' }}</td>
                                        <td>
                                            @if ($attendance->type == 'clock_in')
                                                <span>Check In</span>
                                            @elseif ($attendance->type == 'forgot_clock_in')
                                                <span>Forgot Check In</span>
                                            @elseif ($attendance->type == 'clock_out')
                                                <span>Check Out</span>
                                            @else
                                                <span>Forgot Check Out</span>
                                            @endif

                                            <span class="badge p-1 bg-{{ $attendance->late ? 'danger' : 'success' }}">
                                                {{ $attendance->late ? 'Late' : 'Present' }}
                                            </span>
                                        </td>
                                        <td>{{ $attendance->timestamp }}</td>
                                        {{-- <td>{{ $attendance->created_at }}</td> --}}
                                        <td>
                                            <a href="{{ route('attendance.detail', $attendance->id) }}"
                                                class="btn btn-sm btn-outline-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--/ On route vehicles Table -->
        </div>
    </div>
@endsection
