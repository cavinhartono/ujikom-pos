@extends('layouts.master')

@push('title')
Dashboard | Shopcube
@endpush

@section('overview')
<div class="label">
  <h2 class="title">Dashboard</h2>
</div>
<div class="full-content gap">
  <ul class="card">
    <li class="list" style="background: var(--fifth-color)">
      <h2 class="subtitle">Total Sales</h2>
      <h2 class="subtitle value">@money($orders->sum('price'))</h2>
    </li>
    <li class="list" style="background: var(--third-color)">
      <h2 class="subtitle">Orders</h2>
      <h2 class="subtitle value"> {{ $orders->count() }} </h2>
    </li>
    <li class="list" style="background: var(--fourth-color)">
      <h2 class="subtitle">Customers</h2>
      <h2 class="subtitle value">{{ $customers->count() }} Orang</h2>
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
  <div class="customers full-content" style="margin: var(--md) 0">
    <div class="label">
      <h2 class="subtitle">Pelanggan Terakhir</h2>
    </div>
    <table class="table full-content" style="margin-top: var(--md)">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Last Seen</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>C0000</td>
          <td>Marselinus Cavin Hartono</td>
          <td>2 jam yang lalu</td>
        </tr>
        @forelse($customerLast as $customer)
        <tr>
          <td>{{ $customer->customer_index }}</td>
          <td>{{ $customer->name }}</td>
          <td>{{ Carbon\Carbon::parse($customer->created_at)->diffForHumans() }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="3">Tidak ada</td>
        </tr>
        @endforelse
      </tbody>
    </table>
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