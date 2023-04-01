<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets/css/reports/style.css') }}">
    <title>Dokumen Harian</title>
</head>

<body onload="window.print()">
    <section class="container">
        <header class="header between center">
            <div class="label">
                <h2 class="title">Shop<b>cube</b></h2>
                <h2 class="subtitle">Dokumen Harian</h2>
                <h2 class="subtitle">{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}</h2>
            </div>
            <div class="content">
                <div class="label" style="text-align: end">
                    <h2 class="subtitle">{{ $user->name }}</h2>
                    <h2 class="subtitle" style="margin-top: 4px; text-transform: capitalize;">
                        @foreach($user->roles as $role)
                        {{ $role->name }}
                        @endforeach
                    </h2>
                </div>
            </div>
        </header>
        <div class="content" style="margin: var(--md) 0">
            <div class="full-content flex gap" style="flex-direction: column;">
                <ul class="card flex gap" style="width: 100%;">
                    <li class="list" style="background: var(--fifth-color)">
                        <h2 class="subtitle">Bulan Ini</h2>
                        <h2 class="subtitle value"> {{ App\Models\Order::whereMonth('created_at', '=', Carbon\Carbon::now())->count() }} </h2>
                    </li>
                    <li class="list" style="background: var(--third-color)">
                        <h2 class="subtitle">Minggu Ini</h2>
                        <h2 class="subtitle value"> {{ App\Models\Order::whereBetween('created_at', [Carbon\Carbon::now()->startOfWeek(), Carbon\Carbon::now()->endOfWeek()])->count() }} </h2>
                    </li>
                    <li class="list" style="background: var(--fourth-color)">
                        <h2 class="subtitle">Hari Ini</h2>
                        <h2 class="subtitle value">{{ App\Models\Order::whereDay('created_at', '=', Carbon\Carbon::now())->count() }} </h2>
                    </li>
                </ul>
                <ul class="charts gap">
                    <li class="list" style="--width: 600px">
                        <h2 class="subtitle">Revenue</h2>
                        <div class="full-content">
                            <div id="totalSales"></div>
                        </div>
                    </li>
                    <li class="list" style="--width: 350px">
                        <h2 class="subtitle">Penjualan Laris</h2>
                        <div class="content">
                            <div id="category"></div>
                        </div>
                    </li>
                </ul>
                <div class="orders full-content" style="margin: var(--md) 0">
                    <div class="label">
                        <h2 class="subtitle">Pelanggan Terakhir</h2>
                    </div>
                    <table class="table full-content" style="margin-top: var(--md)">
                        <thead>
                            <tr>
                                <th style="text-align: start; --width: 50px">No</th>
                                <th style="text-align: start; --width: 200px">Tanggal</th>
                                <th style="text-align: start; --width: 150px">Nama</th>
                                <th style="text-align: end; --width: 150px">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td style="text-align: start; --width: 50px">{{ $order->order_index }}</td>
                                <td style="text-align: start; --width: 200px">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('Do MMM YYYY, Hh Mm') }}</td>
                                <td style="text-align: start; --width: 150px; text-transform: capitalize;">{{ $order->customer->name }}</td>
                                <td style="text-align: end; --width: 150px">{{ $order->price }} IDR</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Tidak ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <ul class="revenue flex gap">
                        <li class="list">
                            <div class="label">
                                <h2 class="title"> IDR. <?php echo number_format($monthNow, '0', ",", "."); ?> </h2>
                                <h2 class="subtitle">Total Penghasilan</h2>
                            </div>
                        </li>
                        <li class="list">
                            <div class="label">
                                <h2 class="title"> {{ $monthNow <= $beforeMonth ? "-" . number_format((($monthNow / $beforeMonth) * 100), 1) : number_format((($beforeMonth / $monthNow) * 100), 1) }}% </h2>
                                <h2 class="subtitle"> Persentase </h2>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
            $label = array();
            $series = array();
            $keyRevenue = array();
            $valRevenue = array();

            foreach ($topSellings as $item) {
                array_push($label, $item->name);
                array_push($series, $item->total_price);
            }

            foreach ($totalRevenue as $item) {
                array_push($keyRevenue, $item->date);
                array_push($valRevenue, $item->total);
            }

            ?>
        </div>
    </section>
    <script src="{{ asset('assets/js/plugins/apexchart.min.js') }}"></script>
    <script>
        var topSellings = <?php echo json_encode($series) ?>;
        var labelSellings = <?php echo json_encode($label) ?>;
        var beforeMonth = <?php echo json_encode($valRevenue) ?>;
        var labelRevenue = <?php echo json_encode($keyRevenue) ?>;
    </script>
    <script src="{{ asset('assets/js/ApexChartSettings.js') }}"></script>
</body>

</html>