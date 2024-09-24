@extends('cork.cork')

@section('title', 'Daftar User')

@section('cssdaftaruser')
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('assets/src/assets/css/light/components/modal.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/light/apps/contacts.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/src/assets/css/dark/components/modal.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/src/assets/css/dark/apps/contacts.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
@endsection

@section('kontendaftaruser')

<!-- BREADCRUMB -->
<div class="page-meta">
    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">HRD</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar User</li>
        </ol>
    </nav>
</div>
<!-- /BREADCRUMB -->

<div class="row layout-top-spacing">
    <div id="tableCustomBasic" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Daftar User</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="{{ asset('assets/src/assets/img/profile-bumi.jpg') }}" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">Bagus Surya Bumi</h6>
                                            <span>bagus.surya@mail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">CEO</p>
                                    <span class="text-success">Management</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-success">Online</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="{{route('hrd.detailuser')}}" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i data-feather="edit-2"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="{{ asset('assets/src/assets/img/profile-11.jpeg') }}" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">Ezra Putra</h6>
                                            <span>ezra.putra@mail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">Lead Developer</p>
                                    <span class="text-secondary">Programmer</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-secondary">Waiting</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i data-feather="edit-2"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="{{ asset('assets/src/assets/img/profile-5.jpeg') }}" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">Yongky Setiawan</h6>
                                            <span>yongkys@mail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">HR</p>
                                    <span class="text-danger">Management</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light-danger">Offline</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i data-feather="edit-2"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div class="media">
                                        <div class="avatar me-2">
                                            <img alt="avatar" src="{{ asset('assets/src/assets/img/profile-34.jpeg') }}" class="rounded-circle" />
                                        </div>
                                        <div class="media-body align-self-center">
                                            <h6 class="mb-0">Karina Maharani</h6>
                                            <span>karina.maharani@mail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">Lead Designer</p>
                                    <span class="text-info">Graphic</span>
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-light-info">On Hold</span>
                                </td>
                                <td class="text-center">
                                    <div class="action-btns">
                                        <a href="javascript:void(0);" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View">
                                            <i data-feather="eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i data-feather="edit-2"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="action-btn btn-delete bs-tooltip" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i data-feather="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsdaftaruser')
<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/custom.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('assets/src/plugins/src/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/src/assets/js/apps/contact.js') }}"></script>
@endsection