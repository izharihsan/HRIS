@extends('template.template', ['title' => 'Branch', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Branch</h3>
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-record"><i class="fas fa-plus me-1"></i> New Branch</a>
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
                            <th>Kode</th>
                            <th>Lokasi</th>
                            <th>Alamat</th>
                            <th>Telpon</th>
                            <th>Open Time</th>
                            <th>Close Time</th>
                            <th>Status</th>
                            <th>Open Holiday</th>
                            <th>Close Holiday</th>
                            <th>Hari Libur</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($branchs as $branch)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $branch->kode ?? '' }}</strong></td>
                                <td><strong>{{ $branch->lokasi }}</strong></td>
                                <td width="20%">{{ $branch->alamat }}</td>
                                <td>{{ $branch->telpon }}</td>
                                <td>{{ $branch->open_time }}</td>
                                <td>{{ $branch->close_time }}</td>
                                <td>
                                    <span class="text-{{ $branch->status ? 'success' : 'danger' }}">{{ $branch->status ? 'Aktif' : 'Tidak Aktif' }}</span>
                                </td>
                                <td>{{ $branch->open_holiday_time }}</td>
                                <td>{{ $branch->close_holiday_time }}</td>
                                <td>{{ $branch->hari_libur }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit-record-{{ $branch->id }}">Edit</button>

                                    <!-- Edit Record Modal -->
                                    <div class="modal fade text-left" id="edit-record-{{ $branch->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-record-{{ $branch->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('branch.update', $branch->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-record-{{ $branch->id }}">Edit Branch</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        {{-- kode, lokasi, alamat, telpon --}}
                                                        <div class="mb-3">
                                                            <label for="kode" class="form-label">Kode</label>
                                                            <input type="text" class="form-control" id="kode" name="kode" value="{{ $branch->kode }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="lokasi" class="form-label">Lokasi</label>
                                                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $branch->lokasi }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="telpon" class="form-label">Telpon</label>
                                                            <input type="text" class="form-control" id="telpon" name="telpon" value="{{ $branch->telpon }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="alamat" class="form-label">Alamat</label>
                                                            <textarea class="form-control" id="alamat" name="alamat" required>{{ $branch->alamat }}</textarea>
                                                        </div>

                                                        {{-- open_time, close_time, status --}}
                                                        <div class="mb-3">
                                                            <label for="open_time" class="form-label">Open Time</label>
                                                            <input type="time" class="form-control" id="open_time" name="open_time" value="{{ explode(' ', $branch->open_time)[0] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="close_time" class="form-label">Close Time</label>
                                                            <input type="time" class="form-control" id="close_time" name="close_time" value="{{ explode(' ', $branch->close_time)[0] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Status</label>
                                                            <select class="form-select" id="status" name="status" required>
                                                                <option value="1" {{ $branch->status ? 'selected' : '' }}>Aktif</option>
                                                                <option value="0" {{ !$branch->status ? 'selected' : '' }}>Tidak Aktif</option>
                                                            </select>
                                                        </div>

                                                        {{-- open_holiday_time, close_holiday_time, hari_libur --}}
                                                        <div class="mb-3">
                                                            <label for="open_holiday_time" class="form-label text-danger">Open Time Holiday</label>
                                                            <input type="time" class="form-control" id="open_holiday_time" name="open_holiday_time"
                                                                value="{{ explode(' ', $branch->open_holiday_time)[0] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="close_holiday_time" class="form-label text-danger">Close Time Holiday</label>
                                                            <input type="time" class="form-control" id="close_holiday_time" name="close_holiday_time"
                                                                value="{{ explode(' ', $branch->close_holiday_time)[0] }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="hari_libur" class="form-label text-danger">Hari Libur</label>
                                                            <input type="text" class="form-control" id="hari_libur" name="hari_libur" value="{{ $branch->hari_libur }}" required>
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


                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-record-{{ $branch->id }}">Delete</button>

                                    <!-- Delete Record Modal -->
                                    <div class="modal fade text-left" id="delete-record-{{ $branch->id }}" tabindex="-1" role="dialog" aria-labelledby="delete-record-{{ $branch->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('branch.delete', $branch->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-record-{{ $branch->id }}">Delete Branch</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p>Anda yakin ingin menghapus data cabang ini?</p>
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
                <form action="{{ route('branch.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-new-record">Add New Branch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        {{-- kode, lokasi, alamat, telpon --}}
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" required>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="telpon" class="form-label">Telpon</label>
                            <input type="text" class="form-control" id="telpon" name="telpon" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>

                        {{-- open_time, close_time, status --}}
                        <div class="mb-3">
                            <label for="open_time" class="form-label">Open Time</label>
                            <input type="time" class="form-control" id="open_time" name="open_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="close_time" class="form-label">Close Time</label>
                            <input type="time" class="form-control" id="close_time" name="close_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="1" selected>Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        {{-- open_holiday_time, close_holiday_time, hari_libur --}}
                        <div class="mb-3">
                            <label for="open_holiday_time" class="form-label text-danger">Open Time Holiday</label>
                            <input type="time" class="form-control" id="open_holiday_time" name="open_holiday_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="close_holiday_time" class="form-label text-danger">Close Time Holiday</label>
                            <input type="time" class="form-control" id="close_holiday_time" name="close_holiday_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="hari_libur" class="form-label text-danger">Hari Libur</label>
                            <input type="text" class="form-control" id="hari_libur" name="hari_libur" required>
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
