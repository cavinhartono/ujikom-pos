@extends('layouts.cashier')

@push('title')
Transaksi | Shopcube
@endpush

@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  table {
    table-layout: fixed;
  }

  thead tr {
    width: 100%;
    display: flex;
    justify-content: space-between;
  }

  thead th {
    width: 100%;
  }

  tbody tr {
    padding: 8px 12px;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
  }

  thead,
  tbody {
    display: block;
  }

  tbody {
    height: 400px;
    overflow-y: scroll;
    overflow-x: hidden;
  }
</style>
@endpush

@section('overview')
<div class="transaction" style="margin: 0 60px; margin-top: 60px; width: 100%">
  <div class="content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th style="text-align: left;">-</th>
          <th style="text-align: left;">Nama</th>
          <th style="text-align: end;">Total</th>
          <th style="text-align: end;">Uang Tunai</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('D MMM, hh mm') }}</td>
          <td>{{ $order->customer->name }}</td>
          <td>{{ $order->accept }}</td>
          <td>{{ $order->price }}</td>
          <td>
            <a href="/transaction/{{ $order->id }}/view" class="link btn secondary">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
                  <title>View {{ $order->customer->name }} </title>
                  <circle cx="256" cy="256" r="64" />
                  <path d="M394.82,141.18C351.1,111.2,304.31,96,255.76,96c-43.69,0-86.28,13-126.59,38.48C88.52,160.23,48.67,207,16,256c26.42,44,62.56,89.24,100.2,115.18C159.38,400.92,206.33,416,255.76,416c49,0,95.85-15.07,139.3-44.79C433.31,345,469.71,299.82,496,256,469.62,212.57,433.1,167.44,394.82,141.18ZM256,352a96,96,0,1,1,96-96A96.11,96.11,0,0,1,256,352Z" />
                </svg>
              </span>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection

@section('dashboard')
<ul class="revenue">
  <li class="list" style="background: var(--fifth-color)">
    <h2 class="subtitle">
      Total
    </h2>
    <h2 class="subtitle value">
      {{ $orders->count() }}
    </h2>
  </li>
  <li class="list" style="background: var(--third-color)">
    <h2 class="subtitle">
      Saat Ini
    </h2>
    <h2 class="subtitle value">
      {{ App\Models\Order::whereDay('created_at', '=', Carbon\Carbon::now())->count() }}
    </h2>
  </li>
  <li class="list" style="background: var(--fourth-color)">
    <h2 class="subtitle">Bulan Ini</h2>
    <h2 class="subtitle value">
      {{ App\Models\Order::whereMonth('created_at', '=', Carbon\Carbon::now())->count() }}
    </h2>
  </li>
</ul>
@endsection