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
                    <tr>
                        <td>1</td>
                        <td>10 Februari 2023</td>
                        <td style="text-align: right">250.000 IDR</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>11 Februari 2023</td>
                        <td style="text-align: right">500.000 IDR</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="text-align: right">Total</th>
                        <th style="text-align: right">750.000 IDR</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <footer class="footer">&COPY; Shopcube | 2023</footer>
    </section>
</body>

</html>