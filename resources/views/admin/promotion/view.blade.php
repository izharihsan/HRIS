@extends('template.template', ['title' => 'Promosi', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Promosi Karyawan</h3>
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-record"><i class="fas fa-plus me-1"></i> Buat Promosi</a>
            </div>
            {{-- show alert if has with success --}}
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
                            <th>Title</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Lampiran</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($promotions as $promosi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $promosi->employee->name ?? '' }}</td>
                                <td>{{ $promosi->title }}</td>
                                <td>{{ $promosi->description }}</td>
                                <td>{{ $promosi->promotion_date }}</td>
                                <td>
                                    <a href="{{ asset('image/employee_promotion/' . $promosi->attachment) }}" target="_blank">Lihat Lampiran</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit-record-{{ $promosi->id }}">Edit</button>

                                    <!-- Edit Record Modal -->
                                    <div class="modal fade text-left" id="edit-record-{{ $promosi->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-record-{{ $promosi->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('employee_promotion.update', $promosi->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-record-{{ $promosi->id }}">Edit Promosi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        {{-- select employees, input start_date, end_date, title, description, and attachment --}}
                                                        <div class="mb-3">
                                                            <label for="employee_id" class="form-label required">Nama Karyawan</label>
                                                            <select class="form-select" id="employee_id" name="employee_id" required>
                                                                <option value="">Pilih Karyawan</option>
                                                                @foreach ($employees as $employee)
                                                                    <option value="{{ $employee->id }}" {{ $employee->id == $promosi->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="title" class="form-label required">Title</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{ $promosi->title }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="description" class="form-label required">Deskripsi</label>
                                                            <textarea class="form-control" id="description" name="description" required>{{ $promosi->description }}</textarea>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="promotion_date" class="form-label required">Tanggal</label>
                                                            <input type="date" class="form-control" id="promotion_date" name="promotion_date" value="{{ $promosi->promotion_date }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="lampiran_promosi" class="form-label required">Lampiran</label>
                                                            <input type="file" class="form-control" id="lampiran_promosi" name="lampiran_promosi">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-record-{{ $promosi->id }}">Delete</button>

                                    <!-- Delete Record Modal -->
                                    <div class="modal fade text-left" id="delete-record-{{ $promosi->id }}" tabindex="-1" role="dialog" aria-labelledby="delete-record-{{ $promosi->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('employee_promotion.delete', $promosi->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-record-{{ $promosi->id }}">Hapus Perjalanan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p>Anda yakin ingin menghapus data perjalanan ini?</p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
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
    <div class="modal fade" id="add-new-record" tabindex="-1" role="dialog" aria-labelledby="add-new-record" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('employee_promotion.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-new-record">Form Promosi Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        {{-- select employees, input start_date, end_date, title, description, and attachment --}}
                        <div class="mb-3">
                            <label for="employee_id" class="form-label required">Nama Karyawan</label>
                            <select class="form-select" id="employee_id" name="employee_id" required>
                                <option value="">Pilih Karyawan</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label required">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label required">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="promotion_date" class="form-label required">Tanggal</label>
                            <input type="date" class="form-control" id="promotion_date" name="promotion_date" required>
                        </div>

                        <div class="mb-3">
                            <label for="lampiran_promosi" class="form-label required">Lampiran</label>
                            <input type="file" class="form-control" id="lampiran_promosi" name="lampiran_promosi" required>
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
