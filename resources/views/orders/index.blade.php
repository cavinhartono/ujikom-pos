@extends('layouts.master')

@push('title')
Transaksi | Shopcube
@endpush

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
        <th style="text-align: center; --width: calc(100% - (50px + 200px + 150px + 150px))">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $order)
      <tr>
        <td style="text-align: start; --width: 50px">{{ $order->order_index }}</td>
        <td style="text-align: start; --width: 200px">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM YYYY, Do') }}</td>
        <td style="text-align: start; --width: 150px; text-transform: capitalize;">{{ $order->customer->name }}</td>
        <td style="text-align: end; --width: 150px">{{ $order->price }} IDR</td>
        <td style="--width: calc(100% - (50px + 200px + 150px + 150px)); text-align: center;">
          <a class="link btn success" href="/transaction/{{ $order->id }}/view">
            <span class="icon center">
              <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="auto" fill="currentColor" viewBox="0 0 512 512">
                <title>Edit {{ $order->customer->name }}</title>
                <circle cx="256" cy="256" r="64" />
                <path d="M394.82,141.18C351.1,111.2,304.31,96,255.76,96c-43.69,0-86.28,13-126.59,38.48C88.52,160.23,48.67,207,16,256c26.42,44,62.56,89.24,100.2,115.18C159.38,400.92,206.33,416,255.76,416c49,0,95.85-15.07,139.3-44.79C433.31,345,469.71,299.82,496,256,469.62,212.57,433.1,167.44,394.82,141.18ZM256,352a96,96,0,1,1,96-96A96.11,96.11,0,0,1,256,352Z" />
              </svg>
            </span>
          </a>
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