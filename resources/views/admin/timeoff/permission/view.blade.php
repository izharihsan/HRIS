@extends('template.template', ['title' => 'Izin', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Employee Permissions</h3>
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
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->user->name }}</td>
                                <td>{{ $permission->start_date }}</td>
                                <td>{{ $permission->end_date }}</td>
                                <td>
                                    @if ($permission->status == 'pending')
                                        <span class="badge p-1 bg-warning">Pending</span>
                                    @elseif ($permission->status == 'approved')
                                        <span class="badge p-1 bg-success">Approved</span>
                                    @else
                                        <span class="badge p-1 bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- button approve & reject --}}
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $permission->id }}">Approve</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $permission->id }}">Reject</button>
                                    {{-- button detail modal --}}
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $permission->id }}">Detail</button>

                                    {{-- modal approve --}}
                                    <div class="modal fade text-left" id="approveModal{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Approve Permissions</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('permissions.approve', $permission->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to approve this Permissions?</p>

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
                                    <div class="modal fade text-left" id="rejectModal{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Reject Permissions</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('permissions.reject', $permission->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body
                                                    text-center">
                                                        <p>Are you sure you want to reject this Permissions?</p>

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
                                    <div class="modal fade text-left" id="detailModal{{ $permission->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Detail Permissions</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <p>Detail Leave</p>
                                                    <p>Employee Name: {{ $permission->user->name }}</p>
                                                    <p>Start Date: {{ $permission->start_date }}</p>
                                                    <p>End Date: {{ $permission->end_date }}</p>
                                                    <p>Message: {{ $permission->message }}</p>
                                                    <p>Status: {{ $permission->status }}</p>
                                                    <p>Response Message: {{ $permission->status_message }}</p>
                                                    {{-- a href to view attachment --}}
                                                    <a href="{{ asset('timeoffs/' . $permission->attachment) }}" target="_blank" class="btn btn-info">View Attachment</a>
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
