<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/cashier/style.css') }}">
  <title>@stack('title')</title>
  @stack('css')
</head>

<body>
  <section class="container">
    <nav class="navbar">
      <div class="navbar-brand">
        <div class="logo">
          <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="auto" height="auto">
              <path fill="none" d="M0 0h24v24H0z" />
              <path d="M3 18h18a.5.5 0 0 1 .4.8l-2.1 2.8a1 1 0 0 1-.8.4h-13a1 1 0 0 1-.8-.4l-2.1-2.8A.5.5 0 0 1 3 18zm4.161-4H13V6.702L7.161 14zM15 2.425V15a1 1 0 0 1-1 1H4.04a.5.5 0 0 1-.39-.812L14.11 2.113a.5.5 0 0 1 .89.312z" />
            </svg>
          </span>
        </div>
        <ul class="nav">
          <li class="list" onclick="document.querySelector('.profile').classList.toggle('active')" style="cursor: pointer;">
            <img src="{{ Auth::user()->getFirstMediaUrl('avatar', 'thumb') }}" class="photo">
            <ul class="profile">
              <li class="list">
                <div class="label">
                  <h2 class="subtitle">{{ Auth::user()->name }}</h2>
                  <h2 class="subtitle">{{ Auth::user()->roles->first()->name }}</h2>
                </div>
              </li>
              <li class="list">
                <a href="/auth/settings" class="link">
                  <span class="icon center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                      <path d="M256,176a80,80,0,1,0,80,80A80.24,80.24,0,0,0,256,176Zm172.72,80a165.53,165.53,0,0,1-1.64,22.34l48.69,38.12a11.59,11.59,0,0,1,2.63,14.78l-46.06,79.52a11.64,11.64,0,0,1-14.14,4.93l-57.25-23a176.56,176.56,0,0,1-38.82,22.67l-8.56,60.78A11.93,11.93,0,0,1,302.06,486H209.94a12,12,0,0,1-11.51-9.53l-8.56-60.78A169.3,169.3,0,0,1,151.05,393L93.8,416a11.64,11.64,0,0,1-14.14-4.92L33.6,331.57a11.59,11.59,0,0,1,2.63-14.78l48.69-38.12A174.58,174.58,0,0,1,83.28,256a165.53,165.53,0,0,1,1.64-22.34L36.23,195.54a11.59,11.59,0,0,1-2.63-14.78l46.06-79.52A11.64,11.64,0,0,1,93.8,96.31l57.25,23a176.56,176.56,0,0,1,38.82-22.67l8.56-60.78A11.93,11.93,0,0,1,209.94,26h92.12a12,12,0,0,1,11.51,9.53l8.56,60.78A169.3,169.3,0,0,1,361,119L418.2,96a11.64,11.64,0,0,1,14.14,4.92l46.06,79.52a11.59,11.59,0,0,1-2.63,14.78l-48.69,38.12A174.58,174.58,0,0,1,428.72,256Z" />
                    </svg>
                  </span>
                  <span class="subtitle">Pengaturan</span>
                </a>
              </li>
              <li class="list">
                <a href="/auth/logout" class="link">
                  <span class="icon center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                      <path d="M160,240H320V96a16,16,0,0,0-16-16H64A16,16,0,0,0,48,96V416a16,16,0,0,0,16,16H304a16,16,0,0,0,16-16V272H160Z" />
                      <path d="M459.31,244.69,368,153.37,345.37,176l64,64H320v32h89.37l-64,64L368,358.63l91.31-91.32a16,16,0,0,0,0-22.62Z" />
                    </svg>
                  </span>
                  <span class="subtitle">Keluar</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="list {{ (request()->is('/')) ? 'active' : '' }}">
            <a href="/" class="link center">
              <span class="icon">
                <title>Dashboard</title>
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                  <polygon points="416 174.74 416 48 336 48 336 106.45 256 32 0 272 64 272 64 480 208 480 208 320 304 320 304 480 448 480 448 272 512 272 416 174.74" />
                </svg>
              </span>
            </a>
          </li>
          <li class="list {{ (request()->is('transactions')) ? 'active' : '' }}">
            <a href="/transactions" class="link center">
              <span class="icon">
                <title>Transaksi</title>
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                  <path d="M112,80H400V56a24,24,0,0,0-24-24H66A34,34,0,0,0,32,66V376a24,24,0,0,0,24,24H80V112A32,32,0,0,1,112,80Z" />
                  <path d="M456,112H136a24,24,0,0,0-24,24V456a24,24,0,0,0,24,24H456a24,24,0,0,0,24-24V136A24,24,0,0,0,456,112ZM392,312H312v80H280V312H200V280h80V200h32v80h80Z" />
                </svg>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content full-content between gap">
      <div class="content" style="width: 900px;">
        <header class="header between center" style="width: inherit;">
          <div class="label">
            <div class="logo">
              <h2 class="subtitle">Shop<b>cube</b></h2>
            </div>
            <div class="subtitle">{{ \Carbon\Carbon::parse(now())->isoFormat('MMM YYYY, Do') }}</div>
          </div>
          @yield('header')
        </header>
        @yield('overview')
      </div>
      @yield('dashboard')
    </div>
    @stack('js')
  </section>
</body>

</html>