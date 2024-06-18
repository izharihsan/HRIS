@extends('template.template', ['title' => 'Employee Detail', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Detail Employee</h3>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible mt-3" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Display employee details using the $employee variable --}}
            <form action="{{ route('employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="employee-details-form-inputs">
                    {{-- show image profile and input upload image --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <img id="employeeProfileImage" src="{{ asset($employee->user->image ?? '/') }}" alt="Employee Image" class="rounded me-3" width="300" height="200"
                                onerror="this.src='https://media.istockphoto.com/id/1309328823/photo/headshot-portrait-of-smiling-male-employee-in-office.jpg?s=612x612&w=0&k=20&c=kPvoBm6qCYzQXMAn9JUtqLREXe9-PlZyMl9i-ibaVuY='">
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">
                        </div>
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" class="form-control" id="nik" name="nik" value="{{ $employee->nik }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="LAKI" {{ $employee->jenis_kelamin == 'LAKI' ? 'selected' : '' }}>LAKI</option>
                                <option value="PEREMPUAN" {{ $employee->jenis_kelamin == 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN</option>
                            </select>
                        </div>
                        {{-- status pernikahan --}}
                        <div class="col-md-6">
                            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                            <select class="form-select" id="status_pernikahan" name="status_pernikahan">
                                <option value="Menikah" {{ $employee->status_pernikahan == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                <option value="Belum Menikah" {{ $employee->status_pernikahan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="branch_id" class="form-label">Branch</label>
                            <select class="form-select" id="branch_id" name="branch_id">
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ $employee->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" {{ $employee->status == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $employee->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- telpon and email --}}
                        <div class="col-md-6">
                            <label for="telpon" class="form-label">Telpon</label>
                            <input type="text" class="form-control" id="telpon" name="telpon" value="{{ $employee->telpon }}">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- npwp and bpjs --}}
                        <div class="col-md-4">
                            <label for="npwp" class="form-label">NPWP</label>
                            <input type="text" class="form-control" id="npwp" name="npwp" value="{{ $employee->npwp }}">
                        </div>
                        <div class="col-md-4">
                            <label for="bpjs" class="form-label">BPJS</label>
                            <input type="text" class="form-control" id="bpjs" name="bpjs" value="{{ $employee->bpjs }}">
                        </div>
                        <div class="col-md-4">
                            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                            <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" value="{{ $employee->gaji_pokok }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tanggal_join" class="form-label">Tanggal Join</label>
                            <input type="date" class="form-control" id="tanggal_join" name="tanggal_join" value="{{ $employee->tanggal_join }}">
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $employee->tanggal_lahir }}">
                        </div>
                        <div class="col-md-4">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ $employee->tempat_lahir }}">
                        </div>
                    </div>

                    {{-- alamat textarea --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ $employee->alamat }}</textarea>
                    </div>

                    {{-- button Kembali, Hapus, Simpan --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('employee.list') }}" class="ms-2 btn btn-secondary">Kembali</a>
                        {{-- <button type="button" class="ms-2 btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button> --}}
                        @if ($employee->status == true)
                            <button type="button" class="ms-2 btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#nonaktifModal">Nonaktifkan</button>
                        @else
                            <button type="button" class="ms-2 btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#aktifModal">Aktifkan</button>
                        @endif
                        <button type="submit" class="ms-2 btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Delete Record Modal -->
        <div class="modal fade text-left" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="delete-record">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('employee.delete', $employee->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-record-{{ $employee->id }}">Hapus Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            <p>Anda yakin ingin menghapus karyawan ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- nonaktif modal --}}
        <div class="modal fade text-left" id="nonaktifModal" tabindex="-1" role="dialog" aria-labelledby="nonaktif-record">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('employee.nonaktifkan', $employee->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="nonaktif-record-{{ $employee->id }}">Nonaktifkan Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            <p>Anda yakin ingin menonaktifkan karyawan ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- aktif modal --}}
        <div class="modal fade text-left" id="aktifModal" tabindex="-1" role="dialog" aria-labelledby="aktif-record">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('employee.aktifkan', $employee->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="aktif-record-{{ $employee->id }}">Aktifkan Karyawan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            <p>Anda yakin ingin menaktifkan karyawan ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // handle input rupiah with Intl Number Format
            const rupiah = document.querySelector('#gaji_pokok');
            rupiah.addEventListener('keyup', function(e) {
                rupiah.value = formatRupiah(this.value, 'Rp. ');
            });

            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }

            // set default value for slip gaji
            rupiah.value = formatRupiah("{{ $employee->gaji_pokok }}", 'Rp. ');

            // handle image uploaded for profile and preview
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
        </script>
    @endsection
