<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/src/assets/img/earth.png') }}" />
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

    @yield('css')

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

            {{-- <div class="search-animated toggle-search">
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
            </div> --}}

            <ul class="navbar-item flex-row ms-lg-auto ms-0">

                {{-- <li class="nav-item dropdown language-dropdown">
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
                </li> --}}

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

                {{-- <li class="nav-item dropdown notification-dropdown">
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
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Server Rebooted</h6>
                                            <p class="">45 min ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media file-upload">
                                    <i data-feather="file-text"></i>
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Kelly Portfolio.pdf</h6>
                                            <p class="">670 kb</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-item">
                                <div class="media ">
                                    <i data-feather="heart"></i>                                
                                    <div class="media-body">
                                        <div class="data-info">
                                            <h6 class="">Licence Expiring Soon</h6>
                                            <p class="">8 hrs ago</p>
                                        </div>

                                        <div class="icon-status">
                                            <i data-feather="x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </li> --}}

                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar-container">
                            <div class="avatar avatar-sm avatar-indicators avatar-online">
                                <img alt="avatar" src="{{ asset('assets/src/assets/img/user.png') }}"
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
                                    <h5>{{ auth()->user()->nama }}</h5>
                                    <p>{{ auth()->user()->role }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="dropdown-item">
                            <a href="{{ route('user.show', auth()->user()->id ) }}">
                                <i data-feather="user"></i>
                                <span>Profile</span>
                            </a>
                        </div> --}}
                        {{-- <div class="dropdown-item">
                            <a href="#">
                                <i data-feather="inbox"></i>
                                <span>Inbox</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="#">
                                <i data-feather="lock"></i>
                                <span>Lock Screen</span>
                            </a>
                        </div> --}}
                        {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf --}}
                            <div class="dropdown-item">
                                <a href="{{ route('logout') }}">
                                    <i data-feather="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </div>
                            {{--
                        </form> --}}
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
                            <a href="{{ route('dashboard') }}">
                                <img src="{{ asset('assets/src/assets/img/earth.png') }}" alt="logo">
                            </a>
                        </div>
                        <div class="nav-item theme-text">
                            <a href="{{ route('dashboard') }}" class="nav-link">SunEarth</a>
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
                            <img src="{{ asset('assets/src/assets/img/user.png') }}" alt="avatar">
                        </div>
                        <div class="profile-content">
                            <h6 class="">{{ auth()->user()->nama }}</h6>
                            <p class="">{{ auth()->user()->role }}</p>
                        </div>
                    </div>
                </div>

                <div class="shadow-bottom"></div>

                <ul class="list-unstyled menu-categories" id="accordionExample">

                    <li class="menu {{ request()->routeIs(['dashboard']) ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="home"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <li
                        class="menu {{ request()->routeIs(['kain.*', 'produk.*', 'supplier.*', 'kategoriproduk.*', 'kategorikain.*', 'rak.*', 'musim.*', 'ukuran.*']) ? 'active' : '' }}">
                        <a href="#master" data-bs-toggle="collapse"
                            aria-expanded="{{ request()->routeIs(['kain.*', 'produk.*', 'supplier.*', 'kategoriproduk.*', 'kategorikain.*', 'rak.*', 'musim.*', 'ukuran.*']) ? 'true' : 'false' }}"
                            class="dropdown-toggle">
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
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['kain.*', 'produk.*', 'supplier.*', 'kategoriproduk.*', 'kategorikain.*', 'rak.*', 'musim.*', 'ukuran.*']) ? 'show' : '' }}"
                            id="master" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs('kain.*') ? 'active' : '' }}">
                                <a href="{{ route('kain.index') }}"> Kain </a>
                            </li>
                            <li class="{{ request()->routeIs('produk.*') ? 'active' : '' }}">
                                <a href="{{ route('produk.index') }}"> Produk </a>
                            </li>
                            @auth
                            @if(auth()->user()->hasRole('Pemilik'))
                            <li class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}">
                                <a href="{{ route('supplier.index') }}"> Supplier </a>
                            </li>
                            @endif
                            @endauth
                            <li class="{{ request()->routeIs('rak.*') ? 'active' : '' }}">
                                <a href="{{ route('rak.index') }}"> Rak </a>
                            </li>
                            <li class="{{ request()->routeIs('ukuran.*') ? 'active' : '' }}">
                                <a href="{{ route('ukuran.index') }}"> Ukuran </a>
                            </li>
                            <li class="{{ request()->routeIs('kategorikain.*') ? 'active' : '' }}">
                                <a href="{{ route('kategorikain.index') }}"> Kategori Kain </a>
                            </li>
                            <li class="{{ request()->routeIs('kategoriproduk.*') ? 'active' : '' }}">
                                <a href="{{ route('kategoriproduk.index') }}"> Kategori Produk </a>
                            </li>
                            <li class="{{ request()->routeIs('musim.*') ? 'active' : '' }}">
                                <a href="{{ route('musim.index') }}"> Musim </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="menu {{ request()->routeIs(['produksi.*']) ? 'active' : '' }}">
                        <a href="#produksi" data-bs-toggle="collapse"
                            aria-expanded="{{ request()->routeIs(['produksi.*']) ? 'true' : 'false' }}"
                            class="dropdown-toggle">
                            <div class="">
                                <i data-feather="target"></i>
                                <span>Produksi</span>
                            </div>
                            <div>
                                <i data-feather="chevron-right"></i>
                                <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['produksi.*']) ? 'show' : '' }}"
                            id="produksi" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs('produksi.*') ? 'active' : '' }}">
                                <a href="{{ route('produksi.index') }}"> Produksi </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['notabeli.*', 'notajual.*']) ? 'active' : '' }}">
                        <a href="#transaksi" data-bs-toggle="collapse"
                            aria-expanded="{{ request()->routeIs(['notabeli.*', 'notajual.*']) ? 'true' : 'false' }}"
                            class="dropdown-toggle">
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
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['notabeli.*', 'notajual.*']) ? 'show' : '' }}"
                            id="transaksi" data-bs-parent="#accordionExample">
                            @auth
                            @if(auth()->user()->hasRole('Pemilik'))
                            <li class="{{ request()->routeIs(['notabeli*']) ? 'active' : '' }}">
                                <a href="{{ route('notabeli.index') }}"> Pembelian </a>
                            </li>
                            @endif
                            @endauth
                            <li class="{{ request()->routeIs(['notajual*']) ? 'active' : '' }}">
                                <a href="{{ route('notajual.index') }}"> Penjualan </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['laporan.*']) ? 'active' : '' }}">
                        <a href="#laporan" data-bs-toggle="collapse"
                            aria-expanded="{{ request()->routeIs(['laporan.*']) ? 'true' : 'false' }}"
                            class="dropdown-toggle">
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
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['laporan.*']) ? 'show' : '' }}"
                            id="laporan" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs(['laporan.stokkain*']) ? 'active' : '' }}">
                                <a href="{{ route('laporan.stokkain') }}"> Stok Kain </a>
                            </li>
                            @auth
                            @if(auth()->user()->hasRole('Pemilik'))
                            <li class="{{ request()->routeIs(['laporan.pembeliankain*']) ? 'active' : '' }}">
                                <a href="{{ route('laporan.pembeliankain') }}"> Pembelian Kain </a>
                            </li>
                            @endif
                            @endauth
                            <li class="{{ request()->routeIs(['laporan.produksi*']) ? 'active' : '' }}">
                                <a href="{{ route('laporan.produksi') }}"> Produksi </a>
                            </li>
                            <li class="{{ request()->routeIs(['laporan.penggunaankain*']) ? 'active' : '' }}">
                                <a href="{{ route('laporan.penggunaankain') }}">Penggunaan Kain</a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['karyawan.*', 'user.*']) ? 'active' : '' }}">
                        <a href="#hrd" data-bs-toggle="collapse"
                            aria-expanded="{{ request()->routeIs(['karyawan.*', 'user.*']) ? 'true' : 'false' }}"
                            class="dropdown-toggle">
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
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['karyawan.*', 'user.*']) ? 'show' : '' }}"
                            id="hrd" data-bs-parent="#accordionExample">
                            @auth
                            @if(auth()->user()->hasRole('Pemilik'))
                            <li class="{{ request()->routeIs(['user.*']) ? 'active' : '' }}">
                                <a href="{{ route('user.index') }}"> Users </a>
                            </li>
                            @endif
                            @endauth
                            <li class="{{ request()->routeIs(['karyawan.*']) ? 'active' : '' }}">
                                <a href="{{ route('karyawan.index') }}"> Karyawan </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu {{ request()->routeIs(['peramalan.*']) ? 'active' : '' }}">
                        <a href="#peramalan" data-bs-toggle="collapse"
                            aria-expanded="{{ request()->routeIs(['peramalan.*']) ? 'true' : 'false' }}"
                            class="dropdown-toggle">
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
                        <ul class="collapse submenu list-unstyled {{ request()->routeIs(['peramalan.*']) ? 'show' : '' }}"
                            id="peramalan" data-bs-parent="#accordionExample">
                            <li class="{{ request()->routeIs(['peramalan.musiman*']) ? 'active' : '' }}">
                                <a href="{{ route('peramalan.musiman') }}"> Musiman </a>
                            </li>
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

                    {{-- <li class="menu {{ request()->routeIs(['estimasi.*']) ? 'active' : '' }}">
                        <a href="{{ route('estimasi.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="shield"></i>
                                <span>Estimasi Kain</span>
                            </div>
                        </a>
                    </li> --}}

                    {{-- @auth
                    @if(auth()->user()->hasRole('Pemilik'))
                    <li class="menu {{ request()->routeIs(['logaktivitas.*']) ? 'active' : '' }}">
                        <a href="{{ route('logaktivitas.index') }}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i data-feather="shield"></i>
                                <span>Log Aktivitas</span>
                            </div>
                        </a>
                    </li>
                    @endif
                    @endauth --}}
                

                </ul>

            </nav>

        </div>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    @yield('konten')

                </div>

            </div>
            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2023</span> <a target="_blank"
                            href="https://designreset.com/cork-admin/">CV Adonai Suritama</a>, All rights reserved.</p>
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

    @yield('js')


</body>

</html>