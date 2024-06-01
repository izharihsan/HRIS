@extends('template.template', ['title' => 'Overtime', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Employee Overtimes</h3>
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($overtimes as $overtime)
                            <tr>
                                <td>{{ $overtime->id }}</td>
                                <td>{{ $overtime->absence->user->name }}</td>
                                <td>{{ $overtime->start_time }}</td>
                                <td>{{ $overtime->end_time }}</td>
                                <td>
                                    @if ($overtime->status == 'pending')
                                        <span class="badge p-1 bg-warning">Pending</span>
                                    @elseif ($overtime->status == 'approved')
                                        <span class="badge p-1 bg-success">Approved</span>
                                    @else
                                        <span class="badge p-1 bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- button approve & reject --}}
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $overtime->id }}">Approve</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $overtime->id }}">Reject</button>
                                    {{-- modal approve --}}
                                    <div class="modal fade text-left" id="approveModal{{ $overtime->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Approve Overtime</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('overtimes.approve', $overtime->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <p>Are you sure you want to approve this overtime?</p>

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
                                    <div class="modal fade text-left" id="rejectModal{{ $overtime->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel160">Reject Overtime</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('overtimes.reject', $overtime->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body
                                                    text-center">
                                                        <p>Are you sure you want to reject this overtime?</p>

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
