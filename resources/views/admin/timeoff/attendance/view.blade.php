@extends('template.template', ['title' => 'Attendance', 'is_active' => true])

@section('content')
    <!-- DataTable with Buttons -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Clock In</th>
                            <th>Location</th>
                            <th>Clock Out</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>2021-10-01</td>
                            <td>08:00</td>
                            <td>Office</td>
                            <td>17:00</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add-new-record">Detail</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Doe</td>
                            <td>2021-10-01</td>
                            <td>08:00</td>
                            <td>Office</td>
                            <td>17:00</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add-new-record">Detail</button>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
    <!--/ DataTable with Buttons -->
@endsection
