@extends('layouts.master')

@section('overview')
<div class="label">
  <h2 class="subtitle">Laporan Sekarang</h2>
</div>
<div class="reports">
  <div class="label">
    <a href="/print" class="link btn primary">Print</a>
  </div>
  <ul class="report">
    <li class="list full-content between">
      <div class="label">
        <h2 class="subtitle">Orang yang Mengunjungi</h2>
        <h2 class="title">60</h2>
      </div>
      <div class="label">
        <h2 class="subtitle">Keuntungan</h2>
        <h2 class="title">IDR. 30.000.000</h2>
      </div>
    </li>
    <li class="list full-content between">
      <div class="label full-content between">
        <h2 class="subtitle">Keuntungan</h2>
        <h2 class="subtitle">IDR. 30.000.000</h2>
      </div>
      <table class="table">
        <thead>
          <tr class="full-content between">
            <th>Tender Type</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr class="full-content between">
            <td>Cash</td>
            <td>IDR. 12.000.000</td>
          </tr>
        </tbody>
      </table>
    </li>
    <li class="list full-content between">
      <div class="label full-content between">
        <h2 class="subtitle">Pengeluaran</h2>
        <h2 class="subtitle">IDR. 12.000.000</h2>
      </div>
    </li>
  </ul>
</div>
@endsection