@extends('template.template', ['title' => 'Employee List', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Employee List</h3>
                <div>
                    <a href="{{ route('employee.import-gaji') }}" class="btn btn-primary"><i class="fas fa-download me-1"></i> Import Gaji</a>
                    <a href="{{ route('employee.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i> New Employee</a>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible mt-3" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <div class="card-datatable table-responsive pt-0 mt-3">
                <table class="datatables-basic table cell-border" id="datatables-basic">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>NIK</th>
                            <th>Jenis Kelamin</th>
                            <th>Cabang</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td><center>{{ $loop->iteration }}<center></td>
                                <td>{{ $employee->name ?? '' }}</td>
                                <td><center>{{ $employee->nik }}</center></td>
                                <td><center>
                                    @if ($employee->jenis_kelamin == 'PEREMPUAN')
                                        <span class="py-1 px-2 rounded-full text-xs bg-success text-white cursor-pointer font-medium">Perempuan</span>
                                    @else
                                        <span class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Laki - Laki</span>
                                    @endif </center>
                                </td>
                                {{-- <td>{{ ucfirst(strtolower($employee->jenis_kelamin)) }}</td> --}}
                                <td><center>{{ $employee->branch->lokasi }}</center></td>
                                <td><center>
                                    @if ($employee->status == 'Aktif')
                                        <span class="text-success">Aktif</span>
                                    @else
                                        <span class="text-danger">Tidak Aktif</span>
                                    @endif </center>
                                </td>
                                <td><center>
                                    <a href="{{ route('employee.detail', $employee->id) }}" class="btn btn-sm btn-primary">Detail</a></center>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
