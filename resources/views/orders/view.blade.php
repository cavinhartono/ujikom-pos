@extends('layouts.master')

@section('overview')
<div class="label">
  <h2 class="title">{{ $orderItem->order_index }}</h2>
  <h2 class="subtitle">Melihat transaksi</h2>
</div>

<div class="orders" style="margin: var(--md) 0;">
  <div class="content between">
    <table class="table">
      <tr>
        <td>
          <label>Nama</label>
          <h2 class="subtitle">{{ $orderItem->customer->name }}</h2>
        </td>
        <td>
          <label>Nomor Telepon</label>
          <h2 class="subtitle">{{ $orderItem->customer->phone }}</h2>
        </td>
      </tr>
      <tbody>
        @foreach($orderItem->order_item as $item)
        <tr>
          <td>{{ $item->product->name }}</td>
          <td>
            {{ $item->price }} X {{ $item->qty }}
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td>
            <label>Uang Tunai</label>
            <h2 class="subtitle">{{ $orderItem->accept }}</h2>
          </td>
          <td>
            <label>Total</label>
            <h2 class="subtitle">{{ $orderItem->price }}</h2>
          </td>
        </tr>
        <tr>
          <td>
            <div class="barcode" style="box-shadow: var(--boxShadow-primary); padding: var(--md); border-radius: 8px;">{!! DNS1D::getBarcodeHTML(($orderItem->id . $orderItem->customer->id), 'PHARMA') !!}</div>
          </td>
        </tr>
      </tfoot>
    </table>
    <a href="/struck/{{ $orderItem->id }}" class="link btn primary center">Cetak</a>
  </div>
</div>
@endsection