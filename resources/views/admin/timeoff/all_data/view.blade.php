@extends('template.template', ['title' => 'Cuti', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Employee Leaves</h3>
            <div class="card-datatable table-responsive pt-0 mt-3">
                <table class="datatables-basic table cell-border" id="datatables-basic">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($allDataTimeoff as $all_data)
                            <tr>
                                <td>{{ $all_data->id }}</td>
                                <td>{{ $all_data->user->name ?? '' }}</td>
                                <td>{{ $all_data->type }}</td>
                                <td>{{ $all_data->start_date }}</td>
                                <td>{{ $all_data->end_date }}</td>
                                <td>
                                    @if ($all_data->status == 'pending')
                                        <span class="badge p-1 bg-warning">Pending</span>
                                    @elseif ($all_data->status == 'approved')
                                        <span class="badge p-1 bg-success">Approved</span>
                                    @else
                                        <span class="badge p-1 bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- button approve & reject --}}
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $all_data->id }}">Approve</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $all_data->id }}">Reject</button>
                                    {{-- button detail modal --}}
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $all_data->id }}">Detail</button>

                                    {{-- modal approve --}}
                                    <div class="modal fade text-left" id="approveModal{{ $all_data->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Approve Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form
                                                    action="{{ ($all_data->type == 'Cuti' ? route('leaves.approve', $all_data->id) : $all_data->type == 'Izin') ? route('permissions.approve', $all_data->id) : route('sick_leaves.approve', $all_data->id) }}"
                                                    method="POST">
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
                                    <div class="modal fade text-left" id="rejectModal{{ $all_data->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Reject Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form
                                                    action="{{ ($all_data->type == 'Cuti' ? route('leaves.reject', $all_data->id) : $all_data->type == 'Izin') ? route('permissions.reject', $all_data->id) : route('sick_leaves.reject', $all_data->id) }}"
                                                    method="POST">
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
                                    <div class="modal fade text-left" id="detailModal{{ $all_data->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Detail Leave</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>Employee Name: <strong>{{ $all_data->user->name }}</strong></p>
                                                    <p>Start Date: <strong>{{ $all_data->start_date }}</strong></p>
                                                    <p>End Date: <strong>{{ $all_data->end_date }}</strong></p>
                                                    <p>Message: <strong>{{ $all_data->message }}</strong></p>
                                                    <p>Status: <strong>{{ $all_data->status }}</strong></p>
                                                    <p>Response Message: <strong>{{ $all_data->status_message }}</strong></p>
                                                    <p>Approved At: <strong>{{ $all_data->approved_at }}</strong></p>
                                                    {{-- a href to view attachment --}}
                                                    <a href="{{ asset('timeoffs/' . $all_data->attachment) }}" target="_blank" class="btn btn-primary">View Attachment</a>
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
