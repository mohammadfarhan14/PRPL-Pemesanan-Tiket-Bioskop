$(function() {
    $.ajax({

        url: 'http://localhost/mybioskop/json/statistik_film_1.json',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "FILM ZOOTOPIA",
                "xAxisName": "Tanggal Penayangan",
                "yAxisName": "Jumlah Penjualan (Rp)",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'line',
                renderAt: 'chart-film-1',
                width: '350',
                height: '350',
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