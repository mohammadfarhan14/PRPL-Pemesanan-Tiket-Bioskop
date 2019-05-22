$(function() {
    $.ajax({

        url: 'http://localhost/mybioskop/json/statistik_film_3.json',
        type: 'GET',
        success: function(data) {
            chartData = data;
            var chartProperties = {
                "caption": "FILM STAR WARS VIII",
                "xAxisName": "Tanggal Penayangan",
                "yAxisName": "Jumlah Penjualan (Rp)",
                "rotatevalues": "1",
                "theme": "zune"
            };

            apiChart = new FusionCharts({
                type: 'line',
                renderAt: 'chart-film-3',
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