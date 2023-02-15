<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/struck.css') }}">
  <title>Struck {{ $order->name }}</title>
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
        <header class="full-content between">
          <h2 class="subtitle">{{ date('d-m-Y') }}</h2>
          <h2 class="subtitle">{{ Auth()->user()->name }}</h2>
        </header>
      </div>
    </header>
    <div class="struck">
      <table class="table">
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
      </table>
    </div>
  </div>
</body>

</html>