@extends("layouts.publisher.publisher_panel")

@push('title', 'All Conversions')

@pushonce('styles')
    <link rel="stylesheet" href="{{ \App\Helper\Static\Methods::staticAsset("vendor_assets/css/daterangepicker.css") }}">

    <style>
        table th, td {
            text-align: center;
        }
        .loaded-spin {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    @endpushonce

@pushonce('scripts')

    @php
        $date = \Carbon\Carbon::now()->format("Y-m-01 00:00:00");
        $diff = now()->diffInDays(\Carbon\Carbon::parse($date));

        $startDate = request()->start_date ?? null;
        $endDate = request()->end_date ?? null;

        if($startDate)
            $startDate = \Carbon\Carbon::parse($startDate)->format("M d, Y");

        if($endDate)
            $endDate = \Carbon\Carbon::parse($endDate)->format("M d, Y");

        $routeData = [
            'start_date' => request()->start_date ?? now()->format("Y-m-01 00:00:00"),
            'end_date' => request()->end_date ?? now()->format("Y-m-t 23:59:59")
        ];

        if(request()->payment_id)
        {
            $routeData['payment_id'] = request()->payment_id;
        }

        $xslx = route("publisher.reports.transactions.export", array_merge($routeData, ['type' => 'xlsx']));
        $csv = route("publisher.reports.transactions.export", array_merge($routeData, ['type' => 'csv']));
    @endphp

    <script src="{{ \App\Helper\Static\Methods::staticAsset("vendor_assets/js/moment/moment.min.js") }}"></script>
    <script src="{{ \App\Helper\Static\Methods::staticAsset("vendor_assets/js/daterangepicker.js") }}"></script>
    <script src="{{ \App\Helper\Static\Methods::staticAsset("vendor_assets/js/moment.js") }}"></script>
    <script>
        function sendAjaxRequest(dataObj) {
            $.ajax({
                url: '{{ route("publisher.reports.transactions.list") }}',
                type: 'GET',
                data: dataObj,
                success: function (response) {
                    $("#totalResults").html(response.total);
                    $("#ap-overview").html(response.html);
                    $("#gridLoader").addClass("d-none");
                    changeLimit()
                }
            });
        }

        function clearFilter(key) {
            let url = new URL(document.URL);
            let urlParams = url.searchParams;
            if (key == "clearSearchByName") {
                $("#SearchByName").val("");
                if (urlParams.has(`search_by_name`)) {
                    urlParams.delete(`search_by_name`);
                    filterTransactions("search_by_name", "SearchByName");
                }
            }
            history.pushState({}, null, url.href);
            $(`#${key}`).hide();
        }

        function showClear(key) {
            if ($(`#clear${key}`).length)
                $(`#clear${key}`).show();
        }

        function filterTransactions(field, id) {
            showClear(id);
            let data = $(`#${id}`).val();
            let dataObj = {[`${field}`]: data.toString()};

            $("#ap-overview").html("");
            $("#gridLoader").removeClass("d-none");

            let url = new URL(document.URL);
            let urlParams = url.searchParams;

            if (url.search) {
                if (urlParams.has(`${field}`)) {
                    urlParams.delete(`${field}`);
                }
                if (urlParams.has('page')) {
                    urlParams.delete('page');
                    urlParams.append('page', "1");
                }
            }
            urlParams.append(field, data);
            history.pushState({}, null, url.href);

            url = new URL(document.URL);
            urlParams = url.searchParams;

            dataObj.start_date = urlParams.get(`start_date`);
            dataObj.end_date = urlParams.get(`end_date`);
            dataObj.search_by_name = urlParams.get(`search_by_name`);
            dataObj.region = urlParams.get(`region`);
            dataObj.section = urlParams.get(`section`);
            if (urlParams.has('payment_id')) {
                dataObj.payment_id = urlParams.get(`payment_id`);
            }
            sendAjaxRequest(dataObj);
        }

        function changeLimit()
        {

            $("#limit").change(() => {
                $("#ap-tabContent").addClass("spin-active");
                $("#gridLoader").removeClass("d-none");
                $.ajax({
                    url: '{{ route("publisher.set-limit") }}',
                    type: 'GET',
                    data: {"limit": $("#limit").val(), "type": "transaction"},
                    success: function (response) {
                        if (response) {
                            window.location.reload();
                        }
                    },
                    error: function (response) {

                    }
                });
            });

        }

        document.addEventListener("DOMContentLoaded", function () {
                $("#gridLoader").addClass("d-none");

            @if(!request()->payment_id)

                let startDate = "{{ $startDate }}";
                let endDate = "{{ $endDate }}";

                let start;
                let end;

                if (startDate && endDate) {
                    start = moment(startDate);
                    end = moment(endDate);
                } else {
                    start = moment().startOf("month");
                    end = moment().endOf("month");
                }

                $('input[name="date-ranger"]').daterangepicker({
                     maxSpan: {
                        days: 365
                    },
                    startDate: start,
                    endDate: end,
                    singleDatePicker: false,
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear'
                    },
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'Current Month': [moment().startOf('month'), moment().endOf('month')],
                        'Previous Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'Current Year': [moment().startOf('year'), moment().endOf('year')],
                        'Previous Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                    },
                });

                {{--let setDate = "{{ $setDate }}";--}}
                {{--if(setDate) {--}}
                {{--    $('input[name="date-ranger"]').val(setDate);--}}
                {{--}--}}
                {{--else {--}}
                {{--}--}}
                $('input[name="date-ranger"]').val(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
                $('input[name="date-ranger"]').on('apply.daterangepicker', function (ev, picker) {

                    let exportXLSXURL = "{{ route("publisher.reports.transactions.export", ['type' => 'xlsx']) }}";
                    let exportCSVURL = "{{ route("publisher.reports.transactions.export", ['type' => 'csv']) }}";

                    $(this).val(picker.startDate.format('MMM D, YYYY') + ' - ' + picker.endDate.format('MMM D, YYYY'));

                    exportXLSXURL = `${exportXLSXURL}?start_date=${picker.startDate.format('YYYY-MM-DD')}&end_date=${picker.endDate.format('YYYY-MM-DD')}`;
                    exportCSVURL = `${exportCSVURL}?start_date=${picker.startDate.format('YYYY-MM-DD')}&end_date=${picker.endDate.format('YYYY-MM-DD')}`;

                    $("#exportCSV").attr("href", exportCSVURL);
                    $("#exportXLSX").attr("href", exportXLSXURL);

                    let url = new URL(document.URL);
                    let urlParams = url.searchParams;

                    if (url.search) {
                        if (urlParams.has('page')) {
                            urlParams.delete('page');
                            urlParams.append('page', "1");
                        }
                    }

                    if (urlParams.has(`start_date`)) {
                        urlParams.delete(`start_date`);
                    }

                    if (urlParams.has(`end_date`)) {
                        urlParams.delete(`end_date`);
                    }

                    urlParams.append("start_date", picker.startDate.format('YYYY-MM-DD'));
                    urlParams.append("end_date", picker.endDate.format('YYYY-MM-DD'));
                    history.pushState({}, null, url.href);

                    let dataObj = {};
                    dataObj.start_date = urlParams.get(`start_date`);
                    dataObj.end_date = urlParams.get(`end_date`);
                    dataObj.search_by_name = urlParams.get(`search_by_name`);
                    dataObj.section = urlParams.get(`section`);
                    sendAjaxRequest(dataObj);

                });

                $('input[name="date-ranger"]').on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                });

            @endif

            changeLimit();

            $("#SearchByName").keyup(() => {
                filterTransactions("search_by_name", "SearchByName");
                if (!$("#SearchByName").val()) {
                    $(`#clearSearchByName`).hide();
                }
            });

            $("#region").change(() => {
                filterTransactions("region", "region");
            });

            $("#publisherPagination a").click(() => {
                $("#ap-tabContent").addClass("spin-active");
                $("#gridLoader").removeClass("d-none");
            });

            $("#allTransactions, #pendingTransactions, #holdTransactions, #approvedTransactions, #declinedTransactions, #paidTransactions").click((e) => {

                let data = $(e.target);
                let section = data.attr('data-section');
                $("#allTransactions, #pendingTransactions, #holdTransactions, #approvedTransactions, #declinedTransactions, #paidTransactions").removeClass("active");
                if (section === "all") {
                    $("#allTransactions").addClass("active");
                    section = null;
                } else if (section === "pending") {
                    $("#pendingTransactions").addClass("active");
                } else if (section === "hold") {
                    $("#holdTransactions").addClass("active");
                } else if (section === "approved") {
                    $("#approvedTransactions").addClass("active");
                } else if (section === "declined") {
                    $("#declinedTransactions").addClass("active");
                } else if (section === "paid") {
                    $("#paidTransactions").addClass("active");
                }

                let dataObj = {section};

                $("#ap-overview").html("");
                $("#gridLoader").removeClass("d-none");

                let url = new URL(document.URL);
                let urlParams = url.searchParams;

                if (url.search) {
                    if (urlParams.has(`section`)) {
                        urlParams.delete(`section`);
                    }
                    if (urlParams.has('page')) {
                        urlParams.delete('page');
                        urlParams.append('page', "1");
                    }
                }
                if (section)
                    urlParams.append("section", section);
                history.pushState({}, null, url.href);

                url = new URL(document.URL);
                urlParams = url.searchParams;

                dataObj.start_date = urlParams.get(`start_date`);
                dataObj.end_date = urlParams.get(`end_date`);
                dataObj.search_by_name = urlParams.get(`search_by_name`);
                sendAjaxRequest(dataObj);
            });

        });
    </script>
