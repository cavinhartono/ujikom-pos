@extends('layouts.master')

@push('title')
Laporan | Shopcube
@endpush

@section('overview')
<div class="full-content">
  <div class="label">
    <h2 class="title">Laporan Sekarang</h2>
    <h2 class="subtitle"> {{ $orders->count() }} jumlah terakhir </h2>
  </div>
  <div class="reports" style="margin: var(--md) 0;">
    <div class="label">
      <a href="/print" class="link btn primary">Print</a>
      <a href="/export-pdf" class="link btn success">Export</a>
    </div>
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
          <td style="text-align: right"> <?php echo number_format($order->price, "0", ' ', '.') . " IDR" ?> </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3" style="text-align: right;">Total</th>
          <th> <?php echo number_format($orders->sum('price'), "0", " ", '.') . " IDR" ?> </th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
@endsection