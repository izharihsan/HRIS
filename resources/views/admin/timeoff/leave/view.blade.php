@extends('template.template', ['title' => 'Cuti', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Employee Leaves</h3>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
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
                        @foreach ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->id }}</td>
                                <td>{{ $leave->user->name }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>
                                <td>
                                    @if ($leave->status == 'pending')
                                        <span class="badge p-1 bg-warning">Pending</span>
                                    @elseif ($leave->status == 'approved')
                                        <span class="badge p-1 bg-success">Approved</span>
                                    @else
                                        <span class="badge p-1 bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- button approve & reject --}}
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $leave->id }}">Approve</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $leave->id }}">Reject</button>
                                    {{-- button detail modal --}}
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $leave->id }}">Detail</button>

                                    {{-- modal approve --}}
                                    <div class="modal fade text-left" id="approveModal{{ $leave->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Approve Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('leaves.approve', $leave->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to approve this leave?</p>

                                                        {{-- message input optionally --}}
                                                        <div class="form-group mt-2">
                                                            <label for="message">Message</label>
                                                            <textarea class="form-control" name="message" id="message" rows="3"></textarea>
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
                                    <div class="modal fade text-left" id="rejectModal{{ $leave->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Reject Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('leaves.reject', $leave->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body
                                                    text-center">
                                                        <p>Are you sure you want to reject this leave?</p>

                                                        {{-- message input optionally --}}
                                                        <div class="form-group mt-2">
                                                            <label for="message">Message</label>
                                                            <textarea class="form-control" name="message" id="message" rows="3"></textarea>
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
                                    <div class="modal fade text-left" id="detailModal{{ $leave->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Detail Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Detail Leave</p>
                                                    <p>Employee Name: {{ $leave->user->name }}</p>
                                                    <p>Start Date: {{ $leave->start_date }}</p>
                                                    <p>End Date: {{ $leave->end_date }}</p>
                                                    <p>Message: {{ $leave->message }}</p>
                                                    <p>Status: {{ $leave->status }}</p>
                                                    <p>Response Message: {{ $leave->status_message }}</p>
                                                    {{-- a href to view attachment --}}
                                                    <a href="{{ asset('timeoffs/' . $leave->attachment) }}" target="_blank" class="btn btn-info">View Attachment</a>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
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
