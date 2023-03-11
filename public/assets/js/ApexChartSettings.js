var seriesSellings = [];

Object.values(topSellings).forEach((element) => {
    seriesSellings.push(parseInt(element));
});

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
                size: "50%",
                background: "transparent",
                labels: {
                    show: true,
                    name: {
                        show: true,
                        fontSize: "18px",
                        fontFamily: "Sharp Sans, sans-serif",
                        color: undefined,
                        offsetY: -10,
                    },
                    value: {
                        show: true,
                        fontSize: "24px",
                        fontFamily: "Quicksand, sans-serif",
                        color: "20",
                        offsetY: 16,
                        formatter: function (val) {
                            return val;
                        },
                    },
                    total: {
                        show: true,
                        showAlways: true,
                        label: "Total",
                        color: "#888ea8",
                        formatter: function (w) {
                            return w.globals.seriesTotals.reduce(function (
                                a,
                                b
                            ) {
                                return Math.max(a, b);
                            },
                            0);
                        },
                    },
                },
            },
        },
    },
    stroke: {
        show: true,
        width: 16,
    },
    series: seriesSellings,
    labels: labelSellings,
    responsive: [
        {
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
        },
    ],
};

var Pie = new ApexCharts(document.querySelector("#category"), PieOptions);

Pie.render();

var totalRevenue = [];

Object.values(beforeMonth).forEach((element) => {
    totalRevenue.push(parseInt(element));
});

var AreaOptions = {
    series: [
        {
            name: "Bulan lalu",
            data: [totalRevenue[1], totalRevenue[2]],
        },
        {
            name: "Saat ini",
            data: [0, totalRevenue[0]],
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
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        crosshairs: {
            show: true,
        },
    },
    labels: labelRevenue.reverse(),
    tooltip: {
        x: {
            format: "dd/MM/yy HH:mm",
        },
    },
};

var Area = new ApexCharts(document.querySelector("#totalSales"), AreaOptions);
Area.render();