@endpushonce

@section("content")
    <div class="row justify-content-between">
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="filter-card filter-sticky">
                <!-- Header -->
                <div class="fc-head">
                    <h5>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M7 12h10M10 18h4" />
                        </svg>
                        Filters
                    </h5>
                </div>

                <!-- Body -->
                <div class="fc-body">
                    <!-- Search Filter -->
                    <div class="filter-group">
                        <div class="fg-head">
                            <span class="t">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="7" />
                                    <path d="m21 21-4.3-4.3" />
                                </svg>
                                Search
                            </span>
                            <a href="javascript:void(0)" id="clearSearchByName"
                                onclick="clearFilter('clearSearchByName')"
                                class="fg-clear {{ request()->search_by_name ? '' : 'd-none' }}">
                                <i class="fas fa-times me-1"></i> Clear
                            </a>
                        </div>

                        <div class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                            <input type="text" class="form-control w-100"
                                value="{{ request()->search_by_name }}" id="SearchByName"
                                placeholder="Search by brand name…">
                        </div>
                    </div>

                    @if(!request()->payment_id)
                        <div class="filter-group">
                            <div>
                                <div class="fg-head">
                                    <span class="t">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" />
                                            <path d="M16 2v4M8 2v4M3 10h18" />
                                        </svg>
                                        Date
                                    </span>
                                </div>
                                <div class="input-group">
                                        <input type="text" class="form-control form-control-default date-ranger" name="date-ranger" placeholder="Jan 01, {{ now()->format("Y") }} - {{ now()->format("M d, Y") }}"/>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!request()->payment_id)
                        <div class="filter-group">
                            <div class="fg-head">
                                <span class="t">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="9" />
                                        <path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18" />
                                    </svg>
                                    Region
                                </span>
                            </div>

                            <div class="form-check ps-0">
                                <select class="js-example-basic-single js-states form-select" id="region">
                                    <option value="all" {{ request()->region == 'all' || empty(request()->region) ? 'selected' : '' }}>
                                        All Regions
                                    </option>

                                    @foreach($countries ?? [] as $country)
                                        @if($country->advertiser_country)
                                            <option value="{{ $country->advertiser_country }}"
                                                {{ request()->region == $country->advertiser_country ? 'selected' : '' }}>
                                                {{ $country->advertiser_country }}
                                            </option>
                                        @endif
                                    @endforeach

                                    <option value="unknown" {{ request()->region == 'unknown' ? 'selected' : '' }}>
                                        Unknown
                                    </option>
                                </select>
                            </div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-4 col-sm-12">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                <ul class="nav tab-pills flex-wrap gap-2" id="transactionStatus">
                    <li class="nav-item">
                        <a class="nav-link {{ !request()->section || request()->section == 'all' ? 'active' : '' }}" data-section="all" href="javascript:void(0)" id="allTransactions">
                            All
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->section == 'pending' ? 'active' : '' }}" data-section="pending" href="javascript:void(0)" id="pendingTransactions">
                            Pending
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->section == 'hold' ? 'active' : '' }}" data-section="hold" href="javascript:void(0)" id="holdTransactions">
                            Hold
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->section == 'approved' ? 'active' : '' }}" data-section="approved" href="javascript:void(0)" id="approvedTransactions">
                            Approved
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->section == 'declined' ? 'active' : '' }}" data-section="declined" href="javascript:void(0)" id="declinedTransactions">
                            Declined
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->section == 'paid' ? 'active' : '' }}" data-section="paid" href="javascript:void(0)" id="paidTransactions">
                            Paid
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="count-chip">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.6 12 12 20.6 3.4 12 12 3.4z" />
                        </svg>
                        Total Conversions <span class="n" id="totalResults">{{ $total }}</span>
                    </span>

                    <div class="dropdown">
                        <button class="btn btn-outline export-btn" data-bs-toggle="dropdown">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 3v12M7 10l5 5 5-5" />
                                <path d="M5 21h14" />
                            </svg>
                            Export
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end export-menu">
                            @php
                                $queryParams = request()->all();
                            @endphp
                            <li>
                                <a class="dropdown-item"
                                    href="{{ $csv }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <path d="M14 2v6h6" />
                                    </svg>
                                    <span><strong>Export as CSV</strong><span class="hint">Plain text, opens
                                            anywhere</span></span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ $xslx }}">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <path d="M14 2v6h6" />
                                        <path d="M8 14h8M8 18h5" />
                                    </svg>
                                    <span><strong>Export as Excel</strong><span class="hint">.xlsx with
                                            formatting</span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            @include("partial.admin.alert")
            @include("template.publisher.widgets.loader")
            <div id="ap-overview">
                @include("template.publisher.reports.transaction.list_view", compact('transactions'))
            </div>

        </div><!-- End: .userDatatable -->
    </div>

@endsection
