<?php

use Illuminate\Support\Facades\Auth;

$auth = Auth::check();
if ($auth) {
    $nama = Auth::user()->name;
    $email = Auth::user()->email;
}

?>
@if ($auth)
    <li><a class="nav-link scrollto {{ $currentMenu == 'kontrak' ? 'active' : '' }}" href="/kontrakSaya">Kontrak
            Saya</a></li>
    <li>
        <a class="getstarted scrollto" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
@else
    <li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>
@endif
