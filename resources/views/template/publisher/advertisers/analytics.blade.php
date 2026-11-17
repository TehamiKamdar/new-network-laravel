@extends("layouts.publisher.publisher_panel")

@pushonce('styles')
<style>
    .search__box {
        float: left;
        width: 0;
        height: 4rem;
        /*   display: inline; */
        background: none;
        color: #ff3838;
        font-size: 1.1rem;
        border-radius: 2rem;
        outline: none;
        border: none;
        position: relative;
        opacity: 1;
        transition: all .75s ease-in;
        padding: 20px;
        /*   border: 2px solid tomato; */
        /*   margin-top: 5px; */
    }

    /* .search__box:focus, .search__box:hover {
  background-color: #f1f2f6;
} */

    .search__icon {
        box-sizing: border-box;
        float: right;
        font-size: 2.5rem;
        display: inline-block;
        /*   justify-content: center;
  align-items: center; */
        margin-left: .8rem;
        margin-top: 0;
        cursor: pointer;
        position: absolute;
        color: #ff3838;
        transition: all .25s ease-in;
        padding: .7rem;
        border-radius: 50%;

    }

    .showing {
        width: 85%;
        border: 1px solid red;
    }
    .cards{
        margin-top: 50px;
        width: auto;
    }
    .cards ul{
            list-style: none;
            padding-top: 20px;
    }
</style>
 <style>
                    .performance-stats-container {
                       
                        -webkit-overflow-scrolling: touch;
                        padding: 0 5px;
                        margin: 0 -5px;
                    }

                    .performance-tabs {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 8px;
                        justify-content: space-around;
                        padding-bottom: 1px;
                        min-width: min-content;
                    }

                    .performance-tab-item {
                        border: 1px solid #dee2e6 !important;
                        border-radius: 8px !important;
                        padding: 0.5rem 0.75rem !important;
                        min-width: 160px;
                        background: white;
                        transition: all 0.3s ease;
                        text-align: left;
                        white-space: nowrap;
                        height: 100%;
                    }

                    .performance-tab-item:hover {
                        border-color: rgb(91, 71, 251) !important;
                        transform: translateY(-2px);
                        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
                    }

                    .performance-tab-item.active {
                        border-color: #5b47fb !important;
                        background-color: rgba(13, 110, 253, 0.05) !important;
                        box-shadow: 0 3px 8px rgba(13, 110, 253, 0.15);
                    }

                    .performance-icon {
                        width: 50px;
                        height: 50px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-shrink: 0;
                    }

                    .performance-label {
                        font-size: 0.7rem;
                        font-weight: 500;
                        margin-bottom: 0.15rem;
                        line-height: 1.2;
                    }

                    .performance-value {
                        color: #212529;
                        line-height: 1.2;
                        font-size: 0.95rem;
                    }

                    .performance-change {
                        font-weight: 500;
                        font-size: 0.65rem;
                    }

                    .x-small {
                        font-size: 0.8rem !important;
                    }

                    .text-purple {
                        color: #6f42c1 !important;
                    }

                    .bg-purple {
                        background-color: #6f42c1 !important;
                    }

                    .text-orange {
                        color: #fd7e14 !important;
                    }

                    .bg-orange {
                        background-color: #fd7e14 !important;
                    }

                    /* Scrollbar styling */
                    .performance-stats-container::-webkit-scrollbar {
                        height: 4px;
                    }

                    .performance-stats-container::-webkit-scrollbar-track {
                        background: #f1f1f1;
                        border-radius: 10px;
                    }

                    .performance-stats-container::-webkit-scrollbar-thumb {
                        background: #c1c1c1;
                        border-radius: 10px;
                    }

                    .performance-stats-container::-webkit-scrollbar-thumb:hover {
                        background: #a8a8a8;
                    }

                    /* Responsive adjustments */
                    @media (max-width: 1200px) {
                        .performance-tab-item {
                            min-width: 150px;
                            padding: 0.45rem 0.65rem !important;
                        }

                        .performance-icon {
                            width: 32px;
                            height: 32px;
                        }

                        .performance-value {
                            font-size: 0.9rem !important;
                        }
                    }

                    @media (max-width: 768px) {
                        .performance-tab-item {
                            min-width: 140px;
                            padding: 0.4rem 0.6rem !important;
                        }

                        .performance-icon {
                            width: 30px;
                            height: 30px;
                        }

                        .performance-value {
                            font-size: 0.85rem !important;
                        }

                        .performance-label {
                            font-size: 0.65rem;
                        }
                    }

                    @media (max-width: 576px) {
                        .performance-tab-item {
                            min-width: 130px;
                            padding: 0.35rem 0.5rem !important;
                        }

                        .performance-icon {
                            width: 28px;
                            height: 28px;
                        }

                        .performance-value {
                            font-size: 0.8rem !important;
                        }

                        .performance-label {
                            font-size: 0.6rem;
                        }
                    }

                    .legend-static {
                        list-style: none;
                        padding: 0;
                        margin: 0;
                        display: flex;
                        gap: 20px;
                        align-items: center;
                    }

                    .legend-static .custom-label {
                        display: flex;
                        align-items: center;
                        gap: 8px;
                        font-size: 0.875rem;
                        color: #6c757d;
                        font-weight: 500;
                    }

                    .legend-static .custom-label span {
                        width: 16px;
                        height: 16px;
                        border-radius: 3px;
                        display: inline-block;
                        flex-shrink: 0;
                    }

                    /* Optional hover effect */
                    .legend-static .custom-label:hover {
                        color: #495057;
                    }

                    /* Responsive */
                    @media (max-width: 576px) {
                        .legend-static {
                            gap: 12px;
                        }

                        .legend-static .custom-label {
                            font-size: 0.8125rem;
                            gap: 6px;
                        }

                        .legend-static .custom-label span {
                            width: 12px;
                            height: 12px;
                        }
                    }
                </style>
@endpushonce

@pushonce('scripts')
<script>
    $(document).ready(function(){
         $('.cards').css('display','none')
    })
   
    function call_api() {
        let box = $('#box').val();
        let dataObj = {
            search: box
        };
        $.ajax({
            url: '{{ route("publisher.brand-finder") }}',
            type: 'GET',
            data: dataObj,
            success: function (response) {
                if (response.status === 200) {
                    let data = response.advertisers;
                    let html = '';

                    for (let i = 0; i < data.length; i++) {
                        html += `<li style="
    box-shadow: 3px 3px 20px 6px rgba(0, 0, 0, 0.08);
    height: 39px;
    padding: 10px;color: black;width: 250px;"><a style="color:#ff3838" href="/partner/brand-analytics?bid=${data[i].ad_id}&na=${data[i].name}">${data[i].name}</a></li>`;
                    }

                    $('#ad_list').html(html);
                    $('.cards').css('display','block')
                }

            }
        });
    }

    $('#box').on('change', function () {
        setTimeout(function () {
            call_api();
        }, 2000)
    })
</script>
@endpushonce

@section("content")
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">


                <div style="text-align:center;">
                    <h2 class="az-dashboard-title">Brand Insights</h2>
                    <p>Search and analyze brand performance with detailed insights into clicks, transactions, and
                        commissions.</p>
                </div>



                <div class="row" style="justify-content:center;margin-top: 20px;">

                    <div class="col-lg-6 col-md-4 col-sm-12">
                        <input type="text" id="box" placeholder="Search anything..." class="search__box showing">
                        <i class="fas fa-search search__icon" id="icon"></i>
                        <div class="cards">
                            <ul id="ad_list">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    
                    @if(isset($transactions))
                        <div class="col-md-12 performance-stats-container">
                    <div class="nav nav-tabs performance-tabs border-0 mb-4 mt-2" id="performanceTab" role="tablist">

                        <div class="row">
                            <div class="col-md-2">
                                {{-- Total Revenue --}}
                                <div class="nav-item">
                                    <button class="nav-link performance-tab-item" id="commission-revenue-tab"
                                        data-bs-toggle="tab" data-bs-target="#commission" type="button" role="tab"
                                        aria-controls="commission-revenue" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="performance-icon bg-success bg-opacity-10 text-success rounded-2 p-1 me-2">
                                                <i class="fa-solid text-white fa-chart-line"></i>
                                            </div>
                                            <div class="text-start">
                                                <div class="performance-label text-muted x-small">Total Revenue</div>
                                                <div class="performance-value fw-bold fs-6">
                                                   $ {{ number_format($total_revenue,2) ?? 0}}
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-2">
                                {{-- Approved Commissions --}}
                                <div class="nav-item">
                                    <button class="nav-link performance-tab-item" id="approved-commission-tab"
                                        data-bs-toggle="tab" data-bs-target="#approvedcommission" type="button"
                                        role="tab" aria-controls="approved-commission" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="performance-icon bg-info bg-opacity-10 text-info rounded-2 p-1 me-2">
                                                <i class="fa-solid text-white fa-check-circle"></i>
                                            </div>
                                            <div class="text-start">
                                                <div class="performance-label text-muted x-small">Approved Revenue
                                                </div>
                                                <div class="performance-value fw-bold fs-6">
                                                   $ {{ number_format($total_approved,2) ?? 0 }}
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-2">
                                {{-- Pending Commissions --}}
                                <div class="nav-item">
                                    <button class="nav-link performance-tab-item" id="pending-commission-tab"
                                        data-bs-toggle="tab" data-bs-target="#pendingcommission" type="button"
                                        role="tab" aria-controls="pending-commission" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="performance-icon bg-warning bg-opacity-10 text-warning rounded-2 p-1 me-2">
                                                <i class="fa-solid text-white fa-clock"></i>
                                            </div>
                                            <div class="text-start">
                                                <div class="performance-label text-muted x-small">Awaiting Revenue
                                                </div>
                                                <div class="performance-value fw-bold fs-6">
                                                   $ {{ number_format($total_pending,2) ?? 0 }}
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-2">
                                {{-- Declined Commissions --}}
                                <div class="nav-item">
                                    <button class="nav-link performance-tab-item" id="declined-commission-tab"
                                        data-bs-toggle="tab" data-bs-target="#declinedcommission" type="button"
                                        role="tab" aria-controls="declined-commission" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="performance-icon bg-danger bg-opacity-10 text-danger rounded-2 p-1 me-2">
                                                <i class="fa-solid text-white fa-times-circle"></i>
                                            </div>
                                            <div class="text-start">
                                                <div class="performance-label text-muted x-small">Rejected Revenue
                                                </div>
                                                <div class="performance-value fw-bold fs-6">
                                                   $ {{ number_format($total_declined,2) ?? 0 }}
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-2">
                                {{-- Total Transactions --}}
                                <div class="nav-item">
                                    <button class="nav-link performance-tab-item" id="transaction-tab"
                                        data-bs-toggle="tab" data-bs-target="#transaction" type="button"
                                        role="tab" aria-controls="transaction" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="performance-icon bg-purple bg-opacity-10 text-purple rounded-2 p-1 me-2">
                                                <i class="fa-solid text-white fa-exchange-alt"></i>
                                            </div>
                                            <div class="text-start">
                                                <div class="performance-label text-muted x-small">Total Conversions
                                                </div>
                                                <div class="performance-value fw-bold fs-6">
                                                    {{ $total_transactions ?? 0 }}
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-2">
                                {{-- Total Sales --}}
                                <div class="nav-item">
                                    <button class="nav-link performance-tab-item" id="sale-tab" data-bs-toggle="tab"
                                        data-bs-target="#sale" type="button" role="tab" aria-controls="sale"
                                        aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="performance-icon bg-orange bg-opacity-10 text-orange rounded-2 p-1 me-2">
                                                <i class="fa-solid text-white fa-shopping-cart"></i>
                                            </div>
                                            <div class="text-start">
                                                <div class="performance-label text-muted x-small">Total Sales</div>
                                                <div class="performance-value fw-bold fs-6">
                                                   $ {{ number_format($total_sales,2) ?? 0 }}
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                 <div class="col-lg-12 col-md-4 col-sm-12">
                        <h3 style="text-align: center;">Clicks Details</h3>
                        <div id="ap-overview">
                            @include("template.publisher.reports.performance.click.list_view", compact('performanceOverviewList2'))
                        </div>

                    </div>

                         <div class="col-lg-12 col-md-4 col-sm-12">
                            <h3 style="text-align: center;">Coversions Details</h3>
                        <div id="ap-overview">
                            @include("template.publisher.reports.transaction.list_view_insight", compact('transactions'))
                        </div>

                    </div>

                   
                    @endif
                   
                </div>

            </div>
        </div>
    </div>
@endsection