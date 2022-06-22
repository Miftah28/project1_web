<div class="container d-flex align-items-center">
    <h1 class="logo me-auto"><a href="index.html">DIMADES</a></h1>
    <nav id="navbar" class="navbar">
        <ul>
            {{-- @if($currentMenu == 'productCustomer' && $currentMenu == 'kontrakSaya') --}}
            @if($currentMenu == 'productCustomer')
            <li><a class="nav-link scrollto {{($currentMenu == 'pengunjung') ? 'active' : ''}}" href="{{route('pengunjung')}}">Home</a></li>
            <li><a class="nav-link scrollto {{($currentMenu == 'productCustomer') ? 'active' : ''}}" href="/productCustomer">Produk</a></li>
            @include('pengunjung.partials.akun')
            @else
            <li><a class="nav-link scrollto {{($currentMenu == 'pengunjung') ? 'active' : ''}}" href="{{route('pengunjung')}}">Home</a></li>
            <li><a class="nav-link scrollto" href="#VisiMisi">Visi & Misi</a></li>
            <li><a class="nav-link scrollto" href="#Demografi">Demografi</a></li>
            <li><a class="nav-link scrollto {{($currentMenu == 'productCustomer') ? 'active' : ''}}" href="/productCustomer">Produk</a></li>
            <li><a class="nav-link scrollto" href="#Mitra">Mitra</a></li>
            @include('pengunjung.partials.akun')
            @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
</div>