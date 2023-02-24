@extends('layouts.master')

@section('overview')
<div class="label">
  <h2 class="title">{{ $orderItem->order->order_index }}</h2>
  <h2 class="subtitle">Melihat transaksi</h2>
</div>

<div class="content between">
  <table class="table">
    <div class="img">
      <div class="content" style="box-shadow: var(--boxShadow-primary); padding: var(--md); border-radius: 8px;">{!! DNS1D::getBarcodeSVG($orderItem->order->order_index, 'PHARMA') !!}</div>
    </div>
    <tr>
      <td>
        <label>Nama</label>
        <h2 class="subtitle">{{ $orderItem->order->customer->name }}</h2>
      </td>
      <td>
        <label>Nomor Telepon</label>
        <h2 class="subtitle">{{ $orderItem->order->customer->phone }}</h2>
      </td>
    </tr>
    <tbody>
      @foreach($orderItem as $item)
      <tr>
        <td>{{ $item->product->name }}</td>
      </tr>
      <tr>
        <td>
          {{ $item->product->price }} X {{ $item->qty }}
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td>
          <label>Uang Tunai</label>
          <h2 class="subtitle">{{ $orderItem->order->accept }}</h2>
        </td>
        <td>
          <label>Total</label>
          <h2 class="subtitle">{{ $orderItem->order->price }}</h2>
        </td>
      </tr>
    </tfoot>
  </table>
</div>
@endsection