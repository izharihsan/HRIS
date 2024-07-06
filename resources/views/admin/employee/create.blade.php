@extends('template.template', ['title' => 'Employee Detail', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Form Karyawan Baru</h3>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible mt-3" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Display employee details using the $employee variable --}}
            <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="employee-details-form-inputs">
                    {{-- show image profile and input upload image --}}
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <img id="employeeProfileImage" src="https://google.com" alt="Employee Image" class="rounded me-3" width="300" height="200"
                                onerror="this.src='https://media.istockphoto.com/id/1309328823/photo/headshot-portrait-of-smiling-male-employee-in-office.jpg?s=612x612&w=0&k=20&c=kPvoBm6qCYzQXMAn9JUtqLREXe9-PlZyMl9i-ibaVuY='">
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" class="form-control" id="nik" name="nik">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="LAKI">LAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                            </select>
                        </div>
                        {{-- status pernikahan --}}
                        <div class="col-md-6">
                            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                            <select class="form-select" id="status_pernikahan" name="status_pernikahan">
                                <option value="Menikah">Menikah</option>
                                <option value="Belum Menikah">Belum Menikah</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="branch_id" class="form-label">Branch</label>
                            <select class="form-select" id="branch_id" name="branch_id">
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">
                                        {{ $branch->lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- telpon and email --}}
                        <div class="col-md-6">
                            <label for="telpon" class="form-label">Telpon</label>
                            <input type="text" class="form-control" id="telpon" name="telpon">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        {{-- npwp and bpjs --}}
                        <div class="col-md-4">
                            <label for="npwp" class="form-label">NPWP</label>
                            <input type="text" class="form-control" id="npwp" name="npwp">
                        </div>
                        <div class="col-md-4">
                            <label for="bpjs" class="form-label">BPJS</label>
                            <input type="text" class="form-control" id="bpjs" name="bpjs">
                        </div>
                        <div class="col-md-4">
                            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                            <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tanggal_join" class="form-label">Tanggal Join</label>
                            <input type="date" class="form-control" id="tanggal_join" name="tanggal_join">
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                        </div>
                        <div class="col-md-4">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                        </div>
                    </div>

                    {{-- select2 provinces, cities, districts, villages --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="province_id" class="form-label mb-0">Provinsi</label>
                            <select class="form-select" id="province_id" name="province_id">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="city_id" class="form-label mb-0">Kota/Kabupaten</label>
                            <select class="form-select" id="city_id" name="city_id">
                                <option value="">Pilih Kota/Kabupaten</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="district_id" class="form-label mb-0">Kecamatan</label>
                            <select class="form-select" id="district_id" name="district_id">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="village_id" class="form-label mb-0">Kelurahan/Desa</label>
                            <select class="form-select" id="village_id" name="village_id">
                                <option value="">Pilih Kelurahan/Desa</option>
                            </select>
                        </div>
                    </div>

                    {{-- alamat textarea --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                    </div>

                    {{-- password login --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Login</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    {{-- button Kembali, Hapus, Simpan --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('employee.list') }}" class="ms-2 btn btn-secondary">Kembali</a>
                        <button type="submit" class="ms-2 btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
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

            // handle select2 provinces, cities, districts, villages
            const province = document.querySelector('#province_id');
            const city = document.getElementById('city_id');
            const district = document.querySelector('#district_id');
            const village = document.querySelector('#village_id');
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            province.addEventListener('change', function() {
                console.log("TEST");
                fetch(`/api/cities/${this.value}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        city.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                        district.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        village.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                        data.forEach(city => {
                            console.log(city.id, city.name);
                            $('#city_id').append(`<option value="${city.id}">${city.name}</option>`);
                        });
                    });
            });

            city.addEventListener('change', function() {
                fetch(`/api/districts/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        district.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        village.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                        data.forEach(district => {
                            $('#district_id').append(`<option value="${district.id}">${district.name}</option>`);
                        });
                    });
            });

            district.addEventListener('change', function() {
                fetch(`/api/villages/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        village.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                        data.forEach(village => {
                            $('#village_id').append(`<option value="${village.id}">${village.name}</option>`);
                        });
                    });
            });
        </script>
    @endsection
