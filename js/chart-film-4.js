$(function() {
    $.ajax({

        url: 'http://localhost/mybioskop/json/statistik_film_4.json',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "FILM LOGAN",
                "xAxisName": "Tanggal Penayangan",
                "yAxisName": "Jumlah Penjualan (Rp)",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'line',
                renderAt: 'chart-film-4',
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