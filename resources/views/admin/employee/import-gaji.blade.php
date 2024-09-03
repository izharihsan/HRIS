@extends('template.template', ['title' => 'Import Gaji', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Form Import Gaji</h3>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible mt-3" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Display employee details using the $employee variable --}}
            <form action="{{ route('employee.import-gaji.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="employee-details-form-inputs">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">File Gaji</label>
                        <input type="file" class="form-control" id="file_gaji" name="file_gaji">
                    </div>

                    {{-- button Kembali, Hapus, Simpan --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('employee.list') }}" class="ms-2 btn btn-secondary">Kembali</a>
                        <a href="/template/import_salary_template.xlsx" class="ms-2 btn btn-info">Download Template Gaji</a>
                        <button type="submit" class="ms-2 btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
           
        </script>
    @endsection
