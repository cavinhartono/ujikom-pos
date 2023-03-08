@extends('layouts.master')

@push('title')
Laporan | Shopcube
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/reports/style.css') }}">
@endpush

@section('overview')
<div class="label">
  <h2 class="title">Laporan</h2>
  <h2 class="subtitle">{{ App\Models\Order::count() }}</h2>
  {{ dd($topSellings) }}
</div>
<div class="full-content gap">
  <ul class="card">
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
  <ul class="full-content charts gap">
    <li class="list" style="--width: calc(100% - 350px)">
      <h2 class="subtitle">Revenue</h2>
      <div class="full-content">
        <div id="totalSales"></div>
      </div>
    </li>
    <li class="list" style="--width: 350px">
      <h2 class="subtitle">Kategori</h2>
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
      <li class="list success">
        <span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
            <rect x="48" y="368" width="416" height="32" />
            <rect x="80" y="416" width="352" height="32" />
            <path d="M480,176a96.11,96.11,0,0,1-96-96V64H128V80a96.11,96.11,0,0,1-96,96H16v64H32a96.11,96.11,0,0,1,96,96v16H384V336a96.11,96.11,0,0,1,96-96h16V176ZM256,304a96,96,0,1,1,96-96A96.11,96.11,0,0,1,256,304Z" />
            <path d="M96,80V64H16v80H32A64.07,64.07,0,0,0,96,80Z" />
            <path d="M32,272H16v80H96V336A64.07,64.07,0,0,0,32,272Z" />
            <path d="M480,144h16V64H416V80A64.07,64.07,0,0,0,480,144Z" />
            <path d="M416,336v16h80V272H480A64.07,64.07,0,0,0,416,336Z" />
            <circle cx="256" cy="208" r="64" />
          </svg>
        </span>
        <div class="label">
          <h2 class="title"> IDR. <?php echo number_format($monthNow, '0', ",", "."); ?> </h2>
          <h2 class="subtitle">Total Penghasilan</h2>
        </div>
      </li>
      <li class="list {{ $monthNow <= $beforeMonth ? 'danger' : 'success' }}">
        @if ($monthNow <= $beforeMonth) <span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
            <polyline points="352 368 464 368 464 256" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:32px" />
            <polyline points="48 144 192 288 288 192 448 352" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:32px" />
          </svg>
          </span>
          @else
          <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="auto" height="auto" viewBox="0 0 512 512">
              <polyline points="352 144 464 144 464 256" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:32px" />
              <polyline points="48 368 192 224 288 320 448 160" style="fill:none;stroke:#000;stroke-linecap:square;stroke-miterlimit:10;stroke-width:32px" />
            </svg>
          </span>
          @endif
          <div class="label">
            <h2 class="title"> {{ $monthNow <= $beforeMonth ? "-" . number_format((($monthNow / $beforeMonth) * 100), 1) : number_format((($beforeMonth / $monthNow) * 100), 1) }}% </h2>
            <h2 class="subtitle"> Persentase </h2>
          </div>
      </li>
    </ul>
  </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/js/plugins/apexchart.min.js') }}"></script>
<script>
  var foods = <?php echo json_encode($foods) ?>;
  var drinks = <?php echo json_encode($drinks) ?>;
  var others = <?php echo json_encode($others) ?>;

  var AreaOptions = {
    series: [{
        name: "series1",
        data: [31, 40, 28, 51, 42, 109, 100],
      },
      {
        name: "series2",
        data: [11, 32, 45, 32, 34, 52, 41],
      },
    ],
    chart: {
      height: 350,
      type: "area",
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "smooth",
    },
    xaxis: {
      type: "datetime",
      categories: [
        "2018-09-19T00:00:00.000Z",
        "2018-09-19T01:30:00.000Z",
        "2018-09-19T02:30:00.000Z",
        "2018-09-19T03:30:00.000Z",
        "2018-09-19T04:30:00.000Z",
        "2018-09-19T05:30:00.000Z",
        "2018-09-19T06:30:00.000Z",
      ],
    },
    tooltip: {
      x: {
        format: "dd/MM/yy HH:mm",
      },
    },
  };

  var Area = new ApexCharts(
    document.querySelector("#totalSales"),
    AreaOptions
  );
  Area.render();

  var PieOptions = {
    chart: {
      type: "donut",
      width: 400,
    },
    colors: ["#2196f3", "#e2a03f", "#8738a7"],
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: "bottom",
      horizontalAlign: "center",
      fontSize: "16px",
      markers: {
        width: 10,
        height: 10,
      },
      itemMargin: {
        horizontal: 0,
        vertical: 8,
      },
    },
    plotOptions: {
      pie: {
        donut: {
          size: "65%",
          background: "transparent",
          labels: {
            show: true,
            name: {
              show: true,
              fontSize: "29px",
              fontFamily: "Sharp Sans, sans-serif",
              color: undefined,
              offsetY: -10,
            },
            value: {
              show: true,
              fontSize: "26px",
              fontFamily: "Quicksand, sans-serif",
              color: "20",
              offsetY: 16,
              formatter: function(val) {
                return val;
              },
            },
            total: {
              show: true,
              showAlways: true,
              label: "Total",
              color: "#888ea8",
              formatter: function(w) {
                return w.globals.seriesTotals.reduce(
                  function(a, b) {
                    return a + b;
                  },
                  0
                );
              },
            },
          },
        },
      },
    },
    stroke: {
      show: true,
      width: 25,
    },
    series: [foods, drinks, others],
    labels: ['Makanan', 'Minunan', 'Lain-lain'],
    responsive: [{
      breakpoint: 1599,
      options: {
        chart: {
          width: "500px",
          height: "400px",
        },
        legend: {
          position: "bottom",
        },
      },
      breakpoint: 1439,
      options: {
        chart: {
          width: "300px",
          height: "390px",
        },
        legend: {
          position: "bottom",
        },
        plotOptions: {
          pie: {
            donut: {
              size: "65%",
            },
          },
        },
      },
    }, ],
  };

  var Pie = new ApexCharts(
    document.querySelector("#category"),
    PieOptions
  );
  Pie.render();
</script>
@endpush