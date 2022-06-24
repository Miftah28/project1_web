<?php

use Illuminate\Support\Facades\Auth;

$auth = Auth::check();
if ($auth) {
    $nama = Auth::user()->name;
    $email = Auth::user()->email;
}

?>
@if ($auth)
@if($currentMenu == 'productCustomer')
<li><a class="nav-link scrollto {{($currentMenu == 'pengunjung') ? 'active' : ''}}" href="{{route('pengunjung')}}">Home</a></li>
<li><a class="nav-link scrollto {{($currentMenu == 'productCustomer') ? 'active' : ''}}" href="/productCustomer">Produk</a></li>
<li><a class="nav-link scrollto {{ $currentMenu == 'kontrak' ? 'active' : '' }}" href="/kontrakSaya">Kontrak
        Saya</a></li>
@elseif($currentMenu == 'kontrak')
<li><a class="nav-link scrollto {{($currentMenu == 'pengunjung') ? 'active' : ''}}" href="{{route('pengunjung')}}">Home</a></li>
<li><a class="nav-link scrollto {{($currentMenu == 'productCustomer') ? 'active' : ''}}" href="/productCustomer">Produk</a></li>
<li><a class="nav-link scrollto {{ $currentMenu == 'kontrak' ? 'active' : '' }}" href="/kontrakSaya">Kontrak
        Saya</a></li>
@else
<li><a class="nav-link scrollto {{($currentMenu == 'pengunjung') ? 'active' : ''}}" href="{{route('pengunjung')}}">Home</a></li>
<li><a class="nav-link scrollto" href="#VisiMisi">Visi & Misi</a></li>
<li><a class="nav-link scrollto" href="#Demografi">Demografi</a></li>
<li><a class="nav-link scrollto" href="#Mitra">Mitra</a></li>
<li><a class="nav-link scrollto {{($currentMenu == 'productCustomer') ? 'active' : ''}}" href="/productCustomer">Produk</a></li>
<li><a class="nav-link scrollto {{ $currentMenu == 'kontrak' ? 'active' : '' }}" href="/kontrakSaya">Kontrak
        Saya</a></li>
<li>
    @endif
    <a class="getstarted scrollto" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>
@else
@if($currentMenu == 'productCustomer')
<li><a class="nav-link scrollto {{($currentMenu == 'pengunjung') ? 'active' : ''}}" href="{{route('pengunjung')}}">Home</a></li>
<li><a class="nav-link scrollto {{($currentMenu == 'productCustomer') ? 'active' : ''}}" href="/productCustomer">Produk</a></li>
@else
<li><a class="nav-link scrollto {{($currentMenu == 'pengunjung') ? 'active' : ''}}" href="{{route('pengunjung')}}">Home</a></li>
<li><a class="nav-link scrollto" href="#VisiMisi">Visi & Misi</a></li>
<li><a class="nav-link scrollto" href="#Demografi">Demografi</a></li>
<li><a class="nav-link scrollto" href="#Mitra">Mitra</a></li>
<li><a class="nav-link scrollto {{($currentMenu == 'productCustomer') ? 'active' : ''}}" href="/productCustomer">Produk</a></li>
@endif
<li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>
@endif