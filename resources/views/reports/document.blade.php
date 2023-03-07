<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/public/assets/css/master.css" />
    <title>Dokumen Harian</title>
    <style>
        body {
            margin: var(--md);
        }

        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <section class="container">
        <header class="header between center">
            <div class="label">
                <h2 class="title">Shop<b>cube</b></h2>
                <h2 class="subtitle">Dokumen Harian</h2>
                <h2 class="subtitle">Dari tanggal 10 Feb - 17 Feb 2023</h2>
            </div>
            <div class="content">
                <div class="label" style="text-align: end">
                    <h2 class="subtitle">{{ Auth::user()->name }}</h2>
                    <h2 class="subtitle" style="margin-top: 4px">
                        {{ Auth::user()->roles->first()->name }}
                    </h2>
                </div>
                <button class="btn primary" onclick="window.print();">
                    Print
                </button>
            </div>
        </header>
        <div class="content" style="margin: var(--md) 0">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th style="text-align: right">Hasilan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('DD MMMM YYYY') }} </td>
                        <td style="text-align: right"> {{ $order->sum('price')->whereDay('created_at', '=', 'created_at')->get() }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="text-align: right">Total</th>
                        <th style="text-align: right">{{ $orders->sum('price') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <footer class="footer">&COPY; Shopcube | 2023</footer>
    </section>
</body>

</html>