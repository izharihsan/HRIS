@extends('template.template', ['title' => 'Tipe Cuti', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <div class="d-flex justify-content-between">
                <h3>Tipe Cuti</h3>
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-new-record"><i class="fas fa-plus me-1"></i> Add Tipe Cuti</a>
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
                            <th>Tipe Cuti</th>
                            <th>Periode</th>
                            <th>Kuota</th>
                            <th>Wajib Lampiran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($masterTimeoffs as $tipe_cuti)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tipe_cuti->name ?? '' }}</td>
                                <td>{{ $tipe_cuti->periode }}</td>
                                <td>{{ $tipe_cuti->kuota }}</td>
                                <td>{{ $tipe_cuti->is_attachment_required ? 'Yes ' . '(' . $tipe_cuti->attachment_required_in_days . ' Hari)' : 'No' }}</td>
                                <td>{{ $tipe_cuti->status }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#edit-record-{{ $tipe_cuti->id }}">Edit</button>

                                    <!-- Edit Record Modal -->
                                    <div class="modal fade text-left" id="edit-record-{{ $tipe_cuti->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-record-{{ $tipe_cuti->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('master.tipe_cuti.update', $tipe_cuti->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-record-{{ $tipe_cuti->id }}">Edit Tipe Cuti</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Tipe Cuti</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $tipe_cuti->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="periode" class="form-label">Periode</label>
                                                            {{-- select period in 'Tahun', 'Bulanan', 'Harian' --}}
                                                            <select class="form-select" name="periode">
                                                                <option value="">Select</option>
                                                                <option value="Tahun" {{ $tipe_cuti->periode == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                                                                <option value="Bulanan" {{ $tipe_cuti->periode == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                                                                <option value="Harian" {{ $tipe_cuti->periode == 'Harian' ? 'selected' : '' }}>Harian</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="kuota" class="form-label">Kuota</label>
                                                            <input type="number" class="form-control" id="kuota" name="kuota" value="{{ $tipe_cuti->kuota }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_is_attachment_required" class="form-label">Wajib Lampiran</label>
                                                            <select class="form-select" name="edit_is_attachment_required" required>
                                                                <option value="">Select</option>
                                                                <option value="1" {{ $tipe_cuti->is_attachment_required == 1 ? 'selected' : '' }}>Yes</option>
                                                                <option value="0" {{ $tipe_cuti->is_attachment_required == 0 ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                        <div id="edit_input_attachment_required_in_days">
                                                            @if ($tipe_cuti->is_attachment_required)
                                                                <div class="mb-3">
                                                                    <label for="attachment_required_in_days" class="form-label">Wajib Lampiran Dalam Hari?</label>
                                                                    <input type="number" class="form-control" id="attachment_required_in_days" name="attachment_required_in_days"
                                                                        value="{{ $tipe_cuti->attachment_required_in_days }}" required>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Status</label>
                                                            <select class="form-select" name="status" required>
                                                                <option value="Aktif" {{ $tipe_cuti->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                                                <option value="Tidak Aktif" {{ $tipe_cuti->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                                            </select>
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


                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-record-{{ $tipe_cuti->id }}">Delete</button>

                                    <!-- Delete Record Modal -->
                                    <div class="modal fade text-left" id="delete-record-{{ $tipe_cuti->id }}" tabindex="-1" role="dialog" aria-labelledby="delete-record-{{ $tipe_cuti->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('master.tipe_cuti.delete', $tipe_cuti->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-record-{{ $tipe_cuti->id }}">Delete Shift</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body m-3">
                                                        <p>Anda yakin ingin menghapus data shift ini?</p>
                                                        <p>Nb: Data yang sudah dihapus tidak dapat dikembalikan dan semua jadwal yang menggunakan shift ini akan terhapus.</p>
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
                <form action="{{ route('master.tipe_cuti.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-new-record">Add Tipe Cuti</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tipe Cuti</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="periode" class="form-label">Periode</label>
                            {{-- select period in 'Tahun', 'Bulanan', 'Harian' --}}
                            <select class="form-select" name="periode">
                                <option value="">Select</option>
                                <option value="Tahunan">Tahunan</option>
                                <option value="Bulananan">Bulananan</option>
                                <option value="Harian">Harian</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="number" class="form-control" id="kuota" name="kuota" required>
                        </div>
                        <div class="mb-3">
                            <label for="is_attachment_required" class="form-label">Wajib Lampiran</label>
                            <select class="form-select" name="is_attachment_required" required>
                                <option value="">Select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div id="input_attachment_required_in_days">
                            {{-- input_attachment_required_in_days --}}
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" required>
                                <option value="Aktif" selected>Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
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

    <script>
        var is_attachment_required = document.querySelector('select[name="is_attachment_required"]');

        is_attachment_required.addEventListener('change', function() {
            var input_attachment_required_in_days = document.getElementById('input_attachment_required_in_days');
            if (this.value == 1) {
                input_attachment_required_in_days.innerHTML = `
                    <div class="mb-3">
                        <label for="attachment_required_in_days" class="form-label">Wajib Lampiran Dalam Hari?</label>
                        <input type="number" class="form-control" id="attachment_required_in_days" name="attachment_required_in_days" required>
                    </div>
                `;
            } else {
                input_attachment_required_in_days.innerHTML = '';
            }
        });

        var edit_is_attachment_required = document.querySelector('select[name="edit_is_attachment_required"]');
        var edit_input_attachment_required_in_days = document.getElementById('edit_input_attachment_required_in_days');

        edit_is_attachment_required.addEventListener('change', function() {
            if (this.value == 1) {
                edit_input_attachment_required_in_days.innerHTML = `
                    <div class="mb-3">
                        <label for="attachment_required_in_days" class="form-label">Wajib Lampiran Dalam Hari?</label>
                        <input type="number" class="form-control" id="attachment_required_in_days" name="attachment_required_in_days" required>
                    </div>
                `;
            } else {
                edit_input_attachment_required_in_days.innerHTML = '';
            }
        });
    </script>
    <!--/ DataTable with Buttons -->
@endsection
