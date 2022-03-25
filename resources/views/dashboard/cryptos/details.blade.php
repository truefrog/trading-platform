@extends('layouts.dashboard')
@section('title', array_get($data, 'name'))

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/prism.css')}}">
@endpush

@section('content')
<div class="col-md-12 stock-details dashboard-content-wrapper">
    <div class="col-xl-12">
        <div class="d-flex justify-content-center align-items-center" id="ad1_container">
            <a href="https://bannerboo.com/" target="_blank">
                <img src="{{ '/storage/'.$ads[0]['source'] }}" class="img-fluid" alt="">
            </a>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center" id="ad2_container">
        <ul>
            <li>
                <a href="https://bannerboo.com/" target="_blank">
                    <img src="{{ '/storage/'.$ads[1]['source'] }}" class="img-fluid" alt="">
                </a>
            </li>
        </ul>
        <a href="javascript:void(0)" onclick="hide_ad()" style="position: absolute; top:10px; right:10px;"><i class="fa fa-times fs-5"></i></a>
    </div>
    <div class="row">
        <div class="col">
            <div class="card income-card">
                <div class="card-header">
                    <div class="header-top d-flex justify-content-between">
                        <div class="title-content">
                            <h5>{{ array_get($data, 'name') }}</h5>
                            <div class="center-content">
                                <p class="d-sm-flex align-items-center">
                                    <span class="font-primary m-r-10 f-22 f-w-700" id="current_crypto_price"></span>
                                    @if((float)array_get($data, 'change_percentage', 'null') >= 0)
                                    <span class="font-primary" id="current_crypto_percentage"></span>
                                    @else
                                    <span class="font-danger" id="current_crypto_percentage"></span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-danger-gradien" type="button" data-bs-toggle="modal" data-bs-target="#buyCryptosModal">Buy Cryptos</button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="loader-box chart-loader justify-content-center align-items-center" style="inset:0px; position:absolute; z-index:10; display:flex;">
                        <div class="loader-19"></div>
                    </div>
                    <div class="chart-content">
                        <div id="chart-timeline-dashboard" class="d-flex justify-content-center align-items-center" style="min-height: 440px;">
                        </div>
                        <div class="d-flex justify-content-end p-10" id="range_btn_group">
                            <div class="btn-group btn-group-square" id="range_group" role="group">
                                <button class="btn btn-outline-dark active" type="button" onclick="updateChart('1d', this)">1d</button>
                                <button class="btn btn-outline-dark" type="button" onclick="updateChart('5d', this)">5d</button>
                                <button class="btn btn-outline-dark" type="button" onclick="updateChart('1m', this)">1m</button>
                                <button class="btn btn-outline-dark" type="button" onclick="updateChart('6m', this)">6m</button>
                                <button class="btn btn-outline-dark" type="button" onclick="updateChart('ytd', this)">ytd</button>
                                <button class="btn btn-outline-dark" type="button" onclick="updateChart('1y', this)">1y</button>
                                <button class="btn btn-outline-dark" type="button" onclick="updateChart('5y', this)">5y</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(array_get($data, 'source') != 'custom')
    <div class="row">
        <div class="col">
            <h2 class="title">Crypto Details</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Crypto Information</h4>
                            <div class="crypto-information">
                                {{ array_get($data, "info.description", "-") }}
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex flex-column justify-content-between">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="detail">
                                        <strong>Latest Price</strong>
                                        <span>{{ '$'.array_get($data, 'price', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>Market Cap</strong>
                                        <span>{{ array_get($data, 'numbers.market_cap', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>ATH</strong>
                                        <span>{{ array_get($data, 'numbers.ath', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>Total Volume</strong>
                                        <span>{{ array_get($data, 'numbers.total_volume', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>Total Supply</strong>
                                        <span>{{ array_get($data, 'numbers.total_supply', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>Circulating Supply</strong>
                                        <span>{{ array_get($data, 'numbers.circulating_supply', '-') }}</span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="detail">
                                        <strong>Genesis Date</strong>
                                        <span>{{ array_get($data, 'info.genesis_date', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>Block Time</strong>
                                        <span>{{ array_get($data, 'info.block_time', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>Hashing Algorithm</strong>
                                        <span>{{ array_get($data, 'info.hashing_algorithm', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>Institutional Price</strong>
                                        <span>{{ array_get($data, 'numbers.institutional_price', '-') }}</span>
                                    </div>
                                    <div class="detail">
                                        <strong>Website</strong>
                                        <a href="{{ array_get($data, 'info.website', '-') }}" target="_blank">{{ array_get($data, 'info.website', '-') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(array_get($data, 'link'))
    <div class="row link">
        <div class="col d-flex justify-content-end mt-3">
            <a href="{{ array_get($data, 'link') }}" target="_blank" class="more-info-link">Click here for more information about this stock</a>
        </div>
    </div>
    @endif
    <div class="modal fade" id="buyCryptosModal" tabindex="-1" role="dialog" aria-labelledby="Document Modal Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buy {{array_get($data, "name")}}</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Below you will find the most recent information about the stock you would like to buy shares from</h6>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Symbol</strong>
                                </td>
                                <td>{{array_get($data, "symbol")}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Crypto Name</strong>
                                </td>
                                <td>{{array_get($data, "name")}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Retail Price</strong>
                                </td>
                                <td>${{(array_get($data, "price")*1>10)?number_format(array_get($data, "price"), 2):((array_get($data, "price")*1>1)?number_format(array_get($data, "price"), 3):number_format(array_get($data, "price"), 6))}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Institutional Price</strong>
                                </td>
                                <td>{{ array_get($data, 'numbers.institutional_price', '-') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" placeholder="Enter the amount of shares" required id="shares_amount">
                        <small>Your account manager will contact you as soon as possible to confirm best price.</small>
                    </div>
                    <div class="alert-wrapper"></div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-rounded btn-animated" onclick="buyCrypto(this)">
                            Buy
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
<script>
    $(document).ready(function() {
        var intro = $('.crypto-information').text();
        $('.crypto-information').html(intro);

        $(".chart-loader").css({
            'top': $('.card-header').innerHeight() + "px",
            'height': $('.chart-content').innerHeight() + "px"
        });
        $(".chart-content").css("opacity", "0.3");
        renderChart('1d');

    });

    function renderChart(range) {
        $.ajax({
            url: '/api/cryptos/chart/{{ array_get($data, "symbol") }}/' + range,
            type: 'get',
            success: function(res) {
                if (res.success && res.data.length != 0) {
                    var adjustedData = [];
                    for (var i = 0; i < res.data.length; i++) {
                        var date = new Date(res.data[i][0]);
                        var unit_price = 0;
                        if (Number(res.data[i][1] * 1) > 10) {
                            unit_price = Number((res.data[i][1] * 1).toFixed(2))
                        } else if (Number(res.data[i][1] * 1) > 1) {
                            unit_price = Number((res.data[i][1] * 1).toFixed(3))
                        } else if (Number(res.data[i][1] * 1) > 0.1) {
                            unit_price = Number((res.data[i][1] * 1).toFixed(4))
                        } else if (Number(res.data[i][1] * 1) > 0.01) {
                            unit_price = Number((res.data[i][1] * 1).toFixed(5))
                        } else if (Number(res.data[i][1] * 1) > 0.001) {
                            unit_price = Number((res.data[i][1] * 1).toFixed(6))
                        } else if (Number(res.data[i][1] * 1) > 0.0001) {
                            unit_price = Number((res.data[i][1] * 1).toFixed(7))
                        } else {
                            unit_price = Number((res.data[i][1] * 1).toFixed(8))
                        }
                        adjustedData[i] = [date.getTime(), unit_price]
                    }
                    var options = {
                        series: [{
                            name: "Closing Price",
                            data: adjustedData
                        }],
                        chart: {
                            id: 'area-datetime',
                            type: 'area',
                            height: 425,
                            zoom: {
                                autoScaleYaxis: true
                            },
                            toolbar: {
                                show: false
                            },
                        },
                        dataLabels: {
                            enabled: false
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
                                show: true,
                            },
                            axisBorder: {
                                show: true
                            },
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
                                        height: 350
                                    }
                                }
                            },
                            {
                                breakpoint: 1238,
                                options: {
                                    chart: {
                                        height: 300
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
                                        height: 300
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
                                        height: 250
                                    }

                                }
                            }
                        ],

                        colors: [appConfig.crypto],
                    };
                    $("#chart-timeline-dashboard").empty();
                    var charttimeline = new ApexCharts(document.querySelector("#chart-timeline-dashboard"), options);
                    charttimeline.render();
                    $(".chart-content").css("opacity", "1");
                    $(".chart-loader").css('display', 'none');
                } else {
                    $("#chart-timeline-dashboard").empty();
                    $("#chart-timeline-dashboard").html("<h3>No Chart Data!</h3>");
                    $(".chart-content").css("opacity", "1");
                    $(".chart-loader").css('display', 'none');
                }
            }
        });
    }

    function buyCryptos(obj) {
        var shares_amount = $("#shares_amount").val();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var institutional_price = "{{ array_get($data, 'numbers.institutional_price', '-') }}";
        institutional_price = institutional_price.replace("$", "");
        institutional_price = institutional_price.replace("p", "");
        institutional_price = Number(institutional_price);

        if (Number(shares_amount) == 0) {
            $(".alert-wrapper").html('<div class="alert alert-danger dark alert-dismissible fade show" id="zero_shares_alert" role="alert">The shares must be at least 1.<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" style="top: 0px; right:0px;"></button></div>');
        } else {
            $(obj).attr('onclick', '');
            $(obj).html('<i class="fa fa-spin fa-spinner"></i>');
            $.ajax({
                    method: 'post',
                    url: '/api/cryptos/{{array_get($data, "symbol")}}/buy',
                    data: {
                        shares: shares_amount,
                        price: "{{array_get($data, 'price')}}",
                        institutional_price: institutional_price,
                        _token: csrf_token
                    },
                })
                .then(response => {
                    $(obj).attr('onclick', 'buyCryptos(this)');
                    $(obj).html('Buy');
                    if (response.success) {
                        $.notify('<i class="fa fa-star-o"></i>Successfully confirmed!', {
                            type: 'theme',
                            allow_dismiss: true,
                            delay: 2000,
                            showProgressbar: false,
                            timer: 1000
                        });
                    } else {
                        $.notify('<i class="fa fa-bell-o"></i>', {
                            type: 'theme',
                            allow_dismiss: true,
                            delay: 2000,
                            showProgressbar: false,
                            timer: 1000
                        });
                    }
                })
        }
    }

    function updateChart(range, obj) {
        $("#range_group button").removeClass("active");
        $(obj).addClass("active");
        $(".loader-box").css({
            'display': 'flex',
            'top': $('.card-header').innerHeight() + "px",
            'height': $('.chart-content').innerHeight() + "px"
        });
        $(".chart-content").css("opacity", "0.3");
        renderChart(range);
    }

    var current_price = Number("{{ array_get($data, 'price', 0) }}");
    $("#current_crypto_price").html(formatPrice(current_price, "USD"));
    $("#current_crypto_percentage").html(formatPercentage("{{ array_get($data, 'change_percentage', 0) }}" / 100));
</script>
@endpush
@endsection