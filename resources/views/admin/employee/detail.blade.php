@extends('template.template', ['title' => 'Employee Detail', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <!-- Tabs for Absensi, Slip Gaji, Dokumen -->
            <div class="col-md-8">
                <div class="">
                    <ul class="nav nav-tabs" id="employeeDetailsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="slip-gaji-tab" data-bs-toggle="tab" href="#slip-gaji" role="tab" aria-controls="slip-gaji" aria-selected="false">Slip Gaji</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="dokumen-tab" data-bs-toggle="tab" href="#dokumen" role="tab" aria-controls="dokumen" aria-selected="false">Dokumen</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pendidikan-tab" data-bs-toggle="tab" href="#pendidikan" role="tab" aria-controls="pendidikan" aria-selected="false">Pendidikan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="keluarga-tab" data-bs-toggle="tab" href="#keluarga" role="tab" aria-controls="keluarga" aria-selected="false">Keluarga</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="employeeDetailsTabsContent">
                        <!-- Slip Gaji Tab -->
                        <div class="tab-pane fade show active" id="slip-gaji" role="tabpanel" aria-labelledby="slip-gaji-tab">
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>Gaji Bersih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Populate this with employee salary slip data -->
                                    <tr>
                                        <td>No data available</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Dokumen Tab -->
                        <div class="tab-pane fade" id="dokumen" role="tabpanel" aria-labelledby="dokumen-tab">
                            <!-- Add respective tables or forms for family and education -->
                            <button class="btn btn-primary mt-3" onclick="addDocument()">Tambah Dokumen</button>
                        </div>
                        <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                            <button class="btn btn-primary mt-3" onclick="addEducation()">Tambah Pendidikan</button>
                            <!-- Add respective tables or forms for family and education -->
                        </div>

                        <div class="tab-pane fade" id="keluarga" role="tabpanel" aria-labelledby="keluarga-tab">
                            <button class="btn btn-primary mt-3" onclick="addFamily()">Tambah Keluarga</button>
                            <!-- Add respective tables or forms for family and education -->
                        </div>

                    </div>
                </div>
            </div>

            <!-- Employee Details -->
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="text-center">
                        <img id="employeeProfileImage" src="{{ asset($employee->user->image ?? '/') }}" alt="Employee Image" class="rounded-circle mb-3" width="150" height="150"
                            onerror="this.src='https://media.istockphoto.com/id/1309328823/photo/headshot-portrait-of-smiling-male-employee-in-office.jpg?s=612x612&w=0&k=20&c=kPvoBm6qCYzQXMAn9JUtqLREXe9-PlZyMl9i-ibaVuY='">
                        <h4>{{ $employee->name }}</h4>
                        <p>{{ $employee->email }}</p>
                        <span class="badge bg-primary">{{ $employee->user->role->name ?? 'Employee' }}</span>
                    </div>
                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item"><strong>Phone:</strong> {{ $employee->telpon }}</li>
                        <li class="list-group-item"><strong>NIK:</strong> {{ $employee->nik }}</li>
                        <li class="list-group-item"><strong>Birth Date:</strong> {{ $employee->tanggal_lahir }}</li>
                        <li class="list-group-item"><strong>Birth Place:</strong> {{ $employee->tempat_lahir }}</li>
                        <li class="list-group-item"><strong>Gender:</strong> {{ $employee->jenis_kelamin }}</li>
                        <li class="list-group-item"><strong>Marital Status:</strong> {{ $employee->status_pernikahan }}</li>
                        <li class="list-group-item"><strong>Branch:</strong> {{ $employee->branch->lokasi }}</li>
                        <li class="list-group-item"><strong>NPWP:</strong> {{ $employee->npwp }}</li>
                        <li class="list-group-item"><strong>BPJS:</strong> {{ $employee->bpjs }}</li>
                        <li class="list-group-item"><strong>Join Date:</strong> {{ $employee->tanggal_join }}</li>
                        <li class="list-group-item"><strong>Address:</strong> {{ $employee->alamat }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Handle image uploaded for profile and preview
        const image = document.querySelector('#image');
        image.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    const img = document.querySelector('#employeeProfileImage');
                    img.src = reader.result;
                }
                reader.readAsDataURL(file);
            }
        });

        function addFamily() {
            // Add logic to handle adding family member
        }

        function addEducation() {
            // Add logic to handle adding education
        }
    </script>
@endsection
