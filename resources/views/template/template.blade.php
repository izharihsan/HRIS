<!doctype html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ env('APP_NAME') }} - {{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/assets') }}/img/favicon/trans.png" />
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/assets/vendor/fonts/flag-icons.css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/pages/page-profile.css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="/assets/vendor/css/pages/cards-advance.css" />
    <script src="/assets/vendor/js/helpers.js"></script>
    <script src="/assets/vendor/js/template-customizer.js"></script>
    <script src="/assets/js/config.js"></script>
    <style>
        /* adjust button pagination in datatables */
        .menu-item.active {
            /* background-color: #C1121F;
            background: #C1121F; */
            /* color: #C1121F; */
        }
    </style>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/" class="app-brand-link">
                        {{-- <span class="app-brand-logo demo">
                            <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#C1121F" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#C1121F" />
                            </svg>
                        </span> --}}
                        <span class="app-brand-text demo menu-text fw-bold">AMORE PUNYA</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item {{ $title == 'Dashboards' ? 'active' : '' }}">
                        <a href="/" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                        </a>
                    </li>

                    {{-- <li class="menu-item">
                        <a href="/" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-notification"></i>
                            <div data-i18n="Notifications">Notifications</div>
                        </a>
                    </li> --}}

                    {{-- <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-settings"></i>
                            <div data-i18n="Master Data">Master Data</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="app-access-roles.html" class="menu-link">
                                    <div data-i18n="Master Cuti/Izin/Sakit">Master Cuti/Izin/Sakit</div>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class="menu-item {{ $title == 'Branch' ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-building"></i>
                            <div data-i18n="Perusahaan">Perusahaan</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ $title == 'Branch' ? 'active' : '' }}">
                                <a href="{{ route('branch.list') }}" class="menu-link">
                                    <div data-i18n="Cabang">Cabang</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Jabatan' ? 'active' : '' }}">
                                <a href="{{ route('jabatan.list') }}" class="menu-link">
                                    <div data-i18n="Jabatan">Jabatan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="menu-item {{ $title == 'Employee List' || $title == 'Schedule' || $title == 'Attendance' || $title == 'Overtime' || $title == 'Perjalanan Dinas' || $title == 'Peringatan Karyawan' || $title == 'Promosi' || $title == 'Rewards' || $title == 'Pengunduran Karyawan' ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-users-group"></i>
                            <div data-i18n="Employees">Employees</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ $title == 'Employee List' ? 'active' : '' }}">
                                <a href="{{ route('employee.list') }}" class="menu-link">
                                    <div data-i18n="Employee List">Employee List</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-access-permission.html" class="menu-link">
                                    <div data-i18n="Payroll">Payroll</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Schedule' ? 'active' : '' }}">
                                <a href="{{ route('shifts') }}" class="menu-link">
                                    <div data-i18n="Schedule">Schedule</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Attendance' ? 'active' : '' }}">
                                <a href="{{ route('attendance') }}" class="menu-link">
                                    <div data-i18n="Attendance">Attendance</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Overtime' ? 'active' : '' }}">
                                <a href="{{ route('overtime') }}" class="menu-link">
                                    <div data-i18n="Overtime">Overtime</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Perjalanan Dinas' ? 'active' : '' }}">
                                <a href="{{ route('dinas_trips') }}" class="menu-link">
                                    <div data-i18n="Perjalanan Dinas">Perjalanan Dinas</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Peringatan Karyawan' ? 'active' : '' }}">
                                <a href="{{ route('employee_warning') }}" class="menu-link">
                                    <div data-i18n="Peringatan Karyawan">Peringatan Karyawan</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Promosi' ? 'active' : '' }}">
                                <a href="{{ route('employee_promotion') }}" class="menu-link">
                                    <div data-i18n="Promosi">Promosi</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Rewards' ? 'active' : '' }}">
                                <a href="{{ route('employee_rewards') }}" class="menu-link">
                                    <div data-i18n="Rewards">Rewards</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Pengunduran Karyawan' ? 'active' : '' }}">
                                <a href="{{ route('employee_resign') }}" class="menu-link">
                                    <div data-i18n="Pengunduran Karyawan">Pengunduran Karyawan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Layouts -->
                    <li class="menu-item {{ $title == 'Tipe Cuti' || $title == 'Cuti' ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-clock-off"></i>
                            <div data-i18n="Cuti">Cuti</div>
                        </a>

                        <ul class="menu-sub">
                            <li class="menu-item {{ $title == 'Tipe Cuti' ? 'active' : '' }}">
                                <a href="{{ route('master.tipe_cuti') }}" class="menu-link">
                                    <div data-i18n="Tipe Cuti">Tipe Cuti</div>
                                </a>
                            </li>
                            <li class="menu-item {{ $title == 'Cuti' ? 'active' : '' }}">
                                <a href="{{ route('leaves') }}" class="menu-link">
                                    <div data-i18n="List Cuti">List Cuti</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-wallet"></i>
                            <div data-i18n="Payroll">Payroll</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="app-access-roles.html" class="menu-link">
                                    <div data-i18n="Tipe">Tipe</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-access-permission.html" class="menu-link">
                                    <div data-i18n="Slip Gaji">Slip Gaji</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item {{ $title == 'Reimbursement' ? 'active open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-report-money"></i>
                            <div data-i18n="Finance">Finance</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ $title == 'Reimbursement' ? 'active' : '' }}">
                                <a href="{{ route('reimbursement') }}" class="menu-link">
                                    <div data-i18n="Reimbursment">Reimbursment</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-access-permission.html" class="menu-link">
                                    <div data-i18n="Loan">Loan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons ti ti-settings"></i>
                            <div data-i18n="Roles & Permissions">Roles & Permissions</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="app-access-roles.html" class="menu-link">
                                    <div data-i18n="Roles">Roles</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-access-permission.html" class="menu-link">
                                    <div data-i18n="Permission">Permission</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item {{ $title == 'Approval Permission' ? 'active' : '' }}">
                        <a href="{{ route('approval_permission') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-face-id"></i>
                            <div data-i18n="Approval Permission">Approval Permission</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <i class="ti ti-md"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                            <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                            <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                            <span class="align-middle"><i
                                                    class="ti ti-device-desktop me-2"></i>System</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="/assets/img/logo.png" alt class="h-auto rounded-circle" />

                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="/assets/img/logo.png" alt
                                                            class="h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block">{{ auth()->user()->name }}</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                                            <i class="ti ti-user-check me-2 ti-sm"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-settings me-2 ti-sm"></i>
                                            <span class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="ti ti-power-off me-2 ti-sm"></i>
                                            <span class="align-middle">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    @yield('content')
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-end py-2 flex-md-row flex-column">
                                <div>
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by
                                    <a href="" target="_blank"
                                        class="footer-link text-danger fw-medium">Amore</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="/assets/vendor/js/menu.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/libs/select2/select2.js"></script>
    <script src="/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatables-basic').DataTable({
                'paging': true,
                'searching': true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                // adjust border and border width of the table

            });
        });
    </script>

    <script src="/assets/js/forms-selects.js"></script>
</body>

</html>
