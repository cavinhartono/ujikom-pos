<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@stack('title')</title>
  @stack('css')
</head>

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
            <img src="/public/assets/download.jpg" class="photo" />
          </li>
          <li class="list btn rounded" id="menu">
            <span class="icon center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                <title>ionicons-v5-j</title>
                <path d="M64,384H448V341.33H64Zm0-106.67H448V234.67H64ZM64,128v42.67H448V128Z" />
              </svg>
            </span>
          </li>
        </ul>
        <ul class="bottom">
          <li class="list btn rounded">
            <a href="#" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>ionicons-v5-q</title>
                  <path d="M256,176a80,80,0,1,0,80,80A80.24,80.24,0,0,0,256,176Zm172.72,80a165.53,165.53,0,0,1-1.64,22.34l48.69,38.12a11.59,11.59,0,0,1,2.63,14.78l-46.06,79.52a11.64,11.64,0,0,1-14.14,4.93l-57.25-23a176.56,176.56,0,0,1-38.82,22.67l-8.56,60.78A11.93,11.93,0,0,1,302.06,486H209.94a12,12,0,0,1-11.51-9.53l-8.56-60.78A169.3,169.3,0,0,1,151.05,393L93.8,416a11.64,11.64,0,0,1-14.14-4.92L33.6,331.57a11.59,11.59,0,0,1,2.63-14.78l48.69-38.12A174.58,174.58,0,0,1,83.28,256a165.53,165.53,0,0,1,1.64-22.34L36.23,195.54a11.59,11.59,0,0,1-2.63-14.78l46.06-79.52A11.64,11.64,0,0,1,93.8,96.31l57.25,23a176.56,176.56,0,0,1,38.82-22.67l8.56-60.78A11.93,11.93,0,0,1,209.94,26h92.12a12,12,0,0,1,11.51,9.53l8.56,60.78A169.3,169.3,0,0,1,361,119L418.2,96a11.64,11.64,0,0,1,14.14,4.92l46.06,79.52a11.59,11.59,0,0,1-2.63,14.78l-48.69,38.12A174.58,174.58,0,0,1,428.72,256Z" />
                </svg>
              </span>
            </a>
          </li>
          <li class="list btn rounded">
            <a href="#" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>ionicons-v5-l</title>
                  <path d="M128,464V384H56a24,24,0,0,1-24-24V72A24,24,0,0,1,56,48H456a24,24,0,0,1,24,24V360a24,24,0,0,1-24,24H245.74ZM456,80h0Z" />
                </svg>
              </span>
            </a>
          </li>
          <li class="list btn rounded">
            <a href="#" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>ionicons-v5-o</title>
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
          <h2 class="title">John Doe</h2>
          <h2 class="subtitle">Admin</h2>
        </div>
        <ul class="nav-item">
          <li class="list active">
            <a href="#" class="link">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                  <title>ionicons-v5-i</title>
                  <polygon points="416 174.74 416 48 336 48 336 106.45 256 32 0 272 64 272 64 480 208 480 208 320 304 320 304 480 448 480 448 272 512 272 416 174.74" />
                </svg>
              </span>
              <span class="subtitle">Dashboard</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="link">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                  <title>ionicons-v5-j</title>
                  <path d="M112,80H400V56a24,24,0,0,0-24-24H66A34,34,0,0,0,32,66V376a24,24,0,0,0,24,24H80V112A32,32,0,0,1,112,80Z" />
                  <path d="M456,112H136a24,24,0,0,0-24,24V456a24,24,0,0,0,24,24H456a24,24,0,0,0,24-24V136A24,24,0,0,0,456,112ZM392,312H312v80H280V312H200V280h80V200h32v80h80Z" />
                </svg>
              </span>
              <span class="subtitle">Transaksi</span>
            </a>
          </li>
          <li class="list">
            <a href="#" class="link">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" fill="currentColor" height="auto" viewBox="0 0 512 512">
                  <title>ionicons-v5-h</title>
                  <polygon points="48 170 48 366.92 240 480 240 284 48 170" />
                  <path d="M272,480,464,366.92V170L272,284ZM448,357.64h0Z" />
                  <polygon points="448 144 256 32 64 144 256 256 448 144" />
                </svg>
              </span>
              <span class="subtitle">Produk</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content">
      <header class="header">
        <ul class="action">
          <li class="list btn rounded">
            <a href="#" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>ionicons-v5-l</title>
                  <path d="M128,464V384H56a24,24,0,0,1-24-24V72A24,24,0,0,1,56,48H456a24,24,0,0,1,24,24V360a24,24,0,0,1-24,24H245.74ZM456,80h0Z" />
                </svg>
              </span>
            </a>
          </li>
          <li class="list btn rounded">
            <a href="#" class="link">
              <span class="icon center">
                <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" fill="currentColor" viewBox="0 0 512 512">
                  <title>ionicons-v5-j</title>
                  <path d="M256,480a80.09,80.09,0,0,0,73.3-48H182.7A80.09,80.09,0,0,0,256,480Z" />
                  <path d="M400,288V227.47C400,157,372.64,95.61,304,80l-8-48H216l-8,48c-68.88,15.61-96,76.76-96,147.47V288L64,352v48H448V352Z" />
                </svg>
              </span>
            </a>
          </li>
        </ul>
      </header>
      <div class="overview">
        @yield('overview')
      </div>
    </div>
  </section>
  @stack('js')
</body>

</html>