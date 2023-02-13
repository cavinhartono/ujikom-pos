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
    <header class="header between center">
      <div class="logo">
        <h2 class="subtitle">Shop<b>cube</b></h2>
      </div>
      <menu class="menu" onclick="document.querySelector('.nav').classList.toggle('active')">
        <span></span>
        <span></span>
        <span></span>
      </menu>
      <ul class="nav flex gap">
        <li class="list {{ (request()->is('dashboard/cashier')) ? 'active' : '' }}">
          <a href="/dashboard/cashier" class="link">
            <span class="icon"></span>
            <span class="subtitle">Dashboard</span>
          </a>
        </li>
        <li class="list {{ (request()->is('orders')) ? 'active' : '' }}">
          <a href="/orders" class="link">
            <span class="icon"></span>
            <span class="subtitle">Transaksi</span>
          </a>
        </li>
      </ul>
    </header>
    @yield('overview')
  </section>
  @stack('js')
</body>

</html>