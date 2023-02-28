@extends('layouts.cashier')



@push('title')
Transaksi | Shopcube
@endpush

@section('header')
<form class="form">
  <div class="field flex gap">
    <div class="input">
      <input type="text" placeholder="Mencari produk..." class="input-form">
    </div>
  </div>
</form>
@endsection

@section('overview')
<div class="transaction" style="margin: 0 60px; margin-top: 60px; width: 100%">
  <div class="content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>-</th>
          <th>Nama</th>
          <th>Total</th>
          <th>Uang Tunai</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('Do MMM, hh mm') }}</td>
          <td>{{ $order->customer->name }}</td>
          <td>{{ $order->accept }}</td>
          <td>{{ $order->price }}</td>
          <td>
            <a href="/transaction/{{ $order->id }}/view" class="link btn primary">
              <span class="icon">
                View
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
  <li class="list">
    <h2 class="subtitle">
      Total
    </h2>
    <h2 class="subtitle value">
      {{ $orders->count() }}
    </h2>
  </li>
  <li class="list">
    <h2 class="subtitle">
      Saat Ini
    </h2>
    <h2 class="subtitle value">

    </h2>
  </li>
  <li class="list">
    <h2 class="subtitle">Bulan Ini</h2>
    <h2 class="subtitle value"></h2>
  </li>
</ul>
@endsection