@extends('template.template', ['title' => 'Reimbursement', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>List Pengajuan Reimbursement</h3>
            <div class="card-datatable table-responsive pt-0 mt-3">
                <table class="datatables-basic table cell-border" id="datatables-basic">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Karyawan</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($reimbursements as $reimbursement)
                            <tr>
                                <td>{{ $reimbursement->id }}</td>
                                <td>{{ $reimbursement->user->name ?? '' }}</td>
                                <td>
                                    {{ $reimbursement->title }}
                                </td>
                                <td>
                                    {{ $reimbursement->description }}
                                </td>
                                <td>
                                    Rp.{{ number_format($reimbursement->amount, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if ($reimbursement->status == 'pending')
                                        <span class="badge p-1 bg-warning">Pending</span>
                                    @elseif ($reimbursement->status == 'approved')
                                        <span class="badge p-1 bg-success">Approved</span>
                                    @else
                                        <span class="badge p-1 bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- button approve & reject --}}
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $reimbursement->id }}">Approve</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $reimbursement->id }}">Reject</button>
                                    {{-- button detail modal --}}
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $reimbursement->id }}">Detail</button>

                                    {{-- modal approve --}}
                                    <div class="modal fade text-left" id="approveModal{{ $reimbursement->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Approve Reimbursement</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('reimbursement.approve', $reimbursement->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to approve this leave?</p>

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
                                    <div class="modal fade text-left" id="rejectModal{{ $reimbursement->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Reject Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('reimbursement.reject', $reimbursement->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body
                                                    text-center">
                                                        <p>Are you sure you want to reject this leave?</p>

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
                                    <div class="modal fade text-left" id="detailModal{{ $reimbursement->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Detail Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>Employee Name: <strong>{{ $reimbursement->user->name }}</strong></p>
                                                    <p>Title: <strong>{{ $reimbursement->title }}</strong></p>
                                                    <p>Description: <strong>{{ $reimbursement->description }}</strong></p>
                                                    <p>Amount: <strong>Rp.{{ number_format($reimbursement->amount, 0, ',', '.') }}</strong></p>
                                                    <p>Tanggal: <strong>{{ $reimbursement->date }}</strong></p>
                                                    <p>Status: <strong>{{ $reimbursement->status }}</strong></p>
                                                    <p>Response Message: <strong>{{ $reimbursement->status_message }}</strong></p>
                                                    <p>Approved By: <strong>{{ $reimbursement->approved_by }}</strong></p>
                                                    {{-- a href to view attachment --}}
                                                    <a href="{{ asset('image/reimbursement/' . $reimbursement->attachment) }}" target="_blank">View Attachment</a>
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
