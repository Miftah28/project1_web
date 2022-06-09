<!-- ====================================
        ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="/index.html" title="Sleek Dashboard">
                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>

                <span class="brand-name text-truncate">DIMADES</span>
            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="" data-simplebar style="height: 100%;">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="{{($currentAdminMenu == 'dashboard')?'active':''}}">
                    <a class="sidenav-item-link" href="/home" aria-expanded="false" aria-controls="dashboard">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span> <b class="caret"></b>
                    </a>
                </li>

                <li class="{{($currentAdminMenu == 'category')?'active':''}}">
                    <a class="sidenav-item-link" href="{{ route('categories.index') }}" aria-expanded="false" aria-controls="app">
                        <i class="mdi mdi-sitemap"></i>
                        <span class="nav-text">Kategori</span> <b class="caret"></b>
                    </a>
                </li>

                <li class="{{($currentAdminMenu == 'product')?'active':''}}">
                    <a class="sidenav-item-link" href="{{ route('products.index') }}" aria-expanded="false" aria-controls="components">
                        <i class="mdi mdi-package-variant"></i>
                        <span class="nav-text">Produk</span> <b class="caret"></b>
                    </a>
                </li>

                <li class="{{($currentAdminMenu == 'mitra')?'active':''}}">
                    <a class="sidenav-item-link" href="/mitra" aria-expanded="false" aria-controls="icons">
                        <i class="mdi mdi-account"></i>
                        <span class="nav-text">Mitra</span> <b class="caret"></b>
                    </a>
                </li>

                <li class="{{($currentAdminMenu == 'request')?'active':''}}">
                    <a class="sidenav-item-link" href="{{ route('permintaan.index') }}" aria-expanded="false" aria-controls="icons">
                        <i class="mdi mdi-file-document"></i>
                        <span class="nav-text">Permintaan</span> <b class="caret"></b>
                    </a>
                </li>
                <li class="{{($currentAdminMenu == 'request')?'active':''}}">
                    <a class="sidenav-item-link" href="{{ route('permintaan.index') }}" aria-expanded="false" aria-controls="icons">
                        <i class="mdi mdi-file-document"></i>
                        <span class="nav-text">Laporan</span> <b class="caret"></b>
                    </a>
                </li>
            </ul>
        </div>

        <div class="sidebar-footer">
            <hr class="separator mb-0" />
            <!-- <div class="sidebar-footer-content">
            </div> -->
        </div>
    </div>
</aside>