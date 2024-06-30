@extends('template.template', ['title' => 'Employee Detail', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <!-- Tabs for Absensi, Slip Gaji, Dokumen -->
            <div class="col-md-8">
                <div class="">
                    <ul class="nav nav-tabs" id="employeeDetailsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="slip-gaji-tab" data-bs-toggle="tab" href="#slip-gaji"
                                role="tab" aria-controls="slip-gaji" aria-selected="false">Slip Gaji</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="dokumen-tab" data-bs-toggle="tab" href="#dokumen" role="tab"
                                aria-controls="dokumen" aria-selected="false">Dokumen</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pendidikan-tab" data-bs-toggle="tab" href="#pendidikan" role="tab"
                                aria-controls="pendidikan" aria-selected="false">Pendidikan</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="keluarga-tab" data-bs-toggle="tab" href="#keluarga" role="tab"
                                aria-controls="keluarga" aria-selected="false">Keluarga</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="bank-tab" data-bs-toggle="tab" href="#bank" role="tab"
                                aria-controls="bank" aria-selected="false">Bank</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="employeeDetailsTabsContent">
                        <!-- Slip Gaji Tab -->
                        <div class="tab-pane fade show active" id="slip-gaji" role="tabpanel"
                            aria-labelledby="slip-gaji-tab">
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
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                data-bs-target="#addDocumentModal">Tambah Dokumen</button>

                            @if (count($documents) > 0)
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th>Nama Dokumen</th>
                                            <th>Dokumen</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $document)
                                            <tr>
                                                <td>{{ $document->name }}</td>
                                                <td>
                                                    <a href="{{ asset('image/employee_document/' . $document->attachment) }}"
                                                        target="_blank">Lihat Dokumen</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('employee.document.delete', $document->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p></p>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                data-bs-target="#addEducationModal">Tambah Pendidikan</button>

                            @if (count($educations) > 0)
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th>Institute</th>
                                            <th>Major</th>
                                            <th>Degree</th>
                                            <th>Year</th>
                                            <th>Attachment</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($educations as $education)
                                            <tr>
                                                <td>{{ $education->institute }}</td>
                                                <td>{{ $education->major }}</td>
                                                <td>{{ $education->degree }}</td>
                                                <td>{{ $education->year }}</td>
                                                <td>
                                                    <a href="{{ asset('image/employee_education/' . $education->attachment) }}"
                                                        target="_blank">Lihat Dokumen</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('employee.education.delete', $education->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p></p>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="keluarga" role="tabpanel" aria-labelledby="keluarga-tab">
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal"
                                data-bs-target="#addFamilyModal">Tambah Keluarga</button>

                            @if (count($families) > 0)
                                <table class="table mt-3">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Hubungan</th>
                                            <th>Kontak</th>
                                            <th>Alamat</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($families as $family)
                                            <tr>
                                                <td>{{ $family->name }}</td>
                                                <td>{{ $family->relation }}</td>
                                                <td>{{ $family->contact }}</td>
                                                <td>{{ $family->address }}</td>
                                                <td>
                                                    <form action="{{ route('employee.family.delete', $family->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p></p>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                            {{-- form input bank_name, account_number, anda account_name --}}
                            <form action="{{ route('employee.bank.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                <div class="mb-3">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" required
                                        value="{{ $employee->bank_account->bank_name ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number"
                                        required value="{{ $employee->bank_account->account_number ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="account_name" class="form-label ">Account Name</label>
                                    <input type="text" class="form-control" id="account_name" name="account_name"
                                        required value="{{ $employee->bank_account->account_name ?? '' }}">
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employee Details -->
            <div class="col-md-4">
                <div class="card p-3">
                    <div class="text-center">
                        <img id="employeeProfileImage" src="{{ asset($employee->user->image ?? '/') }}"
                            alt="Employee Image" class="rounded-circle mb-3" width="150" height="150"
                            onerror="this.src='https://media.istockphoto.com/id/1309328823/photo/headshot-portrait-of-smiling-male-employee-in-office.jpg?s=612x612&w=0&k=20&c=kPvoBm6qCYzQXMAn9JUtqLREXe9-PlZyMl9i-ibaVuY='">
                        <h4>{{ $employee->name }}</h4>
                        <p>{{ $employee->email }}</p>
                        <span class="badge bg-primary">{{ $employee->user->role->name ?? 'Employee' }}</span>
                    </div>

                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item"><strong>Join Date:</strong>
                            @if ($employee->tanggal_join == null)
                                <span
                                    class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Belum
                                    Dilengkapi</span>
                            @else
                                {{ date('d-M-Y', strtotime($employee->tanggal_join)) }}
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Lama Bekerja:</strong>
                            xx Tahun xx Bulan xx Hari
                        </li>
                        <li class="list-group-item"><strong>Phone:</strong>
                            @if ($employee->telpon == null)
                                <span
                                    class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Belum
                                    Dilengkapi</span>
                            @else
                                {{ $employee->telpon }}
                            @endif
                        </li>
                        <li class="list-group-item"><strong>NIK:</strong>
                            @if ($employee->nik == null)
                                <span
                                    class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Belum
                                    Dilengkapi</span>
                            @else
                                {{ $employee->nik }}
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Birth Date:</strong>
                            @if ($employee->tanggal_lahir == null)
                                <span
                                    class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Belum
                                    Dilengkapi</span>
                            @else
                                {{ date('d-M-Y', strtotime($employee->tanggal_lahir)) }}
                            @endif

                        </li>
                        <li class="list-group-item"><strong>Birth Place:</strong>
                            @if ($employee->tempat_lahir == null)
                                <span
                                    class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Belum
                                    Dilengkapi</span>
                            @else
                                {{ $employee->tempat_lahir }}
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Gender:</strong>
                            @if ($employee->jenis_kelamin == 'PEREMPUAN')
                                Perempuan
                            @else
                                Laki - Laki
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Marital Status:</strong> {{ $employee->status_pernikahan }}
                        </li>
                        <li class="list-group-item"><strong>Branch:</strong> {{ $employee->branch->lokasi }}</li>
                        {{-- <li class="list-group-item"><strong>NPWP:</strong>
                            @if ($employee->npwp == null)
                                <span
                                    class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Belum
                                    Dilengkapi</span>
                            @else
                                {{ $employee->npwp }}
                            @endif
                        </li>
                        <li class="list-group-item"><strong>BPJS:</strong>
                            @if ($employee->bpjs == null)
                                <span
                                    class="py-1 px-2 rounded-full text-xs bg-danger text-white cursor-pointer font-medium">Belum
                                    Dilengkapi</span>
                            @else
                                {{ $employee->bpjs }}
                            @endif
                        </li> --}}
                        <li class="list-group-item"><strong>Address:</strong> {{ $employee->alamat }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    {{-- modal add document --}}
    <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('employee.document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDocumentModalLabel">Tambah Dokumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Document</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment</label>
                            <input type="file" class="form-control" id="attachment" name="attachment" required
                                accept="application/pdf, image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Dokumen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal add pendidikan, input institute, major, degree, year, attachment --}}
    <div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('employee.education.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEducationModalLabel">Tambah Pendidikan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <div class="mb-3">
                            <label for="institute" class="form-label">Institute</label>
                            <input type="text" class="form-control" id="institute" name="institute" required>
                        </div>
                        <div class="mb-3">
                            <label for="major" class="form-label">Major</label>
                            <input type="text" class="form-control" id="major" name="major" required>
                        </div>
                        <div class="mb-3">
                            <label for="degree" class="form-label">Degree</label>
                            <input type="text" class="form-control" id="degree" name="degree" required>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" class="form-control" id="year" name="year" required>
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment</label>
                            <input type="file" class="form-control" id="attachment" name="attachment" required
                                accept="application/pdf, image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Pendidikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal add keluarga, input name, relation, contact, address textarea --}}
    <div class="modal fade" id="addFamilyModal" tabindex="-1" aria-labelledby="addFamilyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('employee.family.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFamilyModalLabel">Tambah Keluarga</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="relation" class="form-label">Hubungan</label>
                            <input type="text" class="form-control" id="relation" name="relation" required>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Kontak</label>
                            <input type="text" class="form-control" id="contact" name="contact" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Keluarga</button>
                    </div>
                </form>
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
