@extends('modernize.modernize')
@section('daftarkain')
<div class="card-body p-4">
    <h5 class="card-title fw-semibold mb-4">Daftar Kain</h5>
    <div>
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <li class="nav-item dropdown">
                <a class="btn btn-secondary" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-adjustments"></i>
                    Filter
                </a>
                <a class="btn btn-primary" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-adjustments"></i>
                    Filter
                </a>
                <a class="btn btn-success" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-adjustments"></i>
                    Filter
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">My Profile</p>
                        </a>
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-mail fs-6"></i>
                            <p class="mb-0 fs-3">My Account</p>
                        </a>
                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-list-check fs-6"></i>
                            <p class="mb-0 fs-3">My Task</p>
                        </a>
                        <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <h6 class="fw-semibold mb-0">KODE</h6>
                                    <i class="ti ti-sort-ascending"></i>
                                </a>
                            </th>
                            <th class="border-bottom-0">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <h6 class="fw-semibold mb-0">JENIS KAIN</h6>
                                    <i class="ti ti-sort-ascending"></i>
                                </a>
                            </th>
                            <th class="border-bottom-0">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <h6 class="fw-semibold mb-0">WARNA</h6>
                                    <i class="ti ti-sort-ascending"></i>
                                </a>
                            </th>
                            <th class="border-bottom-0">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <h6 class="fw-semibold mb-0">KATEGORI</h6>
                                    <i class="ti ti-sort-ascending"></i>
                                </a>
                            </th>
                            <th class="border-bottom-0">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <h6 class="fw-semibold mb-0">STOK</h6>
                                    <i class="ti ti-sort-ascending"></i>
                                </a>
                            </th>
                            <th class="border-bottom-0">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <h6 class="fw-semibold mb-0">LOKASI RAK</h6>
                                    <i class="ti ti-sort-ascending"></i>
                                </a>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">OPSI</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">CTP6319</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">COTT PRINT 40S</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">MERAH</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">PRINTING</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">1200</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">A1</h6>
                            </td>
                            <td class="border-bottom-0">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">Detail</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">Edit</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">Delete</p>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">CTP6319</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">COTT PRINT 40S</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">MERAH</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">PRINTING</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">1200</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0 fw-normal">A1</h6>
                            </td>
                            <td class="border-bottom-0">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">Detail</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">Edit</p>
                                        </a>
                                        <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">Delete</p>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection