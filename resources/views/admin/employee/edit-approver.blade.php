@extends('template.template', ['title' => 'Edit Approver', 'is_active' => true])

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-3">
            <h3>Form Approver</h3>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible mt-3" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-message">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Display employee details using the $employee variable --}}
            <form action="{{ route('employee.approver.update', $approver->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="employee-details-form-inputs">

                    <div class="col-md-12 mb-3">
                        <label for="approver_id" class="form-label">Approver</label>
                        <select name="approver_id" class="form-control" required>
                            @foreach($approvers as $approverData)
                                <option value="{{ $approverData->id }}" {{ $approverData->id == $approver->approver_id ? 'selected':'' }}>{{ $approverData->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="index" class="form-label">Level</label>
                        <input type="number" class="form-control" id="index" name="index" value="{{ $approver->index }}">
                    </div>

                    {{-- button Kembali, Hapus, Simpan --}}
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('employee.detail', $employee->id) }}" class="ms-2 btn btn-secondary">Kembali</a>
                        <button type="submit" class="ms-2 btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            
        </script>
    @endsection
