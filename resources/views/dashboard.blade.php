@extends('template.template', ['title' => 'Dashboards', 'is_active' => true])

@section('content')
    <style>
        .rounded {
            -webkit-border-radius: 3px !important;
            -moz-border-radius: 3px !important;
            border-radius: 3px !important;
        }

        .mini-stat {
            padding: 15px;
            margin-bottom: 20px;
        }

        .mini-stat-icon {
            width: 60px;
            height: 60px;
            display: inline-block;
            line-height: 60px;
            text-align: center;
            font-size: 30px;
            background: none repeat scroll 0% 0% #EEE;
            border-radius: 100%;
            float: left;
            margin-right: 10px;
            color: #FFF;
        }

        .mini-stat-info {
            font-size: 12px;
            padding-top: 2px;
        }

        .mini-stat-info span {
            display: block;
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 5px;
            margin-top: 7px;
        }

        /* ================ colors =====================*/
        .bg-facebook {
            background-color: #3b5998 !important;
            border: 1px solid #3b5998;
            color: white;
        }

        .fg-facebook {
            color: #3b5998 !important;
        }

        .bg-twitter {
            background-color: #00a0d1 !important;
            border: 1px solid #00a0d1;
            color: white;
        }

        .fg-twitter {
            color: #00a0d1 !important;
        }

        .bg-googleplus {
            background-color: #db4a39 !important;
            border: 1px solid #db4a39;
            color: white;
        }

        .fg-googleplus {
            color: #db4a39 !important;
        }

        .bg-bitbucket {
            background-color: #205081 !important;
            border: 1px solid #205081;
            color: white;
        }

        .fg-bitbucket {
            color: #205081 !important;
    </style>


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-3"><span class="fw-light">Dashboards</h4>

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-facebook rounded">
                    <span class="mini-stat-icon"><i class="fa fa-users fg-facebook"></i></span>
                    <div class="mini-stat-info">
                        <span>{{ $totalKaryawan }}</span>
                        Total Karyawan
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-twitter rounded">
                    <span class="mini-stat-icon"><i class="fa fa-male fg-twitter"></i></span>
                    <div class="mini-stat-info">
                        <span>{{ $totalKaryawanLakilaki }}</span>
                        Karyawan Laki - Laki
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="mini-stat clearfix bg-googleplus rounded">
                    <span class="mini-stat-icon"><i class="fa fa-female fg-googleplus"></i></span>
                    <div class="mini-stat-info">
                        <span>{{ $totalKaryawanPerempuan }}</span>
                        Karyawan Perempuan
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
