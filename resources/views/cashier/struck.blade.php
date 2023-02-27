<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/struck.css') }}">
  <title>Struck {{ $orderItem->name }}</title>
</head>

<body onload="window.print()">
  <div class="content">
    <header class="header">
      <button class="btn primary" onclick="window.print()">
        <span class="icon"></span>
        <span class="title">Print</span>
      </button>
      <div class="label">
        <h2 class="title">Shop<b>cube</b></h2>
        <h2 class="subtitle">Jalan Baranangsiang</h2>
        <header class="full-content between" style="margin: var(--md) 0;">
          <div class="content">
            <h2 class="subtitle">{{ date('d-m-Y') }}</h2>
            <h2 class="subtitle">{{ $orderItem->order_index }}</h2>
          </div>
          <div class="content" style="text-align: end;">
            <h2 class="subtitle">Dilayani oleh {{ Auth()->user()->name }}</h2>
            <h2 class="subtitle">Pelanggan {{ $orderItem->customer->name }}</h2>
          </div>
        </header>
      </div>
    </header>
    <div class="struck" style="margin: var(--md) 0;">
      <div class="content">
        <table class="table">
          <tbody>
            @foreach($orderItem->order_item as $item)
            <tr>
              <td colspan="3">{{ $item->product->name }}</td>
              <td style="text-align: end;">
                {{ $item->price }} X {{ $item->qty }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="full-content between" style="margin: var(--lg) 0;">
          <div class="barcode">
            {!! DNS1D::getBarcodeSVG(($orderItem->id . $orderItem->customer->id), 'PHARMA') !!}
          </div>
          <h2 class="subtitle">Terimakasih!</h2>
        </div>
      </div>
    </div>
  </div>
</body>

<script>
  let body = document.body;
  let html = document.documentElement;
  let height = Math.max(
    body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight
  );

  document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  document.cookie = "innerHeight=" + ((height + 50) * 0.264583);
</script>

</html>