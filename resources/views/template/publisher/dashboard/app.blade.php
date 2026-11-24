@php

    if (isset($earningOverview['pending'])) {
        $pendingCurrency = $earningOverview['pending']['commission_amount_currency'] ?? "";
        $pending = $earningOverview['pending']['total_commission_amount'] ?? 0;

    } else {
        $pendingCurrency = $earningOverview['Pending']['commission_amount_currency'] ?? "";
        $pending = $earningOverview['Pending']['total_commission_amount'] ?? 0;
    }


    $approvedCurrency = $earningOverview['approved']['commission_amount_currency'] ?? "";
    $paid = $earningOverview['paid_status'] ?? 0;
    $approved = $earningOverview['approved']['total_commission_amount'] ?? 0;
    $approved = $approved - $paid;
    $percentage = ($pending + $paid) - $approved;
    if ($percentage > 0 && $approved > 0) {
        $percentage = abs(round($percentage / $approved * 100));
    } else {
        $percentage = 0;
    }
    $pending = number_format($pending, 2);
    $approved = number_format($approved, 2);


    $pieData = [];

    foreach ($topSales as $topSale) {
        $pieData[] = [
            'label' => $topSale->advertiser_name,
            'data' => [[1, floatval($topSale->total_sales_amount)]]
        ];
    }

    $pieJson = json_encode($pieData);

    $labels = [];
    $values = [];
    foreach ($accountSummary as $row) {
        $labels[] = ucfirst($row['status']);
        $values[] = intval($row['total']);
    }
    $total = array_sum($values);

    $percentages = [];
    foreach ($values as $val) {
        $percent = $total > 0 ? round(($val / $total) * 100) : 0;
        $percentages[] = $percent;
    }

    $total_transactions = $performanceOverview['transaction']['count'] ?? 1;
    $total_Clicks = $totalClicks;
    if ($total_Clicks != 0) {
        $CVR = ($total_transactions / $total_Clicks) * 100;
        $CVR_display = number_format($CVR, 2); // 0.96
    } else {
        $CVR = 0;
        $CVR_display = number_format($CVR, 2); // 0.96
    }

    if (isset($earningOverview['pending']['growth']) && $earningOverview['pending']['growth'] == "up") {
        $pendingcolor = '#00cccc';
    } else {
        $pendingcolor = '#cc2500ff';
    }

    if (isset($earningOverview['approved']['growth']) && $earningOverview['approved']['growth'] == "up") {
        $approvedcolor = '#00cccc';
    } else {
        $approvedcolor = '#cc2500ff';
    }

    if (isset($earningOverview['declined']['growth']) && $earningOverview['declined']['growth'] == "up") {
        $declinedcolor = '#00cccc';
    } else {
        $declinedcolor = '#cc2500ff';
    }

    $transaction = $performanceOverview['transaction'] ?? [
        'dailyCurrentMonth' => [],
        'dailyPreviousMonth' => [],
        'max_value' => 0,
        'min_value' => 0,
    ];

    $sale = $performanceOverview['sale'] ?? [
        'dailyCurrentMonth' => [],
        'dailyPreviousMonth' => [],
        'max_value' => 0,
        'min_value' => 0,
    ];

    $commission = $performanceOverview['commission'] ?? [
        'dailyCurrentMonth' => [],
        'dailyPreviousMonth' => [],
        'max_value' => 0,
        'min_value' => 0,
    ];

@endphp

@pushonce('styles')
<style>
    .legend div {
        top: -28px !important;
    }

    .legend table {
        top: -28px !important;
    }

    .symbol.symbol-circle,
    .symbol.symbol-circle .symbol-label,
    .symbol.symbol-circle>img {
        border-radius: 50%;
    }

    .symbol {
        display: inline-block;
        flex-shrink: 0;
        position: relative;
        border-radius: .475rem;
    }

    .me-3 {
        margin-right: .75rem !important;
    }

    .overflow-hidden {
        overflow: hidden !important;
    }

    .symbol.symbol-50px .symbol-label {
        width: 60px;
        height: 60px;
    }

    .symbol .symbol-label {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        color: var(--bs-symbol-label-color);
        background-color: var(--bs-symbol-label-bg);
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        border-radius: .475rem;
    }

    .w-100 {
        width: 100% !important;
    }

    img,
    svg {
        vertical-align: middle;
    }
