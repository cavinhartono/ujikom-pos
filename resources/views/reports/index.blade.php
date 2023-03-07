@extends('layouts.master')

@push('title')
Laporan | Shopcube
@endpush

@section('overview')
<div class="label">
  <h2 class="title">Laporan</h2>
  <h2 class="subtitle">{{ App\Models\Order::count() }}</h2>
</div>
<div class="full-content gap">
  <ul class="card">
    <li class="list" style="background: var(--fifth-color)">
      <h2 class="subtitle">Bulan Ini</h2>
      <h2 class="subtitle value"> {{ App\Models\Order::whereMonth('created_at', '=', Carbon\Carbon::now())->count() }} </h2>
    </li>
    <li class="list" style="background: var(--third-color)">
      <h2 class="subtitle">Minggu Ini</h2>
      <h2 class="subtitle value"> {{ App\Models\Order::whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count() }} </h2>
    </li>
    <li class="list" style="background: var(--fourth-color)">
      <h2 class="subtitle">Hari Ini</h2>
      <h2 class="subtitle value">{{ App\Models\Order::whereDay('created_at', '=', Carbon\Carbon::now())->count() }} </h2>
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
  <div class="orders full-content" style="margin: var(--md) 0">
    <div class="label">
      <h2 class="subtitle">Pelanggan Terakhir</h2>
    </div>
    <table class="table full-content" style="margin-top: var(--md)">
      <thead>
        <tr>
          <th style="text-align: start; --width: 50px">No</th>
          <th style="text-align: start; --width: 200px">Tanggal</th>
          <th style="text-align: start; --width: 150px">Nama</th>
          <th style="text-align: end; --width: 150px">Total</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $order)
        <tr>
          <td style="text-align: start; --width: 50px">{{ $order->order_index }}</td>
          <td style="text-align: start; --width: 200px">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('Do MMM YYYY, Hh Mm') }}</td>
          <td style="text-align: start; --width: 150px; text-transform: capitalize;">{{ $order->customer->name }}</td>
          <td style="text-align: end; --width: 150px">{{ $order->price }} IDR</td>
        </tr>
        @empty
        <tr>
          <td colspan="4">Tidak ada</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    <ul class="revenue flex gap">
      <li class="list">
        <span class="icon"></span>
        <div class="label">
          <h2 class="title"> IDR. {{ App\Models\Order::sum('price') }} </h2>
          <h2 class="subtitle">Total Penghasilan</h2>
        </div>
      </li>
      <li class="list">
        <span class="icon"></span>
        <div class="label">
          <h2 class="title"> {{ ($beforeMonth / $monthNow) * 100 }}% </h2>
          <h2 class="subtitle"> Persentase </h2>
        </div>
      </li>
    </ul>
  </div>
</div>
@endsection