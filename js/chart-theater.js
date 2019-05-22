$(function() {
    $.ajax({

        url: 'http://localhost/mybioskop/json/statistik_theater_harian.json',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "",
                "xAxisName": "Theater(Jam Tayang)",
                "yAxisName": "Jumlah Pengunjung",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'column2d',
                renderAt: 'chart-theater',
                width: '750',
                height: '450',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "data": chartData
                }
            });
            apiChart.render();
        }
    });
});