</style>
@endpushonce


@pushonce('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.pie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>

    let fp, start_date, end_date;

    $(document).ready(function () {

        let today = new Date();

        let firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
        let lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

        fp = flatpickr("#dateRange", {
            mode: "range",
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "d M, Y",
            defaultDate: [firstDay, lastDay]
        });

    });


    $(function () {
        'use strict'
        chart_graph('commission')
        //-------------------------------------------------------------//
        var pieData = {!! $pieJson !!};
        $.plot('#flotPie', pieData, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    tilt: 5,
                    label: {
                        show: true,
                        radius: 1,
                        formatter: function (label, slice) {
                            return '<div style="font-size:9px;text-align:center;padding:2px;color:white;">'
                                + label + '<br>$' + slice.data[0][1].toFixed(2) +
                                '</div>';
                        },
                        background: { opacity: 0.8 }
                    },
                    combine: {
                        color: '#999',
                        threshold: 0.1
                    }
                }
            },
            legend: {
                show: false
            }
        });

        var datapie = {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                data: {!! json_encode($values) !!},
                backgroundColor: ['#405189', '#0ab39c', '#f7b84b', '#f06548', '#212529']
            }]
        };

        var optionpie = {
            maintainAspectRatio: false,
            responsive: true,
            legend: { display: false },
            animation: { animateScale: true, animateRotate: true }
        };



        var ctxpie = document.getElementById('chartDonut');
        var myPieChart6 = new Chart(ctxpie, {
            type: 'doughnut',
            data: datapie,
            options: optionpie
        });


        // Line chart
        $('.peity-line').peity('line');

        // Bar charts
        $('.peity-bar').peity('bar');

        // Bar charts
        $('.peity-donut').peity('donut');

        var ctx5 = document.getElementById('chartBar5').getContext('2d');
        new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: [0, 1, 2, 3, 4, 5, 6, 7],
                datasets: [{
                    data: [2, 4, 10, 20, 45, 40, 35, 18],
                    backgroundColor: '#560bd0'
                }, {
                    data: [3, 6, 15, 35, 50, 45, 35, 25],
                    backgroundColor: '#cad0e8'
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    enabled: false
                },
                legend: {
                    display: false,
                    labels: {
                        display: false
                    }
                },
                scales: {
                    yAxes: [{
                        display: false,
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11,
                            max: 80
                        }
                    }],
                    xAxes: [{
                        barPercentage: 0.6,
                        gridLines: {
                            color: 'rgba(0,0,0,0.08)'
                        },
                        ticks: {
                            beginAtZero: true,
                            fontSize: 11,
                            display: false
                        }
                    }]
                }
            }
        });



    });

    $("#flotChart").bind("plothover", function (event, pos, item) {
        if (item) {

            var day = item.datapoint[0];
            let type = $('#chart_type').val();
            if (type == 'transaction') {
                var value = item.datapoint[1].toFixed(2);
            } else {
                var value = '$ ' + item.datapoint[1].toFixed(2);
            }


            $("#tooltip")
                .html("Day: " + day + "<br>Value: " + value)
                .css({
                    top: item.pageY + 10,
                    left: item.pageX + 10
                })
                .fadeIn(200);
        } else {
            $("#tooltip").hide();
        }
    });

    $('#filterbtn').on('click', function () {

        start_date = fp.selectedDates[0]
            ? fp.formatDate(fp.selectedDates[0], "Y-m-d")
            : null;

        end_date = fp.selectedDates[1]
            ? fp.formatDate(fp.selectedDates[1], "Y-m-d")
            : null;
        let url = new URL(document.URL);
        let urlParams = url.searchParams;

        if (urlParams.has(`start_date`)) {
            urlParams.delete(`start_date`);
        }

        if (urlParams.has(`end_date`)) {
            urlParams.delete(`end_date`);
        }

        urlParams.append("start_date", start_date);
        urlParams.append("end_date", end_date);
        history.pushState({}, null, url.href);

        location.reload();
    })

    let performanceChart = null;

    $('.chart-type-btn').on('click', function () {
        let type = $(this).data('type');

        $('.chart-type-btn')
            .removeClass('btn-soft-success active')
            .addClass('btn-soft-dark');

        $(this)
            .removeClass('btn-soft-dark')
            .addClass('btn-soft-success active');

        chart_graph(type);
    });

    function chart_graph(type) {

        let dailyCurrentMonth, dailyPreviousMonth;
        let max, min;

        if (type === 'transaction') {

            dailyCurrentMonth = @json($transaction['dailyCurrentMonth']);
            dailyPreviousMonth = @json($transaction['dailyPreviousMonth']);
            max = @json($transaction['max_value']);
            min = @json($transaction['min_value']);

        } else if (type === 'sale') {

            dailyCurrentMonth = @json($sale['dailyCurrentMonth']);
            dailyPreviousMonth = @json($sale['dailyPreviousMonth']);
            max = @json($sale['max_value']);
            min = @json($sale['min_value']);

        } else {

            dailyCurrentMonth = @json($commission['dailyCurrentMonth']);
            dailyPreviousMonth = @json($commission['dailyPreviousMonth']);
            max = @json($commission['max_value']);
            min = @json($commission['min_value']);
        }

        // Normalize data
        dailyCurrentMonth = normalizeData(dailyCurrentMonth);
        dailyPreviousMonth = normalizeData(dailyPreviousMonth);

        // Calculate days
        let days = Math.max(
            dailyCurrentMonth.length,
            dailyPreviousMonth.length
        );

        // X-axis categories
        let categories = Array.from(
            { length: days },
            (_, i) => i + 1
        );

        // ApexCharts series
        let series = [
            {
                name: 'Current Month',
                data: dailyCurrentMonth
            },
            {
                name: 'Previous Month',
                data: dailyPreviousMonth
            }
        ];

        let chartColors = getChartColorsArray('performance_chart');

        // Chart options
        let options = {

            series: series,

            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
                fontFamily: 'inherit'
            },

            colors: chartColors,

            dataLabels: {
                enabled: false
            },

            stroke: {
                curve: 'smooth',
                width: 2
            },

            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.20,
                    opacityTo: 0.02,
                    stops: [0, 90, 100]
                }
            },

            markers: {
                size: 3,
                hover: {
                    size: 5
                }
            },

            xaxis: {
                categories: categories,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                title: {
                    text: 'Days'
                }
            },

            yaxis: {
                min: min,
                max: max,
                forceNiceScale: true,
                labels: {
                    formatter: function (value) {
                        return Math.round(value).toLocaleString();
                    }
                }
            },

            grid: {
                borderColor: '#e7e7e7',
                strokeDashArray: 4,
                padding: {
                    left: 10,
                    right: 10
                }
            },

            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
                markers: {
                    width: 9,
                    height: 9,
                    radius: 6
                }
            },

            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (value) {
                        return value !== undefined
                            ? value.toLocaleString()
                            : value;
                    }
                }
            }
        };

        // Create or update chart
        if (performanceChart) {

            performanceChart.updateOptions({
                series: series,
                xaxis: {
                    categories: categories
                },
                yaxis: {
                    min: min,
                    max: max
                }
            });

        } else {

            performanceChart = new ApexCharts(
                document.querySelector('#performance_chart'),
                options
            );

            performanceChart.render();
        }
    }

    // Default chart
    chart_graph('commission');

    function normalizeData(arr) {
        return arr.map(v => {
            if (typeof v === 'string') {
                return parseFloat(v.replace(/,/g, '')) || 0;
            }
            return v || 0;
        });
    }
    let url = new URL(document.URL);
    let urlParams = url.searchParams;
    if (urlParams.has(`start_date`)) {
        start_date = urlParams.get(`start_date`);
    }

    if (urlParams.has(`end_date`)) {
        end_date = urlParams.get(`end_date`);
    }
