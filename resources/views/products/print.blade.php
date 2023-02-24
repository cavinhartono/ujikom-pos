<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/master.css') }}">
  <title>Produk</title>
</head>

<body onload="window.print()">
  <section class="container">
    <div class="content" style="padding: var(--lg)">
      <ul class="flex" style="gap: var(--lg); flex-wrap: wrap;">
        @foreach($products as $product)
        <li class="list" style="box-shadow: var(--boxShadow-primary); padding: var(--md); border-radius: 8px;">
          <div class="content">{!! DNS1D::getBarcodeSVG($product->barcode, 'PHARMA') !!}</div>
          <h2 class="subtitle between">
            <b>{{ $product->name }}</b>
          </h2>
        </li>
        @endforeach
      </ul>
    </div>
  </section>
</body>

</html>