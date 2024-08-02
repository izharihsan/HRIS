@extends('template.template', ['title' => 'Approval Permission', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Approval Permission</h3>
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
                                <td>
                                    <center>{{ $loop->iteration }}<center>
                                </td>
                                <td>{{ $employee->name ?? '' }}</td>
                                <td>
                                    <center>{{ $employee->nik }}</center>
                                </td>
                                <td>
                                    <center>
                                        @if ($employee->jenis_kelamin == 'PEREMPUAN')
                                            <span class="py-1 px-2 rounded-full text-xs bg-success text-white cursor-pointer font-medium">Perempuan</span>
                                        @else
                                            <span class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Laki - Laki</span>
                                        @endif
                                    </center>
                                </td>
                                {{-- <td>{{ ucfirst(strtolower($employee->jenis_kelamin)) }}</td> --}}
                                <td>
                                    <center>{{ $employee->branch->lokasi }}</center>
                                </td>
                                <td>
                                    <center>
                                        @if ($employee->status == 'Aktif')
                                            <span class="text-success">Aktif</span>
                                        @else
                                            <span class="text-danger">Tidak Aktif</span>
                                        @endif
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        {{-- button modal 'ubah permission' with icon key --}}
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#permissionModal{{ $employee->id }}">
                                            <i class="fas fa-key me-1"></i> Ubah Permission
                                        </button>
                                    </center>

                                    {{-- modal 'ubah permission' --}}
                                    <div class="modal fade text-left" id="permissionModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="permissionModal{{ $employee->id }}Label"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="permissionModal{{ $employee->id }}Label">Ubah Permission</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('approval_permission.update', $employee->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body text-center">
                                                        <p>Ceklist permission yang diinginkan</p>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2">Approval Permission</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-start">Approval Reimbursement</td>
                                                                    <td>
                                                                        <input type="checkbox" name="approval_reimbursement" id="approval_reimbursement">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-start">Approval Cuti</td>
                                                                    <td>
                                                                        <input type="checkbox" name="approval_cuti" id="approval_cuti">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Ubah Permission</button>
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
@endsection
