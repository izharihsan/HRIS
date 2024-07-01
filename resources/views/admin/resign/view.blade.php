@extends('template.template', ['title' => 'Pengunduran Karyawan', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>List Pengunduran Karyawan</h3>
            <div class="card-datatable table-responsive pt-0 mt-3">
                <table class="datatables-basic table cell-border" id="datatables-basic">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Submit</th>
                            <th>Tanggal Resign</th>
                            <th>Lampiran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($resigns as $resign)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $resign->employee->name ?? '' }}</td>
                                <td>{{ $resign->submit_date ?? '' }}</td>
                                <td>{{ $resign->resign_date }}</td>
                                <td>
                                    @if ($resign->attachment)
                                        <a href="{{ asset('image/employee_resign/' . $resign->attachment) }}" target="_blank">View Attachment</a>
                                    @else
                                        <span class="badge p-1 bg-danger">No Attachment</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($resign->status == 'pending')
                                        <span class="badge p-1 bg-warning">Pending</span>
                                    @elseif ($resign->status == 'approved')
                                        <span class="badge p-1 bg-success">Approved</span>
                                    @else
                                        <span class="badge p-1 bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- button approve & reject --}}
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $resign->id }}">Approve</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $resign->id }}">Reject</button>
                                    {{-- button detail modal --}}
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $resign->id }}">Detail</button>

                                    {{-- modal approve --}}
                                    <div class="modal fade text-left" id="approveModal{{ $resign->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Approve Pengunduran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('employee_resign.approve', $resign->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to approve this employee resign request?</p>

                                                        {{-- message input optionally --}}
                                                        <div class="form-group mt-2">
                                                            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Enter notes"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-success ml-1">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Approve</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- modal reject --}}
                                    <div class="modal fade text-left" id="rejectModal{{ $resign->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Reject Pengunduran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('employee_resign.reject', $resign->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body
                                                    text-center">
                                                        <p>Are you sure you want to reject this employee resign request?</p>

                                                        {{-- message input optionally --}}
                                                        <div class="form-group mt-2">
                                                            <textarea class="form-control" name="message" id="message" rows="3" placeholder="Enter notes"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Close</span>
                                                        </button>
                                                        <button type="submit" class="btn btn-danger ml-1">
                                                            <i class="bx bx-check d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Reject</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- modal detail --}}
                                    <div class="modal fade text-left" id="detailModal{{ $resign->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Detail Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>Nama Karyawan: <strong>{{ $resign->employee->name ?? '' }}</strong></p>
                                                    <p>Tanggal Submit Request: <strong>{{ $resign->submit_date }}</strong></p>
                                                    <p>Tanggal Pengunduran Diajukan: <strong>{{ $resign->resign_daye }}</strong></p>
                                                    <p>Pesan: <strong>{{ $resign->message }}</strong></p>
                                                    <p>Status: <strong>{{ $resign->status }}</strong></p>
                                                    <p>Response Message: <strong>{{ $resign->status_message }}</strong></p>
                                                    <p>Approved Resign Date: <strong>{{ $resign->approved_resign_date }}</strong></p>
                                                    {{-- a href to view attachment --}}
                                                    @if ($resign->attachment)
                                                        <a href="{{ asset('image/employee_resign/' . $resign->attachment) }}" target="_blank">View Attachment</a>
                                                    @else
                                                        <span class="badge p-1 bg-danger">No Attachment</span>
                                                    @endif
                                                </div>
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
    <!--/ DataTable with Buttons -->
@endsection
