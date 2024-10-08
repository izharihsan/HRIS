@extends('template.template', ['title' => 'Profile', 'is_active' => true])


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Header -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="user-profile-header-banner">
                            <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                <img src="{{ asset(auth()->user()['image']) }}" alt="user image"
                                    class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img"
                                    onerror="this.src='{{ asset('assets/img/logo.png') }}'" />
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-5">
                                <div
                                    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4>{{ $data['name'] }}</h4>
                                        <ul
                                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class="ti ti-color-swatch"></i> {{ $data->divisi['name'] }}
                                            </li>
                                            <li class="list-inline-item d-flex gap-1"><i class="ti ti-map-pin"></i>
                                                {{ $data->city['name'] }}
                                            </li>
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class="ti ti-calendar"></i> Joined At
                                                {{ \Carbon\Carbon::parse($data['tanggal_join'])->format('F j, Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-primary">
                                        <i class="ti ti-check me-1"></i>Connected
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Header -->

            <!-- Navbar pills -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-sm-row mb-4" id="profileTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#user-tab" role="tab"
                                aria-controls="user-tab"><i class="ti-xs ti ti-user-check me-1"></i>
                                Profile</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link " id="documents-tab" data-bs-toggle="tab" href="#documents-tab"
                                role="tab" aria-controls="documents-tab"><i class="ti-xs ti ti-user-check me-1"></i>
                                Documents</a>
                        </li>

                    </ul>
                </div>
            </div>
            <!--/ Navbar pills -->
            <div class="tab-content" id="profileTabContent">
                <div class="tab-pane fade show active" id="user-tab" role="tabpanel" aria-labelledby="user-tab">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-5">
                            <!-- About User -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <small class="card-text text-uppercase">About</small>
                                    <ul class="list-unstyled mb-4 mt-3">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-user text-heading"></i><span
                                                class="fw-medium mx-2 text-heading">Full
                                                Name:</span> <span>{{ $data['name'] }}</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-check text-heading"></i><span
                                                class="fw-medium mx-2 text-heading">Status:</span>
                                            <span>{{ $data['status'] ? 'Active' : 'Nonactive' }}</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-crown text-heading"></i><span
                                                class="fw-medium mx-2 text-heading">Role:</span>
                                            <span>{{ auth()->user()->role['name'] }}</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-flag text-heading"></i><span
                                                class="fw-medium mx-2 text-heading">Province :</span>
                                            <span>{{ $data->province['name'] }}</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-flag text-heading"></i><span
                                                class="fw-medium mx-2 text-heading">City
                                                :</span>
                                            <span>{{ $data->city['name'] }}</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-flag text-heading"></i><span
                                                class="fw-medium mx-2 text-heading">District :</span>
                                            <span>{{ $data->district['name'] }}</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-flag text-heading"></i><span
                                                class="fw-medium mx-2 text-heading">Village
                                                :</span>
                                            <span>{{ $data->village['name'] }}</span>
                                        </li>
                                    </ul>
                                    <small class="card-text text-uppercase">Contacts</small>
                                    <ul class="list-unstyled mb-4 mt-3">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-phone-call"></i><span
                                                class="fw-medium mx-2 text-heading">Contact:</span>
                                            <span>{{ $data['telpon'] }}</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-mail"></i><span
                                                class="fw-medium mx-2 text-heading">Email:</span>
                                            <span>{{ $data['email'] }}</span>
                                        </li>
                                    </ul>
                                    <small class="card-text text-uppercase">Teams</small>
                                    <ul class="list-unstyled mb-0 mt-3">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-brand-angular text-danger me-2"></i>
                                            <div class="d-flex flex-wrap">
                                                <span class="fw-medium me-2 text-heading">Backend Developer</span><span>(126
                                                    Members)</span>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="ti ti-brand-react-native text-info me-2"></i>
                                            <div class="d-flex flex-wrap">
                                                <span class="fw-medium me-2 text-heading">React Developer</span><span>(98
                                                    Members)</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ About User -->
                            <!-- Profile Overview -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <p class="card-text text-uppercase">Overview</p>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-check"></i><span class="fw-medium mx-2">Task Compiled:</span>
                                            <span>13.5k</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <i class="ti ti-layout-grid"></i><span class="fw-medium mx-2">Projects
                                                Compiled:</span>
                                            <span>146</span>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="ti ti-users"></i><span class="fw-medium mx-2">Connections:</span>
                                            <span>897</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ Profile Overview -->
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7">
                            <!-- Activity Timeline -->
                            <div class="card card-action mb-4">
                                <div class="card-header align-items-center">
                                    <h5 class="card-action-title mb-0">Activity Timeline</h5>
                                    <div class="card-action-element">
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical text-muted"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a>
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider" />
                                                </li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <ul class="timeline ms-1 mb-0">
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-primary"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header">
                                                    <h6 class="mb-0">Client Meeting</h6>
                                                    <small class="text-muted">Today</small>
                                                </div>
                                                <p class="mb-2">Project meeting with john @10:15am</p>
                                                <div class="d-flex flex-wrap">
                                                    <div class="avatar me-2">
                                                        <img src="../../assets/img/avatars/3.png" alt="Avatar"
                                                            class="rounded-circle" />
                                                    </div>
                                                    <div class="ms-1">
                                                        <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                                        <span>CEO of Infibeam</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-success"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header">
                                                    <h6 class="mb-0">Create a new project for client</h6>
                                                    <small class="text-muted">2 Day Ago</small>
                                                </div>
                                                <p class="mb-0">Add files to new design folder</p>
                                            </div>
                                        </li>
                                        <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-danger"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header">
                                                    <h6 class="mb-0">Shared 2 New Project Files</h6>
                                                    <small class="text-muted">6 Day Ago</small>
                                                </div>
                                                <p class="mb-2">
                                                    Sent by Mollie Dixon
                                                    <img src="../../assets/img/avatars/4.png" class="rounded-circle me-3"
                                                        alt="avatar" height="24" width="24" />
                                                </p>
                                                <div class="d-flex flex-wrap gap-2 pt-1">
                                                    <a href="javascript:void(0)" class="me-3">
                                                        <img src="../../assets/img/icons/misc/doc.png"
                                                            alt="Document image" width="15" class="me-2" />
                                                        <span class="fw-medium text-heading">App Guidelines</span>
                                                    </a>
                                                    <a href="javascript:void(0)">
                                                        <img src="../../assets/img/icons/misc/xls.png" alt="Excel image"
                                                            width="15" class="me-2" />
                                                        <span class="fw-medium text-heading">Testing Results</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-item timeline-item-transparent border-transparent">
                                            <span class="timeline-point timeline-point-info"></span>
                                            <div class="timeline-event">
                                                <div class="timeline-header">
                                                    <h6 class="mb-0">Project status updated</h6>
                                                    <small class="text-muted">10 Day Ago</small>
                                                </div>
                                                <p class="mb-0">Woocommerce iOS App Completed</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ Activity Timeline -->
                            <div class="row">
                                <!-- Connections -->
                                <div class="col-lg-12 col-xl-6">
                                    <div class="card card-action mb-4">
                                        <div class="card-header align-items-center">
                                            <h5 class="card-action-title mb-0">Connections</h5>
                                            <div class="card-action-element">
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti ti-dots-vertical text-muted"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="javascript:void(0);">Share
                                                                connections</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);">Suggest
                                                                edits</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider" />
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);">Report
                                                                bug</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/avatars/2.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">Cecilia Payne</h6>
                                                                <small class="text-muted">45 Connections</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <button class="btn btn-label-primary btn-icon btn-sm">
                                                                <i class="ti ti-user-check ti-xs"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/avatars/3.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">Curtis Fletcher</h6>
                                                                <small class="text-muted">1.32k Connections</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <button class="btn btn-primary btn-icon btn-sm">
                                                                <i class="ti ti-user-x ti-xs"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/avatars/10.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">Alice Stone</h6>
                                                                <small class="text-muted">125 Connections</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <button class="btn btn-primary btn-icon btn-sm">
                                                                <i class="ti ti-user-x ti-xs"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/avatars/7.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">Darrell Barnes</h6>
                                                                <small class="text-muted">456 Connections</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <button class="btn btn-label-primary btn-icon btn-sm">
                                                                <i class="ti ti-user-check ti-xs"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="mb-3">
                                                    <div class="d-flex align-items-start">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/avatars/12.png" alt="Avatar"
                                                                    class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">Eugenia Moore</h6>
                                                                <small class="text-muted">1.2k Connections</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <button class="btn btn-label-primary btn-icon btn-sm">
                                                                <i class="ti ti-user-check ti-xs"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="text-center">
                                                    <a href="javascript:;">View all connections</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Connections -->
                                <!-- Teams -->
                                <div class="col-lg-12 col-xl-6">
                                    <div class="card card-action mb-4">
                                        <div class="card-header align-items-center">
                                            <h5 class="card-action-title mb-0">Teams</h5>
                                            <div class="card-action-element">
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti ti-dots-vertical text-muted"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="javascript:void(0);">Share
                                                                teams</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);">Suggest
                                                                edits</a>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider" />
                                                        </li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);">Report
                                                                bug</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled mb-0">
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/icons/brands/react-label.png"
                                                                    alt="Avatar" class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">React Developers</h6>
                                                                <small class="text-muted">72 Members</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <a href="javascript:;"><span
                                                                    class="badge bg-label-danger">Developer</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/icons/brands/support-label.png"
                                                                    alt="Avatar" class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">Support Team</h6>
                                                                <small class="text-muted">122 Members</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <a href="javascript:;"><span
                                                                    class="badge bg-label-primary">Support</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/icons/brands/figma-label.png"
                                                                    alt="Avatar" class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">UI Designers</h6>
                                                                <small class="text-muted">7 Members</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <a href="javascript:;"><span
                                                                    class="badge bg-label-info">Designer</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/icons/brands/vue-label.png"
                                                                    alt="Avatar" class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">Vue.js Developers</h6>
                                                                <small class="text-muted">289 Members</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <a href="javascript:;"><span
                                                                    class="badge bg-label-danger">Developer</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar me-2">
                                                                <img src="../../assets/img/icons/brands/twitter-label.png"
                                                                    alt="Avatar" class="rounded-circle" />
                                                            </div>
                                                            <div class="me-2 ms-1">
                                                                <h6 class="mb-0">Digital Marketing</h6>
                                                                <small class="text-muted">24 Members</small>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <a href="javascript:;"><span
                                                                    class="badge bg-label-secondary">Marketing</span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="text-center">
                                                    <a href="javascript:;">View all teams</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Teams -->
                            </div>
                            <!-- Projects table -->
                            <div class="card mb-4">
                                <div class="card-datatable table-responsive">
                                    <table class="datatables-projects table border-top">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Leader</th>
                                                <th>Team</th>
                                                <th class="w-px-200">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!--/ Projects table -->
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="documents-tab" role="tabpanel" aria-labelledby="documents-tab">
                    <h3>Profile</h3>
                    <p>Content for Profile tab.</p>
                </div>
            </div>
            <!-- User Profile Content -->

            <!--/ User Profile Content -->
        </div>
    </div>
@endsection
