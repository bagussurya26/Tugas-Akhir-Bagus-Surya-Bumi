<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Invoice Add | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/src/assets/img/favicon.ico') }}" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/light/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/layouts/modern-light-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/src/plugins/src/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">

    <link href="{{ asset('assets/src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/src/assets/css/light/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/src/plugins/css/dark/filepond/custom-filepond.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/src/assets/css/dark/apps/invoice-add.css') }}" rel="stylesheet" type="text/css" />

    <!--  END CUSTOM STYLE FILE  -->

</head>

<body class="layout-boxed">

    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->


    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>


        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <div class="row mb-4 layout-spacing">

                        {{-- <form enctype="multipart/form-data" class="row g-3" method="POST"
                            action="{{ route('produksi.store') }}"> --}}
                            @csrf

                            <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                <div class="widget-content widget-content-area ecommerce-create-section">

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label>Kode Produksi</label>
                                            <div class="col-sm-12">
                                                <input type="text" value="{{ old('id') }}"
                                                    class="form-control @error('id') is-invalid @enderror" name="id"
                                                    placeholder="Kode Produksi" autofocus>
                                                @error('id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            <label class="form-label">Tanggal Mulai</label>
                                            <input name="tgl_mulaii" id="basicFlatpickr1"
                                                class="form-control flatpickr flatpickr-input active @error('tgl_mulai') is-invalid @enderror"
                                                type="text" placeholder="Pilih tanggal.."
                                                value="{{ old('tgl_mulaii') }}">
                                            @error('tgl_mulai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Tanggal Selesai</label>
                                            <input name="tgl_selesai" id="basicFlatpickr2"
                                                class="form-control flatpickr flatpickr-input active @error('tgl_selesai') is-invalid @enderror"
                                                type="text" placeholder="Pilih Tanggal.."
                                                value="{{ old('tgl_selesai') }}">
                                            @error('tgl_selesai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-12">
                                            <label for="input-keterangan">Keterangan</label>
                                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                                value="{{ old('keterangan') }}" id="input-keterangan" rows="5"
                                                placeholder="Keterangan" name="keterangan"></textarea>
                                            @error('keterangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div
                                    class="widget-content widget-content-area ecommerce-create-section layout-top-spacing">

                                    <div class="invoice-detail-terms">

                                        <div class="row justify-content-between">

                                            <div class="col-md-3">

                                                <div class="form-group mb-4">
                                                    <label for="number">Invoice Number</label>
                                                    <input type="text" class="form-control form-control-sm" id="number"
                                                        placeholder="#0001">
                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <div class="form-group mb-4">
                                                    <label for="date">Invoice Date</label>
                                                    <input type="text" class="form-control form-control-sm" id="date"
                                                        placeholder="Add date picker">
                                                </div>

                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mb-4">
                                                    <label for="due">Due Date</label>
                                                    <input type="text" class="form-control form-control-sm" id="due"
                                                        placeholder="None">
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="invoice-detail-items">

                                        <div class="table-responsive">
                                            <table class="table item-table">
                                                <thead>
                                                    <tr>
                                                        <th class=""></th>
                                                        <th>Description</th>
                                                        <th class="">Rate</th>
                                                        <th class="">Qty</th>
                                                        <th class="text-right">Amount</th>
                                                        <th class="text-center">Tax</th>
                                                    </tr>
                                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="delete-item-row">
                                                            <ul class="table-controls">
                                                                <li><a href="javascript:void(0);" class="delete-item"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="" data-original-title="Delete"><i
                                                                            data-feather="x-circle"></i></a></li>
                                                            </ul>
                                                        </td>
                                                        <td class="description"><input type="text"
                                                                class="form-control form-control-sm"
                                                                placeholder="Item Description">
                                                            <textarea class="form-control"
                                                                placeholder="Additional Details"></textarea>
                                                        </td>
                                                        <td class="rate">
                                                            <input type="text" class="form-control form-control-sm"
                                                                placeholder="Price">
                                                        </td>
                                                        <td class="text-right qty"><input type="text"
                                                                class="form-control form-control-sm"
                                                                placeholder="Quantity"></td>
                                                        <td class="text-right amount"><span
                                                                class="editable-amount"><span class="currency">$</span>
                                                                <span class="amount">100.00</span></span></td>
                                                        <td class="text-center tax">
                                                            <div class="n-chk">
                                                                <div
                                                                    class="form-check form-check-primary form-check-inline me-0 mb-0">
                                                                    <input
                                                                        class="form-check-input inbox-chkbox contact-chkbox"
                                                                        type="checkbox">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <button class="btn btn-dark additem">Add Item</button>

                                    </div>

                                </div>

                            </div>

                            <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                <div class="row">
                                    <div class="col-xxl-12 col-xl-8 col-lg-8 col-md-7 mt-xxl-0 mt-4">
                                        <div class="widget-content widget-content-area ecommerce-create-section">
                                            <div class="row mb-4">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-danger w-100">Reset</button>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success w-100" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/layouts/modern-light-menu/app.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <script src="{{ asset('assets/src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/src/assets/js/apps/invoice-add.js') }}"></script>
</body>

</html>