</script>
<script>
    function printPage() {
        window.print();
    }
</script>
<script>
    async function exportPDF() {
        const { jsPDF } = window.jspdf;

        const element = document.body; // full page
        const canvas = await html2canvas(element, {
            scale: 2,
            useCORS: true,
            scrollY: -window.scrollY
        });

        const imgData = canvas.toDataURL("image/png");
        const pdf = new jsPDF("p", "mm", "a4");

        const imgWidth = 210;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        let heightLeft = imgHeight;
        let position = 0;

        pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
        heightLeft -= 297;

        while (heightLeft > 0) {
            position = heightLeft - imgHeight;
            pdf.addPage();
            pdf.addImage(imgData, "PNG", 0, position, imgWidth, imgHeight);
            heightLeft -= 297;
        }

        pdf.save("report.pdf");
    }
</script>

<script>
function viewBrandDetails(url) {

    $('#company-view-detail').html(`
        <div class="card-body text-center py-5">
            <div class="spinner-border text-primary"></div>
            <p class="text-muted mt-2">Loading brand details...</p>
        </div>
    `);

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',

        success: function (response) {

            if (response.success) {

                let brand = response.data;
                let countries = brand.country_full_name ?? [];
                let commissionSuffix = String(brand.commission ?? '').includes('%')
                    ? ''
                    : (brand.commission_type === 'percentage' ? '%' : (brand.commission_type ?? ''));

                if (typeof countries === 'string') {
                    try {
                        countries = JSON.parse(countries);
                    } catch (e) {
                        countries = [countries];
                    }
                }

                let location = Array.isArray(countries)
                    ? (countries.length > 2 ? 'Multi' : countries.join(', '))
                    : countries;

                let status = response.data.advertiser_applies?.status;

                let statusHtml = '';

                if (status === 'joined') {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-success-subtle text-success fs-11 rounded">
                                <i class="ri-check-line me-2 fs-14"></i> Joined
                            </a>
                        </li>
                    `;
                } else if (status === 'pending') {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-warning-subtle text-warning fs-11 rounded">
                                <i class="fas fa-circle-exclamation me-2 fs-14"></i> Pending
                            </a>
                        </li>
                    `;
                } else if (status === 'hold') {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-primary-subtle text-primary fs-11 rounded">
                                <i class="fas fa-stop-circle me-2 fs-14"></i> Hold
                            </a>
                        </li>
                    `;
                } else if (status === 'rejected') {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-danger-subtle text-danger fs-11 rounded">
                                <i class="fas fa-times me-2 fs-14"></i> Rejected
                            </a>
                        </li>
                    `;
                } else {
                    statusHtml = `
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);" class="avatar-title bg-warning-subtle text-warning fs-11 rounded">
                                <i class="fas fa-stop-circle me-2 fs-14"></i> Not Joined
                            </a>
                        </li>
                        <li class="list-inline-item avatar-lg" style="height: 2rem;">
                            <a href="javascript:void(0);"
                            onclick="openApplyModal(
                                '${ escapeHtml(brand.sid) }',
                                '${ escapeHtml(brand.name) }',
                                '${ escapeHtml(brand.commission) }',
                                '${ escapeHtml(commissionSuffix) }',
                                '${ escapeHtml(location) }'
                            )" data-bs-toggle="modal" data-bs-target="#modal-basic" class="avatar-title bg-success-subtle text-success fs-11 rounded">
                                <i class="ri-user-add-line me-2 fs-14"></i> Apply
                            </a>
                        </li>
                    `;
                }

                let year = brand.created_at
                    ? new Date(brand.created_at).getFullYear()
                    : 'N/A';

                    
                $('#company-view-detail').html(`
                <div class="card-body text-center">
                    <h5 class="mt-3 mb-1">${escapeHtml(brand.name ?? 'N/A')}</h5>
                    <p class="text-muted">(${escapeHtml(brand.sid ?? 'N/A')})</p>

                    <ul class="list-inline mb-0">
                        ${statusHtml}
                    </ul>
                </div>
                <div class="card-body">
                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Information</h6>
                    <p class="text-muted mb-4">${escapeHtml(brand.short_description ?? 'Promote this brand to your audience and earn commissions on successful referrals. Explore the program details and start building a profitable partnership with us.')}</p>
                    <div class="table-responsive table-card">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-medium" scope="row">Location</td>
                                    <td>${escapeHtml(location ?? 'N/A')}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Commission</td>
                                    <td>${escapeHtml(brand.commission ?? 'N/A')}${ brand.commission_type == "percentage" ? "%" : brand.commission_type }</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">APC</td>
                                    <td>${escapeHtml(brand.average_payment_time ?? 'N/A')} days</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Website</td>
                                    <td>
                                        <a href="${escapeHtml(brand.click_through_url ?? 'N/A')}" target="_blank" class="link-primary text-decoration-underline">${escapeHtml(brand.url ?? 'N/A')}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Currency</td>
                                    <td>${escapeHtml(brand.currency_code ?? 'N/A')}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium" scope="row">Since</td>
                                    <td>${escapeHtml(year ?? 'N/A')}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    
                `);
            }
        },

        error: function () {
            $('#company-view-detail').html(`
                <div class="card-body text-center py-5">
                    <i class="ri-error-warning-line fs-1 text-danger"></i>
                    <p class="text-muted mt-2">Unable to load brand details.</p>
                </div>
            `);
        }
    });
}

