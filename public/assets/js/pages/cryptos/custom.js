$(document).ready(function() {
    $(".loader-box").css({
        'height': $('.crypto-contents').innerHeight() + "px"
    });
    $(".crypto-contents").css("opacity", "0.3");
    $.ajax({
        /* the route pointing to the post function */
        url: '/api/cryptos/highlights',
        type: 'get',
        /* remind that 'data' is the response of the AjaxController */
        success: function(res) {
            if (res.success) {
                if (res.data.length != 0)
                    for (var i = 0; i < res.data.length; i++) {
                        var adjustedData = [];
                        var displayData = [res.data[i]['name'], res.data[i]['price'], res.data[i]['change_percentage'], res.data[i]['symbol']];
                        if (res.data[i]['chart'] && res.data[i]['chart'].length != 0) {
                            for (var j = 0; j < res.data[i]['chart'].length; j++) {
                                var crypto = res.data[i]['chart'][j];
                                var date = new Date(crypto[0]);
                                adjustedData[j] = [date.getTime(), Number((crypto[1] * 1).toFixed(2))]
                            }
                            renderChart(adjustedData, (i + 1), 'USD', displayData);
                        } else {
                            $.notify('<i class="fa fa-bell-o"></i>You selected one highlighted fund that had no chart info!', {
                                type: 'theme',
                                allow_dismiss: true,
                                delay: 2000,
                                showProgressbar: false,
                                timer: 4000
                            });

                            $("#chart-timeline-dashboard" + (i + 1)).text('No Chart Data!');
                            $("#h_crypto_title" + index).html(displayData[0]);
                            $("#h_crypto_title" + index).attr('title', displayData[0]);
                            $("#h_crypto_link" + index).attr('href', '/cryptos/' + displayData[3]);
                            $("#h_crypto_title" + index).tooltip();
                            $("#current_crypto_price" + index).html(formatPrice(displayData[1], 'USD'));
                            $("#current_crypto_percentage" + index).html(formatPercentage(displayData[2]));
                            if (displayData[2] >= 0)
                                $("#current_crypto_percentage" + index).addClass("font-primary");
                            else
                                $("#current_crypto_percentage" + index).addClass("font-danger");
                        }
                        if (i == res.data.length - 1) {
                            $(".crypto-contents").css("opacity", "1");
                            $(".loader-box").css('display', 'none');
                        }
                    }
                else {
                    $(".crypto-contents").css("opacity", "1");
                    $(".loader-box").css('display', 'none');
                    $('.crypto-contents .row').html('<div class="col-sm-12 d-flex justify-content-center p-12"><h5>No Highlighted CryptoCurrency!</h5></div>');
                }
            }
        }
    });
});

function renderChart(adjustedData, index, currency, displayData) {
    var options = {
        series: [{
            name: "Closing Price",
            data: adjustedData
        }],
        stroke: {
            show: true,
            width: 3,
        },
        chart: {
            id: 'area-datetime',
            type: 'area',
            height: 200,
            zoom: {
                autoScaleYaxis: false
            },
            toolbar: {
                show: false
            },
        },
        dataLabels: {
            enabled: false,
        },
        markers: {
            size: 0,
            style: 'hollow',
        },
        xaxis: {
            type: 'datetime',
            min: adjustedData[0][0],
            tickAmount: 6,
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false
            },
            labels: {
                show: false
            }
        },
        yaxis: {
            labels: {
                show: false
            }
        },
        tooltip: {
            x: {
                format: 'yyyy-MM-dd HH:mm'
            },
            y: {
                formatter: function(val) {
                    return formatPrice(val, 'USD');
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.9,
                stops: [0, 100]
            }
        },
        responsive: [{
                breakpoint: 1366,
                options: {
                    chart: {
                        height: 180
                    }
                }
            },
            {
                breakpoint: 1238,
                options: {
                    chart: {
                        height: 160
                    },
                    grid: {
                        padding: {
                            bottom: 5,
                        },
                    }
                }
            },
            {
                breakpoint: 992,
                options: {
                    chart: {
                        height: 140
                    }
                }
            },
            {
                breakpoint: 551,
                options: {
                    grid: {
                        padding: {
                            bottom: 10,
                        },
                    }
                }
            },
            {
                breakpoint: 535,
                options: {
                    chart: {
                        height: 120
                    }

                }
            }
        ],

        colors: [appConfig.crypto],
    };
    var charttimeline = new ApexCharts(document.querySelector("#chart-timeline-dashboard" + index), options);
    charttimeline.render();
    $("#h_crypto_title" + index).html(displayData[0]);
    $("#h_crypto_title" + index).attr('title', displayData[0]);
    $("#h_crypto_link" + index).attr('href', '/cryptos/' + displayData[3]);
    $("#h_crypto_title" + index).tooltip();
    $("#current_crypto_price" + index).html(formatPrice(displayData[1], currency));
    $("#current_crypto_percentage" + index).html(formatPercentage(displayData[2]/100));
    if (displayData[2] >= 0)
        $("#current_crypto_percentage" + index).addClass("font-primary");
    else
        $("#current_crypto_percentage" + index).addClass("font-danger");
}