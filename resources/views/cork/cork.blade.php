<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Sun Earth - @yield('title') </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/src/assets/img/favicon.ico') }}" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/light/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/layouts/modern-light-menu/loader.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('assets/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/layouts/modern-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Dashboard -->
    @yield('cssanalytics')
    @yield('csssales')

    <!-- Master -->
    @yield('cssdaftarkain')
    @yield('cssdaftarproduk')
    @yield('cssdaftarproduksi')
    @yield('cssdaftarsupplier')

    @yield('cssdetailkain')
    @yield('cssdetailproduk')
    @yield('cssdetailproduksi')
    @yield('cssdetailsupplier')

    @yield('cssinsertkain')
    @yield('cssinsertproduk')
    @yield('cssinsertproduksi')
    @yield('cssinsertsupplier')

    @yield('csseditkain')
    @yield('csseditproduk')
    @yield('csseditproduksi')
    @yield('csseditsupplier')

    @yield('cssdaftardeletedkain')
    @yield('cssdaftardeletedproduk')
    @yield('cssdaftardeletedproduksi')
    @yield('cssdaftardeletedsupplier')

    <!-- Transaksi -->
    @yield('cssdaftarnotabeli')
    @yield('cssinsertnotabeli')
    @yield('csseditnotabeli')
    @yield('cssdetailnotabeli')

    @yield('cssdaftarnotajual')
    @yield('cssinsertnotajual')
    @yield('csseditnotajual')
    @yield('cssdetailnotajual')
   

    <!-- Laporan -->
    @yield('csslaporanstokkain')
    @yield('csslaporanpembeliankain')
    @yield('csslaporanproduksi')

    <!-- HRD -->
    @yield('cssdaftaruser')
    @yield('cssdetailuser')
    @yield('cssinsertuser')
    @yield('cssedituser')

    @yield('cssdaftarkaryawan')
    @yield('cssinsertkaryawan')
    @yield('csseditkaryawan')

    

    <!-- Peramalan -->
    @yield('cssperamalanbulankhusus')
    @yield('cssperamalanbulanan')
    @yield('cssperamalantahunan')

    <!-- Konfirmasi Aktivitas -->
    @yield('csskonfirmasiaktivitas')

    <!-- Log Aktivitas -->
    @yield('csslogaktivitas')

    <!-- Setting -->
    @yield('csspengaturan')
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

    <!--  BEGIN NAVBAR  -->
    <div class="header-container container-xxl">
        <header class="header navbar navbar-expand-sm expand-header">

            <a href="javascript:void(0);" class="sidebarCollapse">
                <i data-feather="menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </i>
            </a>

            <div class="search-animated toggle-search">
                <i data-feather="search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </i>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                        <i data-feather="x" class="search-close">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </i>
                    </div>
                </form>
                <span class="badge badge-secondary">Ctrl + /</span>
            </div>

            <ul class="navbar-item flex-row ms-lg-auto ms-0">

                <li class="nav-item dropdown language-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('assets/src/assets/img/1x1/id.svg') }}" class="flag-width" alt="flag">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img
                                src="{{ asset('assets/src/assets/img/1x1/id.svg') }}" class="flag-width" alt="flag">
                            <span class="align-self-center">&nbsp;Indonesia</span></a>
                        <a class="dropdown-item d-flex" href="javascript:void(0);"><img
                                src="{{ asset('assets/src/assets/img/1x1/us.svg') }}" class="flag-width" alt="flag">
                            <span class="align-self-center">&nbsp;English</span></a>
                    </div>
                </li>

                <li class="nav-item theme-toggle-item">
                    <a href="javascript:void(0);" class="nav-link theme-toggle">
                        <i data-feather="moon" class="dark-mode">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </i>
                        <i data-feather="sun" class="light-mode">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </i>
                    </a>
                </li>

                <li class="nav-item dropdown notification-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="bell"></i>
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg><span class="badge badge-success"></span>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                        <div class="drodpown-title message">
                            <h6 class="d-flex justify-content-between"><span class="align-self-center">Messages</span>
                                <span class="badge badge-primary">9 Unread</span>
                            </h6>
                        </div>
                        <div class="notification-scroll">
                            <div class="dropdown-item">
                                <div class="media server-log">
                                    <img src="{{ asset('assets/src/assets/img/profile-16.jpeg') }}"
                                        class="img-fluid me-2" alt="avatar">
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Yongky Setiawan</h6>
                                            <p class="">1 hr ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                            <line x1="18" y1="6" x2="6" y2="18">
                                            </line>
                                            <line x1="6" y1="6" x2="18" y2="18">
                                            </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media ">
                                    <img src="{{ asset('assets/src/assets/img/profile-15.jpeg') }}"
                                        class="img-fluid me-2" alt="avatar">
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Ezra Putra</h6>
                                            <p class="">8 hrs ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                            <line x1="18" y1="6" x2="6" y2="18">
                                            </line>
                                            <line x1="6" y1="6" x2="18" y2="18">
                                            </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media file-upload">
                                    <img src="{{ asset('assets/src/assets/img/profile-21.jpeg') }}"
                                        class="img-fluid me-2" alt="avatar">
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Steven Poerwantoro</h6>
                                            <p class="">14 hrs ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                            <line x1="18" y1="6" x2="6" y2="18">
                                            </line>
                                            <line x1="6" y1="6" x2="18" y2="18">
                                            </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="drodpown-title notification mt-2">
                                <h6 class="d-flex justify-content-between"><span
                                        class="align-self-center">Notifications</span> <span
                                        class="badge badge-secondary">16 New</span></h6>
                            </div>

                            <div class="dropdown-item">
                                <div class="media server-log">
                                    <i data-feather="server"></i>
                                    <rect x="2" y="2" width="20" height="8" rx="2" ry="2">
                                    </rect>
                                    <rect x="2" y="14" width="20" height="8" rx="2" ry="2">
                                    </rect>
                                    <line x1="6" y1="6" x2="6" y2="6"></line>
                                    <line x1="6" y1="18" x2="6" y2="18"></line>
                                    </svg>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Server Rebooted</h6>
                                            <p class="">45 min ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                            <line x1="18" y1="6" x2="6" y2="18">
                                            </line>
                                            <line x1="6" y1="6" x2="18" y2="18">
                                            </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media file-upload">
                                    <i data-feather="file-text"></i>
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Kelly Portfolio.pdf</h6>
                                            <p class="">670 kb</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                            <line x1="18" y1="6" x2="6" y2="18">
                                            </line>
                                            <line x1="6" y1="6" x2="18" y2="18">
                                            </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-heart">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Licence Expiring Soon</h6>
                                            <p class="">8 hrs ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18">
                                                </line>
                                                <line x1="6" y1="6" x2="18" y2="18">
                                                </line>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </li>

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="{{ asset('assets/src/assets/img/profile-bumi.jpg') }}"
                                    class="rounded-circle">
                            </div>
                        </div>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="user-profile-section">
                            <div class="media mx-auto">
                                <div class="emoji me-2">
                                    &#x1F44B;
                                </div>
                                <div class="media-body">
                                    <h5>Bagus Surya Bumi</h5>
                                    <p>Pemilik</p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-item">
                            <a href="#">
                                <i data-feather="user"></i>
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                                </svg> <span>Profile</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="#">
                                <i data-feather="inbox"></i>
                                <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                <path
                                    d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                </path>
                                </svg> <span>Inbox</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="#">
                                <i data-feather="lock"></i>
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                </rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg> <span>Lock Screen</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="#">
                                <i data-feather="log-out"></i>
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg> <span>Log Out</span>
                            </a>
                        </div>
                    </div>

                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">

            <nav id="sidebar">

                <div class="navbar-nav theme-brand flex-row  text-center">
                    <div class="nav-logo">
                        <div class="nav-item theme-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/src/assets/img/logo3.svg') }}"
                                    alt="logo">
                            </a>
                        </div>
                        <div class="nav-item theme-text">
                            <a href="{{ route('home') }}" class="nav-link">Sun Earth</a>
                        </div>
                    </div>
                    <div class="nav-item sidebar-toggle">
                        <div class="btn-toggle sidebarCollapse">
                            <i data-feather="chevrons-left"></i>
                        </div>
                    </div>
                </div>

                <div class="profile-info">
                    <div class="user-info">
                        <div class="profile-img">
                            <img src="{{ asset('assets/src/assets/img/profile-bumi.jpg') }}" alt="avatar">
                        </div>
                        <div class="profile-content">
                            <h6 class="">Bagus Surya Bumi</h6>
                            <p class="">Pemilik</p>
                        </div>
                    </div>
                </div>

                <div class="shadow-bottom"></div>

                <ul class="list-unstyled menu-categories" id="accordionExample">

                    <li class="menu {{ request()->routeIs(['dashboard.*','home']) ? 'active' : '' }}">
                        <a href="#dashboard" data-bs-toggle="collapse"
                            aria-expanded="{{ request()->routeIs(['dashboard.*','home']) ? 'true' : 'false' }}"
                            class="dropdown-toggle">
                            <div class="">
                                <i data-feather="home"></i>
                                <span>Dashboard</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                                <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['dashboard.*', 'home']) ? 'show' : '' }}"
                            id="dashboard" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs(['dashboard.analytics*', 'home']) ? 'active' : '' }}">
                                <a href="{{ route('dashboard.analytics') }}"> Analytics </a>
                            </li>
                            <li class="{{ request()->routeIs('dashboard.sales*') ? 'active' : '' }}">
                                <a href="{{ route('dashboard.sales') }}"> Sales </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['kain.*', 'produk.*', 'produksi.*', 'supplier.*']) ? 'active' : '' }}">
                        <a href="#master" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs(['kain.*', 'produk.*', 'produksi.*', 'supplier.*']) ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="grid"></i>
                                <span>Master</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                                <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['kain.*', 'produk.*', 'produksi.*', 'supplier.*']) ? 'show' : '' }}" id="master" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs('kain.*') ? 'active' : '' }}">
                                <a href="{{ route('kain.index') }}"> Kain </a>
                            </li>
                            <li class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
                                <a href="{{ route('produk.index') }}"> Produk </a>
                            </li>
                            <li class="{{ request()->routeIs('produksi.*') ? 'active' : '' }}">
                                <a href="{{ route('produksi.index') }}"> Produksi </a>
                            </li>
                            <li class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}">
                                <a href="{{ route('supplier.index') }}"> Supplier </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['notabeli.*', 'notajual.*']) ? 'active' : '' }}">
                        <a href="#transaksi" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs(['notabeli.*', 'notajual.*']) ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="shopping-bag"></i>
                                <span>Transaksi</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                                <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['notabeli.*', 'notajual.*']) ? 'show' : '' }}" id="transaksi" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs(['notabeli*']) ? 'active' : '' }}">
                                <a href="{{ route('notabeli.index') }}"> Pembelian </a>
                            </li>
                            <li class="{{ request()->routeIs(['notajual*']) ? 'active' : '' }}">
                                <a href="{{ route('notajual.index') }}"> Penjualan </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['laporan.*']) ? 'active' : '' }}">
                        <a href="#laporan" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs(['laporan.*']) ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="file-text"></i>
                                <span>Laporan</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                                <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['laporan.*']) ? 'show' : '' }}" id="laporan" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs(['laporan.stokkain*']) ? 'active' : '' }}">
                                <a href="{{ route('laporan.stokkain') }}"> Stok Kain </a>
                            </li>
                            <li class="{{ request()->routeIs(['laporan.pembeliankain*']) ? 'active' : '' }}">
                                <a href="{{ route('laporan.pembeliankain') }}"> Pembelian Kain </a>
                            </li>
                            <li class="{{ request()->routeIs(['laporan.produksi*']) ? 'active' : '' }}">
                                <a href="{{ route('laporan.produksi') }}"> Produksi </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['karyawan.*']) ? 'active' : '' }}">
                        <a href="#hrd" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs(['karyawan.*']) ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="users"></i>
                                <span>HRD</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                                <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['karyawan.*']) ? 'show' : '' }}" id="hrd" data-bs-parent="#accordionExample">
                            {{-- <li class="{{ request()->routeIs(['hrd.daftaruser*']) ? 'active' : '' }}">
                                <a href="{{ route('hrd.daftaruser') }}"> Users </a>
                            </li> --}}
                            <li>
                                <a href="#"> Register </a>
                            </li>
                            <li class="{{ request()->routeIs(['karyawan.*']) ? 'active' : '' }}">
                                <a href="{{ route('karyawan.index') }}"> Karyawan </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['peramalan.*']) ? 'active' : '' }}">
                        <a href="#peramalan" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs(['peramalan.*']) ? 'true' : 'false' }}" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="trending-up"></i>
                                <span>Peramalan</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                                <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['peramalan.*']) ? 'show' : '' }}" id="peramalan" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs(['peramalan.bulankhusus*']) ? 'active' : '' }}">
                                <a href="{{ route('peramalan.bulankhusus') }}"> Bulan Khusus </a>
                            </li>
                            <li class="{{ request()->routeIs(['peramalan.bulanan*']) ? 'active' : '' }}">
                                <a href="{{ route('peramalan.bulanan') }}"> Bulanan </a>
                            </li>
                            <li class="{{ request()->routeIs(['peramalan.tahunan*']) ? 'active' : '' }}">
                                <a href="{{ route('peramalan.tahunan') }}"> Tahunan </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['konfirmasiaktivitas.*']) ? 'active' : '' }}">
                        <a href="{{ route('konfirmasiaktivitas.index') }}" aria-expanded="false"
                            class="dropdown-toggle">
                            <div class="">
                                <i data-feather="check-square"></i>
                                <span>Konfirmasi Aktivitas</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu {{ request()->routeIs(['logaktivitas.*']) ? 'active' : '' }}">
                        <a href="{{ route('logaktivitas.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="shield"></i>
                                <span>Log Aktivitas</span>
                            </div>
                        </a>
                    </li>

                    {{-- <li class="menu">
                        <a href="#" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="settings"></i>
                                <span>Pengaturan</span>
                            </div>
                        </a>
                    </li> --}}

                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">
                    

                    <!-- Dashboard -->
                    @yield('kontenanalytics')
                    @yield('kontensales')

                    <!-- Master -->
                    @yield('kontendaftarkain')
                    @yield('kontendaftarproduk')
                    @yield('kontendaftarproduksi')
                    @yield('kontendaftarsupplier')

                    @yield('kontendetailkain')
                    @yield('kontendetailproduk')
                    @yield('kontendetailproduksi')
                    @yield('kontendetailsupplier')

                    @yield('konteninsertkain')
                    @yield('konteninsertproduk')
                    @yield('konteninsertproduksi')
                    @yield('konteninsertsupplier')

                    @yield('konteneditkain')
                    @yield('konteneditproduk')
                    @yield('konteneditproduksi')
                    @yield('konteneditsupplier')

                    @yield('kontendaftardeletedkain')
                    @yield('kontendaftardeletedproduk')
                    @yield('kontendaftardeletedproduksi')
                    @yield('kontendaftardeletedsupplier')

                    <!-- Transaksi -->
                    @yield('kontendaftarnotabeli')
                    @yield('konteninsertnotabeli')
                    @yield('konteneditnotabeli')
                    @yield('kontendetailnotabeli')
                    
                    @yield('kontendaftarnotajual')
                    @yield('konteninsertnotajual')
                    @yield('konteneditnotajual')
                    @yield('kontendetailnotajual')

                    <!-- Laporan -->
                    @yield('kontenlaporanstokkain')
                    @yield('kontenlaporanpembeliankain')
                    @yield('kontenlaporanproduksi')

                    <!-- HRD -->
                    @yield('kontendaftaruser')
                    @yield('kontendetailuser')
                    @yield('kontensettinguser')

                    @yield('kontendaftarkaryawan')
                    @yield('konteninsertkaryawan')
                    @yield('konteneditkaryawan')

                    <!-- Peramalan -->
                    @yield('kontenperamalanbulankhusus')
                    @yield('kontenperamalanbulanan')
                    @yield('kontenperamalantahunan')

                    <!-- Konfirmasi Aktivitas -->
                    @yield('kontenkonfirmasiaktivitas')

                    <!-- Log Aktivitas -->
                    @yield('kontenlogaktivitas')

                    <!-- Setting -->
                    @yield('kontenpengaturan')
                </div>

            </div>
            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2023</span> <a target="_blank"
                            href="https://designreset.com/cork-admin/">Sun Earth</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded by Datesunearth
                        <i data-feather="heart"></i>
                    </p>
                </div>
            </div>
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/layouts/modern-light-menu/app.js') }}"></script>
    <script>
        feather.replace();
    </script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- Dashboard -->
    @yield('jsanalytics')
    @yield('jssales')

    <!-- Master -->
    @yield('jsdaftarkain')
    @yield('jsdaftarproduk')
    @yield('jsdaftarproduksi')
    @yield('jsdaftarsupplier')

    @yield('jsdetailkain')
    @yield('jsdetailproduk')
    @yield('jsdetailproduksi')
    @yield('jsdetailsupplier')

    @yield('jsinsertkain')
    @yield('jsinsertproduk')
    @yield('jsinsertproduksi')
    @yield('jsinsertsupplier')

    @yield('jseditkain')
    @yield('jseditproduk')
    @yield('jseditproduksi')
    @yield('jseditsupplier')

    @yield('jsdaftardeletedkain')
    @yield('jsdaftardeletedproduk')
    @yield('jsdaftardeletedproduksi')
    @yield('jsdaftardeletedsupplier')

    <!-- Transaksi -->
    @yield('jsdaftarnotabeli')
    @yield('jsinsertnotabeli')
    @yield('jseditnotabeli')
    @yield('jsdetailnotabeli')
    @yield('jsdaftardeletedbuyorder')

    @yield('jsdaftarnotajual')
    @yield('jsinsertnotajual')
    @yield('jseditnotajual')
    @yield('jsdetailnotajual')

    <!-- Laporan -->
    @yield('jslaporanstokkain')
    @yield('jslaporanpembeliankain')
    @yield('jslaporanproduksi')

    <!-- HRD -->
    @yield('jsdaftaruser')
    @yield('jsdetailuser')
    @yield('jssettinguser')

    @yield('jsdaftarkaryawan')
    @yield('jsinsertkaryawan')
    @yield('jseditkaryawan')
    

    <!-- Peramalan -->
    @yield('jsperamalanbulankhusus')
    @yield('jsperamalanbulanan')
    @yield('jsperamalantahunan')

    <!-- Konfirmasi Aktivitas -->
    @yield('jskonfirmasiaktivitas')

    <!-- Log Aktivitas -->
    @yield('jslogaktivitas')

    <!-- Setting -->
    @yield('jspengaturan')

</body>

</html>