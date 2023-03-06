@extends('layouts.master')

@push('title')
Laporan | Shopcube
@endpush

@section('overview')
<div class="label">
  <h2 class="subtitle">Laporan Sekarang</h2>
</div>
<div class="reports">
  <div class="label">
    <a href="/print" class="link btn primary">Print</a>
  </div>
  <ul class="report">
    <li class="list">
      <table class="table">
        <thead>
          <tr>
            <th style="text-align: start;">-</th>
            <th style="text-align: start;">Tanggal</th>
            <th style="text-align: end;">Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('DD MMMM YYYY') }} </td>
            <td style="text-align: right"> {{ $order->price }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </li>
  </ul>
</div>
@endsection