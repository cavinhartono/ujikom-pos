@extends('layouts.master')

@section('overview')
<div class="label">
  <h2 class="title">Dashboard</h2>
</div>
<div class="full-content gap">
  <ul class="card">
    <li class="list" style="background: var(--fifth-color)">
      <h2 class="subtitle">Total Sales</h2>
      <h2 class="subtitle value">IDR. 90.000.000</h2>
    </li>
    <li class="list" style="background: var(--third-color)">
      <h2 class="subtitle">Orders</h2>
      <h2 class="subtitle value">600 Orang</h2>
    </li>
    <li class="list" style="background: var(--fourth-color)">
      <h2 class="subtitle">Customers</h2>
      <h2 class="subtitle value">900 Orang</h2>
    </li>
  </ul>
  <ul class="full-content charts gap">
    <li class="list" style="--width: calc(100% - 350px)">
      <h2 class="subtitle">Revenue</h2>
      <div class="full-content">
        <div id="totalSales"></div>
      </div>
    </li>
    <li class="list" style="--width: 350px">
      <h2 class="subtitle">Kategori</h2>
      <div class="content">
        <div id="category"></div>
      </div>
    </li>
  </ul>
  <div class="full-content">
    <table class="table full-content">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Last Seen</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Marselinus Cavin Hartono</td>
          <td>2 jam yang lalu</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Calista Hartono Putri</td>
          <td>5 jam yang lalu</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection