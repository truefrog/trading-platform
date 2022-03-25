@extends('layouts.dashboard')

@section('title', 'Transaction')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')

<!-- Zero Configuration  Starts-->
<div class="col-sm-12 dashboard-content-wrapper">
    <div class="card">
        <div class="col-xl-12">
            <div class="d-flex justify-content-center align-items-center" id="ad1_container">
                <a href="https://bannerboo.com/" target="_blank">
                    <img src="{{ 'storage/'.$ads[0]['source'] }}" class="img-fluid" alt="">
                </a>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center" id="ad2_container">
            <ul>
                <li>
                    <a href="https://bannerboo.com/" target="_blank">
                        <img src="{{ 'storage/'.$ads[1]['source'] }}" class="img-fluid" alt="">
                    </a>
                </li>
            </ul>
            <a href="javascript:void(0)" onclick="hide_ad()" style="position: absolute; top:10px; right:10px;"><i class="fa fa-times fs-5"></i></a>
        </div>
        <div class="card-header d-flex justify-content-between p-b-0">
            <h2>Available XTBs <img src="{{asset('assets/images/pros/asx_logo.png')}}" alt=""></h2>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <p class="fs-5"><i class="fa fa-info-circle fs-5"></i> Hover over headings for more detail. Click header to sort column.</p>
                <table class="display" id="basic-1">
                    <thead>
                        <tr style="background-color: #374147; color:#c0c2c4!important;">
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="This ticker code to trade on ASX">ASX CODE</th>
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Company issuing underlying bond">BOND ISSUER</th>
                            <th class="fw-normal sorting_disabled" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Face Value ($100) returned on this date">MATURITY DATE</th>
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Fixed or Floating">COUPON TYPE</th>
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="If purchased before this date, the next coupon will be received.">NEXT EX.DATE</th>
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="The coupon (interest) per annum">COUPON P.A</th>
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Price per unit on ASX (closing price, previous business day)">XTB PRICE</th>
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Yield to Maturity - Total return if held to maturity. The key measure for fixed-rate bonds.">YTM</th>
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Current coupon rate expressed as a percentage of the price.">RUNNING / CURRENT YIELD</th>
                            <th class="fw-normal" scope="col" data-bs-toggle="tooltip" data-bs-placement="top" title="Average margin earned above BBSW if held to maturity. The key measure for floating-rate bonds">TRADING MARGIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($xtbs as $xtb)
                        <tr>
                            <td class="text-nowrap text-secondary" style="color: #bfc1c3;">{{ $xtb->asx_code }}</td>
                            <td class="text-nowrap" style="color: #0081a6;"><a href="https://xtbs.com.au/xtbs-profile/{{ $xtb->asx_code }}" target="_blank">{{ $xtb->bond_issuer }}</a></td>
                            <td class="text-nowrap text-dark" style="color:#5b6770;">{{ date('j.M.Y', strtotime($xtb->maturity_date)) }}</td>
                            <td class="text-nowrap text-secondary">{{ ($xtb->coupon_type == "")?$xtb->coupon_type:"-" }}</td>
                            <td class="text-nowrap text-secondary" style="color: #bfc1c3;">{{ date('j.M.Y', strtotime($xtb->next_ex_date)) }}</td>
                            <td class="text-nowrap text-info" style="color:#7a2a90;">{{ ($xtb->coupon_pa && $xtb->coupon_pa != "")?$xtb->coupon_pa:"-" }}</td>
                            <td class="text-nowrap text-success" style="color:#5b6770;">{{ "$".$xtb->xtb_price }}</td>
                            <td class="text-nowrap text-primary" style="color:#00b388;">{{ ($xtb->ytm !="")?$xtb->ytm."%":"-" }}</td>
                            <td class="text-nowrap text-dark" style="color: #333f48;">{{ $xtb->current_yield."%" }}</td>
                            <td class="text-nowrap text-danger">{{ ($xtb->trading_margin !="")?$xtb->trading_margin."%":"-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="disclamer-wrapper">
                <h6>DISCLAIMER</h6>
                <div class="disclamer-content">
                    <p>Each class of XTB is separate to each other class and is linked to the performance, after fees and expenses, of the specific underlying bond (as per the table above). You can choose which XTBs to invest in and accordingly which specific bonds you will have an economic exposure to from this table. An investment in an XTB is not a direct investment in the underlying bond. However, the performance of an XTB is linked to the performance, after fees and expenses, of the underlying bond. For further information on fees and expenses and how this may impact your investment in XTBs, please refer to the relevant <a href="https://xtbs.com.au/product-disclosure-statements/">Product Disclosure Statement</a> (PDS). <a href="https://xtbs.com.au/wp-content/uploads/2021/08/XTB_Australian_Tax_Guide_2021.pdf">Australian Tax Guide</a> has been prepared for an Australian resident individual investor in an XTB. It contains general information to assist you in completing your 2021 Tax Return.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 box-col-12 des-xl-100">
        <div class="card news-container">
            <div class="card-header d-flex justify-content-between">
                <div class="header-top d-sm-flex align-items-center">
                    <h5>Recent News</h5>
                </div>
                <a href="/news?symbols={{implode(',', $news_symbols)}}" class="btn btn-outline-success btn-xs" style="line-height: 20px;">See More</a>
            </div>
            <div class="card-body">
                <div class="loader-box news-loader justify-content-center align-items-center w-full" style="inset:0px; position:absolute; z-index:10; display:flex; height:initial;">
                    <div class="loader-19"></div>
                </div>
                <div class="row news-content" style="min-height: 440px;">
                    <div class="col-xl-3 col-md-6 news-0" style="display: none;">
                        <a href="" class="news-link-0" target="_blank">
                            <div class="prooduct-details-box">
                                <div class="media" style="text-align: center; padding:10px 0px; min-height:410px;">
                                    <img class="align-self-center img-fluid news-img-0" src="" style="max-height: 180px;" alt="#">
                                    <div class="media-body">
                                        <p class="news-date-0 text-dark mb-0"></p>
                                        <h6 class="news-headline-0"></h6>
                                        <div class="summary news-summary-0"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6 news-1" style="display: none;">
                        <a href="" class="news-link-1" target="_blank">
                            <div class="prooduct-details-box">
                                <div class="media" style="text-align: center; padding:10px 0px; min-height:410px;">
                                    <img class="align-self-center img-fluid news-img-1" src="" style="max-height: 180px;" alt="#">
                                    <div class="media-body">
                                        <p class="news-date-1 text-dark mb-0"></p>
                                        <h6 class="news-headline-1"></h6>
                                        <div class="summary news-summary-1"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6 news-2" style="display: none;">
                        <a href="" class="news-link-2" target="_blank">
                            <div class="prooduct-details-box">
                                <div class="media" style="text-align: center; padding:10px 0px; min-height:410px;">
                                    <img class="align-self-center img-fluid news-img-2" src="" style="max-height: 180px;" alt="#">
                                    <div class="media-body">
                                        <p class="news-date-2 text-dark mb-0"></p>
                                        <h6 class="news-headline-2"></h6>
                                        <div class="summary news-summary-2"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-6 news-3" style="display: none;">
                        <a href="" class="news-link-3" target="_blank">
                            <div class="prooduct-details-box">
                                <div class="media" style="text-align: center; padding:10px 0px; min-height:410px;">
                                    <img class="align-self-center img-fluid news-img-3" src="" style="max-height: 180px;" alt="#">
                                    <div class="media-body">
                                        <p class="news-date-3 text-dark mb-0"></p>
                                        <h6 class="news-headline-3"></h6>
                                        <div class="summary news-summary-3"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row no-news" style="display: none;">
                    <div class="col-sm-12">
                        <div class="alert alert-light dark alert-dismissible fade show" id="zero_shares_alert" role="alert">
                            There are no recent news.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Zero Configuration  Ends-->

@push('scripts')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<script>
    $('#basic-1').dataTable({
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [2, 3, 4]
        }]
    });

    function hide_ad() {
        $("#ad1_container").removeClass("d-flex");
        $("#ad1_container").addClass("d-none");
        $("#ad2_container").removeClass("d-flex");
        $("#ad2_container").addClass("d-none");
        $(".dashboard-content-wrapper").css("padding-right", "0px");
        $(".dashboard-content-wrapper").css("padding-top", "0px");
    }
</script>
@endpush

@endsection