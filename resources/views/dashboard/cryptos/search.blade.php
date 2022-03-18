@extends('layouts.dashboard')

@section('title', 'Trade Now')

@section('content')
<div class="col-sm-12">
    @if(!request()->filled('page') && !request()->filled('q'))
    <div class="card">
        <div class="card-header">
            <div class="header-top">
                <h5>Highlighted Cryptocurrencies</h5>
            </div>
        </div>
        <div class="card-body col-sm-12 crypto-contents">
            <div class="loader-box justify-content-center align-items-center w-full" style="inset:0px; position:absolute; z-index:10; display:flex;">
                <div class="loader-19"></div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="card income-card shadow shadow-showcase">
                        <div class="card-body p-0">
                            <div class="chart-content">
                                <div id="chart-timeline-dashboard1" style="min-height: 285px;">
                                </div>
                            </div>
                            <div class="d-flex-column p-2">
                                <a href="" id="h_crypto_link1">
                                    <h6 id="h_crypto_title1" class="fs-20" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"></h6>
                                </a>
                                <div class="center-content">
                                    <p class="d-sm-flex align-items-end">
                                        <span class="font-primary m-r-10 f-16 f-w-700" id="current_crypto_price1"></span>
                                        <span class="" id="current_crypto_percentage1"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card income-card shadow shadow-showcase">
                        <div class="card-body p-0">
                            <div class="chart-content">
                                <div id="chart-timeline-dashboard2" style="min-height: 285px;">
                                </div>
                            </div>
                            <div class="d-flex-column p-2">
                                <a href="" id="h_crypto_link2">
                                    <h6 id="h_crypto_title2" class="fs-20" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"></h6>
                                </a>
                                <div class="center-content">
                                    <p class="d-sm-flex align-items-end">
                                        <span class="font-primary m-r-10 f-16 f-w-700" id="current_crypto_price2"></span>
                                        <span class="" id="current_crypto_percentage2"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card income-card shadow shadow-showcase">
                        <div class="card-body p-0">
                            <div class="chart-content">
                                <div id="chart-timeline-dashboard3" style="min-height: 285px;">
                                </div>
                            </div>
                            <div class="d-flex-column p-2">
                                <a href="" id="h_crypto_link3">
                                    <h6 id="h_crypto_title3" class="fs-20" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"></h6>
                                </a>
                                <div class="center-content">
                                    <p class="d-sm-flex align-items-end">
                                        <span class="font-primary m-r-10 f-16 f-w-700" id="current_crypto_price3"></span>
                                        <span class="" id="current_crypto_percentage3"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card income-card shadow shadow-showcase">
                        <div class="card-body p-0">
                            <div class="chart-content">
                                <div id="chart-timeline-dashboard4" style="min-height: 285px;">
                                </div>
                            </div>
                            <div class="d-flex-column p-2">
                                <a href="" id="h_crypto_link4">
                                    <h6 href="#" id="h_crypto_title4" class="fs-20" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"></h6>
                                </a>
                                <div class="center-content">
                                    <p class="d-sm-flex align-items-end">
                                        <span class="font-primary m-r-10 f-16 f-w-700" id="current_crypto_price4"></span>
                                        <span class="" id="current_crypto_percentage4"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="card mb-3">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col">
                    @if(request()->filled('q') || request()->filled('ex'))
                    <h4 class="mb-0">Results ({{ $cryptos->total() }})</h4>
                    @else
                    <h4 class="mb-0">All Cryptocurrencies ({{ $cryptos->total() }})</h4>
                    @endif
                </div>
                <div class="col-auto d-flex justify-content-between">
                    <form action="{{ route('cryptos.search') }}" class="ms-3" style="min-width: 200px;">
                        <div class="search d-flex">
                            <input type="text" class="form-control" placeholder="Search" name="q" value="{{ request()->q }}">
                            <button type="submit" id="search_btn" class="btn btn-iconsolid" href="javascript:void(0)"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Symbol</th>
                                <th scope="col">Cryptocurrency Name</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cryptos as $crypto)
                            <tr>
                                <td width="10%">{{ $crypto->symbol }}</td>
                                <td>{{ $crypto->name }}</td>
                                <td width="10%" class="text-right" nowrap>
                                    <a type="button" class="btn btn-outline-success btn-xs" href="{{ route('cryptos.show', ['symbol' => $crypto->symbol]) }}">See More</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($cryptos->isEmpty())
                    <div class="p-10 d-flex justify-content-center">
                        There are no cryptos that match your search result
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end pb-3">
        {{ $cryptos->appends(request()->query())->links() }}
    </div>
</div>
@push('scripts')
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
<script>
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
                                renderChart(adjustedData, (i + 1), res.data[i]['gcurrency'], displayData);
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
                                $("#current_crypto_price" + index).html(formatPrice(displayData[1], currency));
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
                        return '$'+val;
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

            colors: [vihoAdminConfig.primary],
        };
        var charttimeline = new ApexCharts(document.querySelector("#chart-timeline-dashboard" + index), options);
        charttimeline.render();
        $("#h_crypto_title" + index).html(displayData[0]);
        $("#h_crypto_title" + index).attr('title', displayData[0]);
        $("#h_crypto_link" + index).attr('href', '/cryptos/' + displayData[3]);
        $("#h_crypto_title" + index).tooltip();
        $("#current_crypto_price" + index).html(formatPrice(displayData[1], currency));
        $("#current_crypto_percentage" + index).html(formatPercentage(displayData[2]));
        if (displayData[2] >= 0)
            $("#current_crypto_percentage" + index).addClass("font-primary");
        else
            $("#current_crypto_percentage" + index).addClass("font-danger");
    }

    // format Price and Percentage functions
    function formatPrice(price, currency) {
        switch (currency) {
            case "USD":
                return "$" + Number(price).toFixed(2);
                break;

            case "GBP":
                return Number(price * 100).toFixed(2) + "p";
                break;

            case "EUR":
                return Number(price.toFixed(2)) + "€";
                break;

            case "AUD":
                return "A$" + Number(price.toFixed(2)) + "€";
                break;

            case "CAD":
                return "C$" + Number(price.toFixed(2));
                break;

            default:
                return price;
                break;
        }
    }

    function formatPercentage(percentage) {
        return Number(percentage).toFixed(2) + "%";
    }
</script>
@endpush
@endsection