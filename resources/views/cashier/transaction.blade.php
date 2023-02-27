@extends('layouts.cashier')

@section('header')
<form class="form">
  <div class="field flex gap">
    <div class="input">
      <input type="text" placeholder="Mencari produk..." class="input-form" id="search">
    </div>
  </div>
</form>
@endsection

@section('overview')
<div class="transaction">
  <div class="content">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
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
          <td>{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('Do MMM, Hh Mm') }}</td>
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