@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
@endpush

@section('overview')
<div class="label" style="margin-bottom: var(--md);">
  <h2 class="title">Transaksi</h2>
  <h2 class="subtitle">Saat ini</h2>
</div>
<div class="orders">
  <div class="label full-content flex" style="justify-content: flex-end;">
    <div class="field" style="width: 300px">
      <div class="input">
        <input type="text" class="input-form" placeholder="Pencarian">
      </div>
    </div>
  </div>
  <table class="table" id="table" style="margin: var(--md) 0;">
    <thead>
      <tr>
        <th style="text-align: start; --width: 50px">No</th>
        <th style="text-align: start; --width: 200px">Tanggal</th>
        <th style="text-align: start; --width: 150px">Nama</th>
        <th style="text-align: end; --width: 150px">Total</th>
        <th style="text-align: center; --width: calc(100% - (50px + 200px + 150px + 150px))">Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $order)
      <tr>
        <td style="text-align: start; --width: 50px">{{ $order->order_index }}</td>
        <td style="text-align: start; --width: 200px">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM YYYY, Do') }}</td>
        <td style="text-align: start; --width: 150px; text-transform: capitalize;">{{ $order->customer->name }}</td>
        <td style="text-align: end; --width: 150px">{{ $order->price }} IDR</td>
        <td style="--width: calc(100% - (50px + 200px + 150px + 150px))">
          <a class="link btn success" href="/transaction/{{ $order->id }}/view">View</a>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5"></td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection