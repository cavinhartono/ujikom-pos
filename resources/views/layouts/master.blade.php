<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('assets/icons/cube-sharp.svg') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
  <title>@stack('title')</title>
  @stack('css')
</head>

<?php

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

$users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
$notifications = Notification::with('user')->where('user_id', '=', Auth::user()->id)->orderBy('created_at', "DESC")->get();

?>


<body>
  <section class="container">
    <nav class="navbar">
      <div class="navbar-side">
        <ul class="top">
          <li class="list">
            <span class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="auto" height="auto">
                <path fill="none" d="M0 0h24v24H0z" />
                <path d="M3 18h18a.5.5 0 0 1 .4.8l-2.1 2.8a1 1 0 0 1-.8.4h-13a1 1 0 0 1-.8-.4l-2.1-2.8A.5.5 0 0 1 3 18zm4.161-4H13V6.702L7.161 14zM15 2.425V15a1 1 0 0 1-1 1H4.04a.5.5 0 0 1-.39-.812L14.11 2.113a.5.5 0 0 1 .89.312z" />
              </svg>
            </span>
          </li>
          <li class="list">
            <img src="{{ Auth::user()->getFirstMediaUrl('avatar', 'thumb') }}" class="photo" />
          </li>
          <li class="list btn whited rounded" id="menu">
            <span class="icon center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                <title>ionicons-v5-j</title>
                <path d="M64,384H448V341.33H64Zm0-106.67H448V234.67H64ZM64,128v42.67H448V128Z" />
              </svg>
            </span>
          </li>
        </ul>
        <ul class="bottom">
          <li class="list btn whited rounded">
            <a href="/auth/settings" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>Pengaturan</title>
                  <path d="M256,176a80,80,0,1,0,80,80A80.24,80.24,0,0,0,256,176Zm172.72,80a165.53,165.53,0,0,1-1.64,22.34l48.69,38.12a11.59,11.59,0,0,1,2.63,14.78l-46.06,79.52a11.64,11.64,0,0,1-14.14,4.93l-57.25-23a176.56,176.56,0,0,1-38.82,22.67l-8.56,60.78A11.93,11.93,0,0,1,302.06,486H209.94a12,12,0,0,1-11.51-9.53l-8.56-60.78A169.3,169.3,0,0,1,151.05,393L93.8,416a11.64,11.64,0,0,1-14.14-4.92L33.6,331.57a11.59,11.59,0,0,1,2.63-14.78l48.69-38.12A174.58,174.58,0,0,1,83.28,256a165.53,165.53,0,0,1,1.64-22.34L36.23,195.54a11.59,11.59,0,0,1-2.63-14.78l46.06-79.52A11.64,11.64,0,0,1,93.8,96.31l57.25,23a176.56,176.56,0,0,1,38.82-22.67l8.56-60.78A11.93,11.93,0,0,1,209.94,26h92.12a12,12,0,0,1,11.51,9.53l8.56,60.78A169.3,169.3,0,0,1,361,119L418.2,96a11.64,11.64,0,0,1,14.14,4.92l46.06,79.52a11.59,11.59,0,0,1-2.63,14.78l-48.69,38.12A174.58,174.58,0,0,1,428.72,256Z" />
                </svg>
              </span>
            </a>
          </li>
          <li class="list btn whited rounded">
            <a href="/" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>Cashier</title>
                  <path d="M460,160H372V148A116.13,116.13,0,0,0,258.89,32c-1,0-1.92,0-2.89,0s-1.93,0-2.89,0A116.13,116.13,0,0,0,140,148v12H52a4,4,0,0,0-4,4V464a16,16,0,0,0,16,16H448a16,16,0,0,0,16-16V164A4,4,0,0,0,460,160ZM180,149c0-41.84,33.41-76.56,75.25-77A76.08,76.08,0,0,1,332,148v12H180Zm50.81,252.12-61.37-71.72,24.31-20.81L230,350.91l87.51-109.4,25,20Z" />
                </svg>
              </span>
            </a>
          </li>
          <li class="list btn whited rounded">
            <a href="/auth/logout" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>Keluar</title>
                  <path d="M160,240H320V96a16,16,0,0,0-16-16H64A16,16,0,0,0,48,96V416a16,16,0,0,0,16,16H304a16,16,0,0,0,16-16V272H160Z" />
                  <path d="M459.31,244.69,368,153.37,345.37,176l64,64H320v32h89.37l-64,64L368,358.63l91.31-91.32a16,16,0,0,0,0-22.62Z" />
                </svg>
              </span>
            </a>
          </li>
        </ul>
      </div>
      <div class="navbar-brand">
        <div class="logo">
          <h2 class="title">Shop<b>cube</b></h2>
        </div>
        <div class="profile-name">
          <h2 class="title">{{ Auth::user()->name }}</h2>
          <h2 class="subtitle" style="text-transform: capitalize;">{{ Auth::user()->roles->first()->name }}</h2>
        </div>
        <ul class="nav-item">
          <li class="list {{ (request()->is('dashboard')) ? 'active' : '' }}">
            <a href="/dashboard" class="link">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                  <polygon points="416 174.74 416 48 336 48 336 106.45 256 32 0 272 64 272 64 480 208 480 208 320 304 320 304 480 448 480 448 272 512 272 416 174.74" />
                </svg>
              </span>
              <span class="subtitle">Dashboard</span>
            </a>
          </li>
          <li class="list {{ (request()->is('transactions')) ? 'active' : '' }}">
            <a href="/transactions" class="link">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                  <path d="M112,80H400V56a24,24,0,0,0-24-24H66A34,34,0,0,0,32,66V376a24,24,0,0,0,24,24H80V112A32,32,0,0,1,112,80Z" />
                  <path d="M456,112H136a24,24,0,0,0-24,24V456a24,24,0,0,0,24,24H456a24,24,0,0,0,24-24V136A24,24,0,0,0,456,112ZM392,312H312v80H280V312H200V280h80V200h32v80h80Z" />
                </svg>
              </span>
              <span class="subtitle">Transaksi</span>
            </a>
          </li>
          <li class="list {{ (request()->is('products')) ? 'active' : '' }}">
            <a href="/products" class="link">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                  <polygon points="48 170 48 366.92 240 480 240 284 48 170" />
                  <path d="M272,480,464,366.92V170L272,284ZM448,357.64h0Z" />
                  <polygon points="448 144 256 32 64 144 256 256 448 144" />
                </svg>
              </span>
              <span class="subtitle">Produk</span>
            </a>
          </li>
          <li class="list {{ (request()->is('reports')) ? 'active' : '' }}">
            <a href="/reports" class="link">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <rect x="96" y="112" width="96" height="96" rx="16" ry="16" style="fill:none" />
                  <path d="M468,112H416V416a32,32,0,0,0,32,32h0a32,32,0,0,0,32-32V124A12,12,0,0,0,468,112Z" />
                  <path d="M431.15,477.75A64.11,64.11,0,0,1,384,416V44a12,12,0,0,0-12-12H44A12,12,0,0,0,32,44V424a56,56,0,0,0,56,56H430.85a1.14,1.14,0,0,0,.3-2.25ZM96,208V112h96v96ZM320,400H96V368H320Zm0-64H96V304H320Zm0-64H96V240H320Zm0-64H224V176h96Zm0-64H224V112h96Z" />
                </svg>
              </span>
              <span class="subtitle">Laporan</span>
            </a>
          </li>
          <li class="list {{ (request()->is('users')) ? 'active' : '' }}">
            <a href="/users" class="link">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <circle cx="152" cy="184" r="72" />
                  <path d="M234,296c-28.16-14.3-59.24-20-82-20-44.58,0-136,27.34-136,82v42H166V383.93c0-19,8-38.05,22-53.93C199.17,317.32,214.81,305.55,234,296Z" />
                  <path d="M340,288c-52.07,0-156,32.16-156,96v48H496V384C496,320.16,392.07,288,340,288Z" />
                  <circle cx="340" cy="168" r="88" />
                </svg>
              </span>
              <span class="subtitle">Pengguna</span>
            </a>
          </li>
        </ul>

        <ul class="friends">
          @foreach($users as $user)
          <li class="list center gap" style="position: relative;">
            @if(Cache::has('user-isOnline'. $user->id))
            <span class="online"></span>
            @endif
            <img src="{{ $user->getFirstMediaUrl('avatar', 'thumb') }}" class="photo">
            <div class="field">
              <h2 class="subtitle">{{ $user->name }}</h2>
              <h2 class="subtitle" style="text-transform: capitalize;">
                @foreach($user->roles as $role)
                {{ $role->name }}
                @endforeach
              </h2>
            </div>
          </li>
          @endforeach
        </ul>

        @if(Session::get('primary'))
        <div class="alert primary between">
          <span class="icon kotak">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
              <path d="M48,48V464H464V48ZM218,360.38,137.4,270.81l23.79-21.41,56,62.22L350,153.46,374.54,174Z" />
            </svg>
          </span>
          <h2 class="subtitle">{{ Session::get('primary') }}</h2>
        </div>
        @endif

        @if(Session::get('success'))
        <div class="alert success between">
          <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
              <path d="M48,48V464H464V48ZM218,360.38,137.4,270.81l23.79-21.41,56,62.22L350,153.46,374.54,174Z" />
            </svg>
          </span>
          <h2 class="subtitle">{{ Session::get('success') }}</h2>
        </div>
        @endif


        @if(Session::get('failed'))
        <div class="alert flex between">
          <span class="icon kotak">
            <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" fill="currentColor" viewBox="0 0 512 512">
              <polygon points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
            </svg>
          </span>
          <h2 class="subtitle">{{ Session::get('failed') }}</h2>
        </div>
        @endif

      </div>
    </nav>
    <div class="content">
      <header class="header">
        <ul class="action">
          <li class="list btn whited rounded">
            <a href="/chat" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>Pesan</title>
                  <path d="M128,464V384H56a24,24,0,0,1-24-24V72A24,24,0,0,1,56,48H456a24,24,0,0,1,24,24V360a24,24,0,0,1-24,24H245.74ZM456,80h0Z" />
                </svg>
              </span>
            </a>
          </li>
          <li class="list btn whited rounded" onclick="document.querySelector('.notifications').classList.toggle('active')">
            <span class="icon center">
              <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" fill="currentColor" viewBox="0 0 512 512">
                <title>Notifikasi</title>
                <path d="M256,480a80.09,80.09,0,0,0,73.3-48H182.7A80.09,80.09,0,0,0,256,480Z" />
                <path d="M400,288V227.47C400,157,372.64,95.61,304,80l-8-48H216l-8,48c-68.88,15.61-96,76.76-96,147.47V288L64,352v48H448V352Z" />
              </svg>
            </span>
            <ul class="notifications">
              @forelse($notifications as $notification)
              <li class="list notification" style="margin: (--md); padding: (--md) (--lg) !important">
                <div class="flex" style="align-items: center; gap: var(--md)">
                  <span class="icon {{ $notification->type }} kotak">
                    @if($notification->type == 'success')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                      <polyline points="416 128 192 384 96 288" style="fill:none;stroke:hsl(171, 93%, 32%);stroke-linecap:square;stroke-miterlimit:10;stroke-width:44px" />
                    </svg>
                    @endif
                    @if($notification->icon == 'failed')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                      <polygon points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                    </svg>
                    @endif
                    @if($notification->icon == 'wait')
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                      <polyline points="196 220 260 220 260 392" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:40px" />
                      <line x1="187" y1="396" x2="325" y2="396" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:40px" />
                      <path d="M256,160a32,32,0,1,1,32-32A32,32,0,0,1,256,160Z" />
                    </svg>
                    @endif
                  </span>
                  <div class="content_notification">
                    <h2 class="subtitle" style="font-weight: 700"> {{ $notification->title }} </h2>
                    <p class="subtitle" style="font-size: var(--sm);"> {{ $notification->content }} </p>
                  </div>
                </div>
              </li>
              @empty
              <li class="list">
                <div class="notification">
                  <span class="icon info">
                  </span>
                  <div class="notification">
                    <h2 class="subtitle">Tidak ada informasi</h2>
                    <h2 class="subtitle">-</h2>
                  </div>
                </div>
              </li>
              @endforelse
            </ul>
          </li>
        </ul>
      </header>
      <div class="overview">
        @yield('overview')
      </div>
    </div>
  </section>
  <script src="{{ asset('assets/js/script.js') }}"></script>
  @stack('js')
</body>

</html>