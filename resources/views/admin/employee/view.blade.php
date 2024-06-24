@extends('template.template', ['title' => 'Employee List', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Employee List</h3>
                <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus me-1"></i> New Employee</a>
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
                        <tr>
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
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->name ?? '' }}</td>
                                <td>{{ $employee->nik }}</td>
                                <td>{{ ucfirst(strtolower($employee->jenis_kelamin)) }}</td>
                                <td>{{ $employee->branch->lokasi }}</td>
                                <td>
                                    @if ($employee->status == 'Aktif')
                                        <span class="text-success">Aktif</span>
                                    @else
                                        <span class="text-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('employee.detail', $employee->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
