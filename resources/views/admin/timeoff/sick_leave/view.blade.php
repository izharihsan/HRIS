@extends('template.template', ['title' => 'Sakit', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Employee Sick Leaves</h3>
            <div class="card-datatable table-responsive pt-0 mt-3">
                <table class="datatables-basic table cell-border" id="datatables-basic">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sick_leaves as $sick_leave)
                            <tr>
                                <td>{{ $sick_leave->id }}</td>
                                <td>{{ $sick_leave->user->name ?? '' }}</td>
                                <td>{{ $sick_leave->start_date }}</td>
                                <td>{{ $sick_leave->end_date }}</td>
                                <td>
                                    @if ($sick_leave->status == 'pending')
                                        <span class="badge p-1 bg-warning">Pending</span>
                                    @elseif ($sick_leave->status == 'approved')
                                        <span class="badge p-1 bg-success">Approved</span>
                                    @else
                                        <span class="badge p-1 bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- button approve & reject --}}
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $sick_leave->id }}">Approve</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $sick_leave->id }}">Reject</button>
                                    {{-- button detail modal --}}
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $sick_leave->id }}">Detail</button>

                                    {{-- modal approve --}}
                                    <div class="modal fade text-left" id="approveModal{{ $sick_leave->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Approve Sick Leaves</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('sick_leaves.approve', $sick_leave->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to approve this Sick Leaves?</p>

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
                                    <div class="modal fade text-left" id="rejectModal{{ $sick_leave->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Reject Sick Leaves</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('sick_leaves.reject', $sick_leave->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body
                                                    text-center">
                                                        <p>Are you sure you want to reject this Sick Leaves?</p>

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
                                    <div class="modal fade text-left" id="detailModal{{ $sick_leave->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Detail Sick Leaves</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>Employee Name: <strong>{{ $sick_leave->user->name ?? '' }}</strong></p>
                                                    <p>Start Date: <strong>{{ $sick_leave->start_date }}</strong></p>
                                                    <p>End Date: <strong>{{ $sick_leave->end_date }}</strong></p>
                                                    <p>Message: <strong>{{ $sick_leave->message }}</strong></p>
                                                    <p>Status: <strong>{{ $sick_leave->status }}</strong></p>
                                                    <p>Response Message: <strong>{{ $sick_leave->status_message }}</strong></p>
                                                    <p>Approved At: <strong>{{ $sick_leave->approved_at }}</strong></p>
                                                    {{-- a href to view attachment --}}
                                                    <a href="{{ asset('timeoffs/' . $sick_leave->attachment) }}" target="_blank" class="btn btn-primary">View Attachment</a>
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