function escapeHtml(value) {
    return $('<div>').text(value).html();
}
</script>

@endpushonce

<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Good Morning, {{ auth()->user()->first_name }}!</h4>
                            <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                        </div>
                        <div class="mt-3 mt-lg-0">
                            <form action="javascript:void(0);">
                                <div class="row g-3 mb-0 align-items-center">
                                    <div class="col-sm-auto">
                                        <div class="input-group">
                                            <input type="text" id="dateRange"
                                                class="form-control border-0 minimal-border dash-filter-picker shadow">
                                            <div class="input-group-text bg-primary border-primary text-white">
                                                <i class="ri-calendar-2-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-auto">
                                        <form id="dateFilterForm">
                                            <button type="submit" class="btn btn-soft-primary material-shadow-none"
                                                id="filterbtn">Filter</button>
                                        </form>
                                    </div>
                                    <!--end col-->

                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Pending
                                        Earnings</p>
                                </div>
                                <div class="flex-shrink-0">
                                    @if(isset($earningOverview['pending']['growth']) && $earningOverview['pending']['growth'] == "up")
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +{{ $earningOverview['pending']['percentage'] ?? '0%' }}
                                        </h5>
                                    @else
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            -{{ $earningOverview['pending']['percentage'] ?? '0%' }}
                                        </h5>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        {{ $pendingCurrency === 'USD' ? "$" : $pendingCurrency }}
                                        <span class="counter-value" data-target="{{ $pending }}"></span>
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning-subtle rounded fs-3">
                                        <i class="bx bx-dollar-circle text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Approved
                                        Earnings</p>
                                </div>
                                <div class="flex-shrink-0">
                                    @if(isset($earningOverview['approved']['growth']) && $earningOverview['approved']['growth'] == "up")
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +{{ $earningOverview['approved']['percentage'] ?? '0%' }}
                                        </h5>
                                    @else
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            -{{ $earningOverview['approved']['percentage'] ?? '0%' }}
                                        </h5>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        {{ $approvedCurrency === 'USD' ? "$" : $approvedCurrency }}
                                        <span class="counter-value" data-target="{{ $approved }}"></span>
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success-subtle rounded fs-3">
                                        <i class="mdi mdi-currency-usd text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Declined
                                        Earnings</p>
                                </div>
                                <div class="flex-shrink-0">
                                    @if(isset($earningOverview['declined']['growth']) && $earningOverview['declined']['growth'] == "up")
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +{{ $earningOverview['declined']['percentage'] ?? '0%' }}
                                        </h5>
                                    @else
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            -{{ $earningOverview['declined']['percentage'] ?? '0%' }}
                                        </h5>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        @if(isset($earningOverview['declined']['commission_amount_currency']))
                                            {{ $earningOverview['declined']['commission_amount_currency'] === 'USD' ? "$" : $earningOverview['declined']['commission_amount_currency'] }}<span
                                                class="counter-value"
                                                data-target="{{ isset($earningOverview['declined']['total_commission_amount']) ? number_format($earningOverview['declined']['total_commission_amount'], 2) : '0.00' }}"></span>
                                        @else
                                            <span class="counter-value" data-target="0"></span>
                                        @endif

                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger-subtle rounded fs-3">
                                        <i class="mdi mdi-currency-usd-off text-danger"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Payouts</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-muted fs-14 mb-0">
                                        +0.00 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        $<span class="counter-value"
                                            data-target="{{ number_format($earningOverview['paid_status'] ?? 0, 2) }}">0</span>
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                        <i class="bx bx-wallet text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

            </div> <!-- end row-->
        </div>
    </div>
