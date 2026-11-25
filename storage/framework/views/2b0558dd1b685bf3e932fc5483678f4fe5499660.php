<?php $__env->startPush('title'); ?>
    Analytics Report
<?php $__env->stopPush(); ?>

<?php if (! $__env->hasRenderedOnce('089c0a2a-6053-4908-aa4f-b177454e7694')): $__env->markAsRenderedOnce('089c0a2a-6053-4908-aa4f-b177454e7694');
$__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/css/daterangepicker.css")); ?>">
<style>
    .loaded-spin {
        margin: 40%;
        position: absolute;
    }

    .performance-tab-item {
        width: 100%;
        margin-bottom: 10px !important;
    }

    .legend-static {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .legend-static .custom-label {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-right: 18px;
        font-size: 13px;
        color: var(--vz-secondary-color);
    }

    .legend-static .dot {
        display: inline-block;
        width: 9px;
        height: 9px;
        min-width: 9px;
        border-radius: 50%;
    }
</style>
<?php $__env->stopPush(); endif; ?>

<?php if (! $__env->hasRenderedOnce('a97d00f4-5e37-4b69-8970-744185f85d61')): $__env->markAsRenderedOnce('a97d00f4-5e37-4b69-8970-744185f85d61');
$__env->startPush('scripts'); ?>
<script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/moment/moment.min.js")); ?>"></script>
<script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/daterangepicker.js")); ?>"></script>
<script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/moment.js")); ?>"></script>

<?php
    $date = \Carbon\Carbon::now()->format("Y-m-01 00:00:00");
    $diff = now()->diffInDays(\Carbon\Carbon::parse($date));

    $startDate = request()->start_date ?? null;
    $endDate = request()->end_date ?? null;

    if ($startDate)
        $startDate = \Carbon\Carbon::parse($startDate)->format("M d, Y");

    if ($endDate)
        $endDate = \Carbon\Carbon::parse($endDate)->format("M d, Y");

?>

<script>
    function showLoader() {
        $("#listingContentWrapper").addClass("zero-point-one-opacity");
        $("#performanceTabWrapper").addClass("zero-point-one-opacity");
        $("#ap-overview").append(`
                <div class="spin-container text-center" id="performanceLoader">
                    <div class="atbd-spin-dots spin-sm top-minus-25px">
                        <span class="spin-dot badge-dot dot-primary"></span>
                        <span class="spin-dot badge-dot dot-primary"></span>
                        <span class="spin-dot badge-dot dot-primary"></span>
                        <span class="spin-dot badge-dot dot-primary"></span>
                    </div>
                </div>
            `);
        $("#performanceCardContent").append(`
                <div class="spin-container text-center" id="performanceLoader2">
                    <div class="atbd-spin-dots spin-sm top-minus-25px">
                        <span class="spin-dot badge-dot dot-primary"></span>
                        <span class="spin-dot badge-dot dot-primary"></span>
                        <span class="spin-dot badge-dot dot-primary"></span>
                        <span class="spin-dot badge-dot dot-primary"></span>
                    </div>
                </div>
            `);
    }

    function hideLoader() {
        $("#listingContentWrapper").removeClass("zero-point-one-opacity");
        $("#performanceTabWrapper").removeClass("zero-point-one-opacity");
        $("#performanceLoader").remove();
        $("#performanceLoader2").remove();
    }

    function sendAjaxRequest(dataObj) {
        $.ajax({
            url: '<?php echo e(route("publisher.reports.performance-by-transactions.list")); ?>',
            type: 'GET',
            data: dataObj,
            before: function () {
                showLoader();
            },
            success: function (response) {
                $("#totalResults").html(`Total Results: <strong>${response.total}</strong>`);
                // $("#totalResults2").html(`Total Results: <strong>${response.total2}</strong>`);
                $("#performanceOverview").html(response.html);
                $("#ap-overview").html(response.html_2);

                if (dataObj.start_date && dataObj.end_date) {
                    createCommissionGraph(response?.performanceOverview);
                    createapprovedCommissionGraph(response?.performanceOverview);
                    creatependingCommissionGraph(response?.performanceOverview);
                    createdeclinedCommissionGraph(response?.performanceOverview);
                    createTransactionGraph(response?.performanceOverview);
                    createSaleGraph(response?.performanceOverview);
                    changeLimit();
                }
            }
        }).done(function () {
            hideLoader();
        });
    }

    function createCommissionGraph(response) {
        let commission = response?.commission;
        let labels = response?.extra?.labels;
        $("#commission-tab").html(`
                <span class="perf-tab-icon teal">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 17l6-6 4 4 8-8" />
                        <path d="M17 7h4v4" />
                    </svg>
                </span>
                <span class="perf-tab-copy">
                    <span class="l">Total Revenue</span>
                    <span class="v">
                        ${commission.count}
                    </span>
                </span>
            `);
        $("#commissionChart").remove();
        $("#commissionChartContent").html(`<canvas id="commissionChart"></canvas>`);
        chartjsLineChartFive(
            "commissionChart",
            "#0F6E5F",
            "45",
            (data = commission?.commission),
            labels = labels,
            commission?.max_value,
            commission?.min_value
        );
        $("#commissionPeriodContent").html(`
                <li>
                    <span class="dot" style="background-color: var(--teal);"></span>Current Period
                </li>
            `)
    }


    function createapprovedCommissionGraph(response) {
        let commission = response?.approved;
        let labels = response?.extra?.labels;
        $("#approved-commission-tab").html(`
                <span class="perf-tab-icon teal-solid">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M8 12l3 3 5-6" />
                    </svg>
                </span>
                <span class="perf-tab-copy">
                    <span class="l">Approved Revenue</span>
                    <span class="v">
                        ${commission.count}
                    </span>
                </span>
            `);
        $("#approvedcommissionChart").remove();


        $("#approvedcommissionChartContent").html(`<canvas id="approvedcommissionChart"></canvas>`);
        chartjsLineChartFive(
            "approvedcommissionChart",
            "#0F6E5F",
            "45",
            (data = commission?.commission),
            labels = labels,
            commission?.max_value,
            commission?.min_value
        );
        $("#approvedcommissionPeriodContent").html(`
                <li>
                    <span class="dot" style="background-color: var(--teal);"></span>Current Period
                </li>
            `)
    }


    function createdeclinedCommissionGraph(response) {
        let commission = response?.declined;
        let labels = response?.extra?.labels;
        $("#declined-commission-tab").html(`
                <span class="perf-tab-icon coral">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9" />
                        <path d="m9.5 9.5 5 5m0-5-5 5" />
                    </svg>
                </span>
                <span class="perf-tab-copy">
                    <span class="l">Rejected Revenue</span>
                    <span class="v">
                        ${commission.count}
                    </span>
                </span>
            `);
        $("#declinedcommissionChart").remove();
        $("#declinedcommissionChartContent").html(`<canvas id="declinedcommissionChart"></canvas>`);
        chartjsLineChartFive(
            "declinedcommissionChart",
            "#0F6E5F",
            "45",
            (data = commission?.commission),
            labels = labels,
            commission?.max_value,
            commission?.min_value
        );
        $("#declinedcommissionPeriodContent").html(`
                    <li>
                        <span class="dot" style="background-color: var(--teal);"></span>Current Period
                    </li>
                `)
    }


    function creatependingCommissionGraph(response) {
        let commission = response?.pending;
        let labels = response?.extra?.labels;
        $("#pending-commission-tab").html(`
                <span class="perf-tab-icon amber">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 7v5l3 3" />
                    </svg>
                </span>
                <span class="perf-tab-copy">
                    <span class="l">Awaiting Revenue</span>
                    <span class="v">
                        ${commission.count}
                    </span>
                </span>
            `);
        $("#pendingcommissionChart").remove();
        $("#pendingcommissionChartContent").html(`<canvas id="pendingcommissionChart"></canvas>`);
        chartjsLineChartFive(
            "pendingcommissionChart",
            "#0F6E5F",
            "45",
            (data = commission?.commission),
            labels = labels,
            commission?.max_value,
            commission?.min_value
        );
        $("#pendingcommissionPeriodContent").html(`
                    <li>
                        <span class="dot" style="background-color: var(--teal);"></span>Current Period
                    </li>
                `)
    }



    function createTransactionGraph(response) {
        let transaction = response?.transaction;
        let labels = response?.extra?.labels;
        $("#transaction-tab").html(`
                <span class="perf-tab-icon ink">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16l-6 8v6l-4 2v-8z" />
                    </svg>
                </span>
                <span class="perf-tab-copy">
                    <span class="l">Total Conversions</span>
                    <span class="v">
                        ${transaction.count}
                    </span>
                </span>
            `);
        $("#transactionChart").remove();
        $("#transactionChartContent").html(`<canvas id="transactionChart"></canvas>`);
        chartjsLineChartFive(
            "transactionChart",
            "#0F6E5F",
            "45",
            (data = transaction?.transaction),
            labels = labels,
            transaction?.max_value,
            transaction?.min_value
        );
        $("#transactionPeriodContent").html(`
                    <li>
                        <span class="dot" style="background-color: var(--teal);"></span>Current Period
                    </li>
                `);
    }

    function createSaleGraph(response) {
        let sale = response?.sale;
        let labels = response?.extra?.labels;
        $("#sale-tab").html(`
                <span class="perf-tab-icon amber-solid">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="20" cy="21" r="1" />
                        <path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6" />
                    </svg>
                </span>
                <span class="perf-tab-copy">
                    <span class="l">Total Sales</span>
                    <span class="v">
                        ${sale.count}
                    </span>
                </span>
            `);
        $("#saleChart").remove();
        $("#saleChartContent").html(`<canvas id="saleChart"></canvas>`);
        chartjsLineChartFive(
            "saleChart",
            "#0F6E5F",
            "45",
            (data = sale?.sale),
            labels = labels,
            sale?.max_value,
            sale?.min_value
        );
        $("#salePeriodContent").html(`
                    <li>
                        <span class="dot" style="background-color: var(--teal);"></span>Current Period
                    </li>
                `);
    }

    function createClickGraph(response) {
        let click = response?.click;
        let labels = response?.extra?.labels;
        $("#click-tab").html(`
                <div class="performance-stats__down">
                    <span>Total Clicks</span>
                    <strong>
                        ${click.count}
                    </strong>
                </div>
            `);
        $("#clickChart").remove();
        $("#clickChartContent").html(`<canvas id="clickChart"></canvas>`);
        chartjsLineChartFive(
            "clickChart",
            "#0F6E5F",
            "155",
            (data = click?.click),
            labels,
            click?.max_value,
            click?.min_value
        );
        $("#clickPeriodContent").html(`
                    <li>
                        <span class="dot" style="background-color: var(--teal);"></span>Current Period
                    </li>
                `);
    }

    function filterTransactions(field, id) {
        showClear(id);
        if (field == "earning_search") {
            $("#ap-tabContent").addClass("spin-active");
            $("#gridLoader").removeClass("display-hidden");
        }
        else if (field == "conversion_search") {
            $("#ap-tabContent-2").addClass("spin-active");
            $("#gridLoader2").removeClass("display-hidden");
        }
        let data = $(`#${id}`).val();
        let dataObj = { [`${field}`]: data.toString() };
        searchFunc(field, data, dataObj);
    }

    function clearFilter(key) {
        let url = new URL(document.URL);
        let urlParams = url.searchParams;
        if (key === "clearSearchByName") {
            $("#SearchByName").val("");
            if (urlParams.has(`earning_search`)) {
                urlParams.delete(`earning_search`);
                filterTransactions("earning_search", "SearchByName");
            }
            if (urlParams.has(`start_date`)) {
                urlParams.delete(`start_date`);
            }
            if (urlParams.has(`end_date`)) {
                urlParams.delete(`end_date`);
            }
            if (urlParams.has(`earning_sort`)) {
                urlParams.delete(`earning_sort`);
            }
            if (urlParams.has(`conversion_sort`)) {
                urlParams.delete(`conversion_sort`);
            }
        }
        if (key === "clearSearchByName2") {
            $("#SearchByName2").val("");
            if (urlParams.has(`conversion_search`)) {
                urlParams.delete(`conversion_search`);
                filterTransactions("conversion_search", "SearchByName2");
            }
            if (urlParams.has(`start_date`)) {
                urlParams.delete(`start_date`);
            }
            if (urlParams.has(`end_date`)) {
                urlParams.delete(`end_date`);
            }
            if (urlParams.has(`earning_sort`)) {
                urlParams.delete(`earning_sort`);
            }
            if (urlParams.has(`conversion_sort`)) {
                urlParams.delete(`conversion_sort`);
            }
        }
        history.pushState({}, null, url.href);
        $(`#${key}`).hide();
    }

    function showClear(key) {
        if ($(`#clear${key}`).length)
            $(`#clear${key}`).show();
    }

    function searchFunc(field, data, dataObj) {
        let url = new URL(document.URL);
        let urlParams = url.searchParams;

        if (url.search) {
            if (urlParams.has(`${field}`)) {
                urlParams.delete(`${field}`);
            }
            if (field === "earning_search" && urlParams.has('earning_page')) {
                urlParams.delete('earning_page');
                urlParams.append('earning_page', "1");
            }
        }
        urlParams.append(field, data);
        history.pushState({}, null, url.href);

        url = new URL(document.URL);
        urlParams = url.searchParams;

        dataObj.start_date = urlParams.get(`start_date`);
        dataObj.end_date = urlParams.get(`end_date`);
        dataObj.earning_sort = urlParams.get(`earning_sort`);
        dataObj.region = urlParams.get(`region`);
        dataObj.conversion_sort = urlParams.get(`conversion_sort`);
        dataObj.earning_search = urlParams.get(`earning_search`);
        dataObj.conversion_search = urlParams.get(`conversion_search`);
        sendAjaxRequest(dataObj);
    }

    function changeLimit() {
        $("#limit").change(() => {
            $("#ap-tabContent").addClass("spin-active");
            $("#gridLoader").removeClass("display-hidden");
            $.ajax({
                url: '<?php echo e(route("publisher.set-limit")); ?>',
                type: 'GET',
                data: { "limit": $("#limit").val(), "type": "earning_performance" },
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

        let startDate = "<?php echo e($startDate); ?>";
        let endDate = "<?php echo e($endDate); ?>";

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
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Current Year': [moment().startOf('year'), moment().endOf('year')],
                'Previous Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
            },
        });

        $('input[name="date-ranger"]').val(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $('input[name="date-ranger"]').on('apply.daterangepicker', function (ev, picker) {

            showLoader();

            let exportXLSXURL = "<?php echo e(route("publisher.reports.transactions.export", ['type' => 'xlsx'])); ?>";
            let exportCSVURL = "<?php echo e(route("publisher.reports.transactions.export", ['type' => 'csv'])); ?>";

            $(this).val(picker.startDate.format('MMM D, YYYY') + ' - ' + picker.endDate.format('MMM D, YYYY'));

            exportXLSXURL = `${exportXLSXURL}?start_date=${picker.startDate.format('YYYY-MM-DD')}&end_date=${picker.endDate.format('YYYY-MM-DD')}`;
            exportCSVURL = `${exportCSVURL}?start_date=${picker.startDate.format('YYYY-MM-DD')}&end_date=${picker.endDate.format('YYYY-MM-DD')}`;

            $("#exportCSV").attr("href", exportCSVURL);
            $("#exportXLSX").attr("href", exportXLSXURL);

            let url = new URL(document.URL);
            let urlParams = url.searchParams;

            if (url.search) {
                if (urlParams.has('earning_page')) {
                    urlParams.delete('earning_page');
                    urlParams.append('earning_page', "1");
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
            dataObj.earning_sort = urlParams.get(`earning_sort`);
            dataObj.conversion_sort = urlParams.get(`conversion_sort`);
            dataObj.earning_search = urlParams.get(`earning_search`);
            dataObj.conversion_search = urlParams.get(`conversion_search`);
            sendAjaxRequest(dataObj);

        });

        $('input[name="date-ranger"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });

        $(document).on('click', '#publisherPagination a', function (event) {
            event.preventDefault();
            $("#ap-tabContent").addClass("spin-active");
            $("#gridLoader").removeClass("display-hidden");
            let page = $(this).attr('href').split('earning_page=')[1];
            let dataObj = { "earning_page": page };
            searchFunc("earning_page", page, dataObj);
        });

        changeLimit();

        $("#sortBy").change(function () {
            $("#ap-tabContent").addClass("spin-active");
            $("#gridLoader").removeClass("display-hidden");
            let data = $(this).val();
            let dataObj = { "earning_sort": data };
            searchFunc("earning_sort", data, dataObj);
        });

        $("#region").change(function () {
            $("#ap-tabContent-2").addClass("spin-active");
            $("#gridLoader2").removeClass("display-hidden");
            let data = $(this).val();
            let dataObj = { "region": data };
            searchFunc("region", data, dataObj);
        });

        $("#SearchByName").keyup(() => {
            filterTransactions("earning_search", "SearchByName");
            if (!$("#SearchByName").val()) {
                $(`#clearSearchByName`).hide();
            }
        });

        $("#SearchByName2").keyup(() => {
            filterTransactions("conversion_search", "SearchByName2");
            if (!$("#SearchByName2").val()) {
                $(`#clearSearchByName2`).hide();
            }
        });

    });
</script>
<?php $__env->stopPush(); endif; ?>

<?php $__env->startSection("content"); ?>

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Reports & Analytics</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reports</a></li>
                            <li class="breadcrumb-item active">Revenue Overview</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        
    </div>

    <div class="card card-pad mb-3">

        <div class="card-header border-0">
            <h4 class="card-title mb-0 flex-grow-1">Performance Overview</h4>
            <div class="sub">Click a metric to see its trend</div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="performanceOverview">
                <?php echo $__env->make("template.publisher.widgets.section_performance_overview", compact('performanceOverview'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

    </div>
    <div class="row mt-3" id="listingContentWrapper">
        <div class="col-lg-3 col-12">
            <div class="filter-card filter-sticky">
                <!-- Header -->
                <div class="fc-head">
                    <h5>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
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
                            <a href="javascript:void(0)" id="clearSearchByName" onclick="clearFilter('clearSearchByName')"
                                class="fg-clear <?php echo e(request()->earning_search ? null : "d-none"); ?>">
                                <i class="fas fa-times me-1"></i> Clear
                            </a>
                        </div>
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                            <input type="text" class="form-control" id="SearchByName" placeholder="Search by name..."
                                value="<?php echo e(request()->earning_search); ?>">
                        </div>
                    </div>
                    <div class="filter-group">
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
                            <input type="text" class="form-control form-control-default date-ranger" name="date-ranger"
                                placeholder="<?php echo e(now()->format("M 01, Y")); ?> - <?php echo e(now()->format("M t, Y")); ?>" />
                        </div>
                    </div>

                    <!-- Advertiser Type Filter -->
                    <div class="filter-group">
                        <div class="fg-head">
                            <span class="t">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" />
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                                </svg>
                                Advertiser Type
                            </span>
                        </div>
                        <div class="form-check ps-0">
                            <select class="js-example-basic-single js-states form-control" id="sortBy">
                                <option <?php echo e(request()->earning_sort == "advertiser" || empty(request()->earning_sort) ? "selected" : ""); ?> value="advertiser">Advertiser</option>
                                <option <?php echo e(request()->earning_sort == "sale" ? "selected" : ""); ?> value="sale">Sale</option>
                                <option <?php echo e(request()->earning_sort == "commission" ? "selected" : ""); ?> value="commission">
                                    Commission</option>
                                <option <?php echo e(request()->earning_sort == "transactions" ? "selected" : ""); ?>

                                    value="transactions">Transactions</option>
                            </select>
                        </div>
                    </div>

                    <!-- Advertiser Type Filter -->
                    <div class="filter-group">
                        <div class="fg-head">
                            <span class="t">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18" />
                                </svg>
                                Advertiser Region
                            </span>
                        </div>
                        <div class="form-check ps-0">
                            <select class="js-example-basic-single js-states form-control" id="region">
                                <option <?php echo e(request()->region == "all" || empty(request()->region) ? "selected" : ""); ?>

                                    value="all">All Regions</option>
                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($country->advertiser_country): ?>
                                        <option <?php echo e(request()->region == $country->advertiser_country ? "selected" : ""); ?>

                                            value="<?php echo e($country->advertiser_country); ?>"><?php echo e($country->advertiser_country); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <option <?php echo e(request()->region == "unknown" ? "selected" : ""); ?> value="unknown">Unknown
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-12">

            <?php echo $__env->make("partial.admin.alert", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div id="ap-overview">
                <?php echo $__env->make("template.publisher.reports.performance.transaction.list_view", compact('performanceOverviewList'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.publisher.publisher_panel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/reports/performance/transaction/list.blade.php ENDPATH**/ ?>