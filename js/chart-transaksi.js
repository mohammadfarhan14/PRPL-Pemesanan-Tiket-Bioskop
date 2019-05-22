$(function() {
    $.ajax({

        url: 'http://localhost/mybioskop/json/statistik_transaksi_harian.json',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "",
                "xAxisName": "Tanggal Penjualan",
                "yAxisName": "Jumlah Penjualan (Rp)",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'line',
                renderAt: 'chart-transaksi',
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