</div>

{{-- Performance Charts --}}
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0 align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Performance Metric</h4>
                <div>
                    <button type="button" class="btn btn-soft-success material-shadow-none btn-sm chart-type-btn active" data-type="commission">
                        Revenue
                    </button>
                    <button type="button" class="btn btn-soft-dark material-shadow-none btn-sm chart-type-btn" data-type="sale">
                        Sales
                    </button>
                    <button type="button" class="btn btn-soft-dark material-shadow-none btn-sm chart-type-btn" data-type="transaction">
                        Transactions
                    </button>
                </div>
            </div><!-- end card header -->

            <div class="card-header p-0 border-0 bg-light-subtle">
                <div class="row g-0 text-center">
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1"><span class="counter-value"
                                    data-target="{{ $performanceOverview['commission']['count'] ?? 0 }}">0</span>
                            </h5>
                            <p class="text-muted mb-0">Revenue</p>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1"><span class="counter-value"
                                    data-target="{{ $performanceOverview['sale']['count'] ?? 0 }}">0</span></h5>
                            <p class="text-muted mb-0">Sales</p>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0">
                            <h5 class="mb-1"><span class="counter-value"
                                    data-target="{{ $performanceOverview['transaction']['count'] ?? 0 }}">0</span>
                            </h5>
                            <p class="text-muted mb-0">Transactions</p>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-6 col-sm-3">
                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                            <h5 class="mb-1 text-success"><span class="counter-value"
                                    data-target="{{ $totalClicks }}">0</span></h5>
                            <p class="text-muted mb-0">Clicks</p>
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div><!-- end card header -->

            <div class="card-body p-0 pb-2">
                <div class="w-100">
                    <div id="performance_chart"
                        data-colors='["--vz-primary", "--vz-success"]'
                        data-colors-minimal='["--vz-light", "--vz-primary"]'
                        data-colors-saas='["--vz-success", "--vz-info"]'
                        data-colors-modern='["--vz-warning", "--vz-primary"]'
                        data-colors-interactive='["--vz-info", "--vz-primary"]'
                        data-colors-creative='["--vz-warning", "--vz-primary"]'
                        data-colors-corporate='["--vz-light", "--vz-primary"]'
                        data-colors-galaxy='["--vz-secondary", "--vz-primary"]'
                        data-colors-classic='["--vz-light", "--vz-primary"]'
                        data-colors-vintage='["--vz-success", "--vz-primary"]' class="apex-charts"
                        dir="ltr"></div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-lg-4">
        <div class="card ">
            <div class="card-header border-0 align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Top Highest-Performing Brands Driving</h4>
            </div>
            @if(count($topSales))
                <div id="flotPie" style="width: 100%;height:300px;"></div>
            @else
                <p style="text-align:center;">No enough data</p>
            @endif
        </div><!-- card -->
    </div><!-- col -->
</div>

<div class="row g-3">

    <div class="col-lg-8">
        <div class="card card-pad h-100">
            <div class="card-header border-0 align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Brands Status Summary</h4>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-5 d-flex justify-content-center">
                        <div class="donut-wrap" style="width:200px;height:200px;">
                            <canvas id="chartDonut"></canvas>
                            <div class="donut-center">
                                <div class="n">{{ $total }}</div>
                                <div class="l">Brands</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 mt-4 mt-md-0">
                        @foreach($labels as $i => $label)
                            <div class="status-detail-item">
                                <div class="sdi-row">
                                    <span class="lbl">{{ $label }}</span>
                                    <span class="val">{{ number_format($values[$i]) }}<span class="pct">({{ $percentages[$i] }}%)</span></span>
                                </div>
                                <div class="progress">
                                    @if($i == 0) 
                                    <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: {{ $percentages[$i] }}%;"></div>
                                    @elseif($i == 1) 
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: {{ $percentages[$i] }}%;"></div>
                                    @elseif($i == 2) 
                                    <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: {{ $percentages[$i] }}%;"></div>
                                    @elseif($i == 3) 
                                    <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: {{ $percentages[$i] }}%;"></div>
                                    @else 
                                    <div class="progress-bar progress-bar-striped bg-dark" role="progressbar" style="width: {{ $percentages[$i] }}%;"></div>
                                    @endif
                                    {{-- <span style="width:{{ $percentages[$i] }}%;"></span> --}}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-pad h-100">
            <div class="card-header border-0" style="margin-bottom:16px;">
                <h4 class="card-title mb-0 flex-grow-1">Traffic &amp; Conversion Summary</h4>
                <span style="font-size: 12px;">A quick snapshot of clicks, transactions, and conversion rate.</span>
            </div>

            
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card border shadow-none mb-0">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="flex-shrink-0 bg-primary-subtle rounded p-3">
                                    <i class="ri-exchange-funds-line fs-3 text-primary"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Transactions</p>
                                    <h4 class="mb-0 fw-semibold">
                                        {{ $performanceOverview['transaction']['count'] ?? 0 }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border shadow-none mb-0">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="flex-shrink-0 bg-success-subtle rounded p-3">
                                    <i class="ri-cursor-line fs-3 text-success"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Total Clicks</p>
                                    <h4 class="mb-0 fw-semibold">
                                        {{ $totalClicks }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border shadow-none mb-0">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="flex-shrink-0 bg-warning-subtle rounded p-3">
                                    <i class="ri-percent-line fs-3 text-warning"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-1">Conversion Rate</p>
                                    <h4 class="mb-0 fw-semibold">
                                        {{ $CVR_display }}%
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header border-0">
                <h4 class="card-title mb-0 flex-grow-1">Brands Performance Summary</h4>
                <span style="font-size: 12px;">This table summarizes key performance indicators for each advertiser, including Total Sales, Revenue Earned, Transaction Volume, and Conversion Rate.</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Brand Name</th>
                                <th>Sales</th>
                                <th>Revenue</th>
                                <th>Transaction</th>
                                <th>Clicks</th>
                                <th style="text-align:center;">Conversion %</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($topClicks))
                                @foreach($topClicks as $topClick)
                                    @if(isset($topClick['advertiser']['sid']))
                                        @php
                                            $transactions = App\Models\Transaction::select(Illuminate\Support\Facades\DB::raw('SUM(sale_amount) as total_sales_amount, SUM(commission_amount) as total_commission_amount, COUNT(*) as total_count'))
                                                ->where('publisher_id', auth()->user()->id)
                                                ->where('advertiser_id', $topClick['advertiser']['advertiser_id'])
                                                ->first();
                                            $total_transactions = $transactions->total_count ?? 0;
                                            $total_Clicks = $topClick['tracking'] ?? 0;
                                            $CVR = ($total_transactions / $total_Clicks) * 100;
                                            $CVR_display = number_format($CVR, 2);
                                        @endphp
                                        <tr>
                                            <td><a href="{{ route("publisher.view-advertiser", ['sid' => $topClick['advertiser']['sid']]) }}"
                                                    class="fw-semibold"
                                                    style="color:var(--teal-deep);">{{ $topClick['advertiser']['name'] }}</a></td>
                                            <td class="font-mono">$ {{ number_format($transactions->total_sales_amount, 0) ?? 0 }}</td>
                                            <td class="font-mono">$ {{ number_format($transactions->total_commission_amount, 2) ?? 0 }}
                                            </td>
                                            <td class="font-mono">{{ $transactions->total_count ?? 0 }}</td>
                                            <td class="font-mono">{{ $topClick['tracking'] ?? 0}}</td>
                                            <td class="font-mono" style="text-align:center;">{{ $CVR_display }}%</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align:center;">No enough data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- RECENTLY APPROVED BRANDS -->
    <div class="col-lg-9">
        <div class="card h-100">
            <div class="card-header border-0">
                <h4 class="card-title mb-0 flex-grow-1">Recently Approved Brands</h4>
                <div class="sub">Newest approved partnerships</div>
            </div>
            <div class="card-body">
                @include("template.publisher.advertisers.advertiser-list", compact('advertisers'))
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card" id="company-view-detail" style="position: sticky; top: 100px;">
            <div class="card-body text-center">
                <h5 class="mt-3 mb-1">Brand Details</h5>
            </div>

            <div class="card-body">
                <div class="text-center py-3">
                    <i class="ri-information-line fs-1 text-muted"></i>
                    <h6 class="text-muted mt-2 mb-1">View Brand Information</h6>
                    <p class="text-muted mb-0">
                        To see complete brand information, click on the
                        <i class="ri-eye-fill align-middle"></i>
                        (eye) icon.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>