
<div class="tab-content perfomence-tab-wrap" id="performanceTabWrapper">

    <div class="row tab-pane fade active show" id="w_perfomence-year" style="display: flex" role="tabpanel" aria-labelledby="w_perfomence-year">
        @php
            // Calculate revenue data
            $commissionPercent = (float) \App\Helper\Static\Vars::COMMISSION_PERCENTAGE / 100;
            $rawValue = $performanceOverview['commission']['count'] ?? 0;

            // Extract numeric part
            preg_match('/([\d\.]+)/', $rawValue, $matches);
            $number = (float) ($matches[1] ?? 0);

            // Check for suffix (k, m, etc.)
            $suffix = '';
            if (stripos($rawValue, 'k') !== false) {
                $number *= 1000;
                $suffix = 'k';
            } elseif (stripos($rawValue, 'm') !== false) {
                $number *= 1000000;
                $suffix = 'm';
            }

            $calculated = $commissionPercent * $number;

            // Format result with suffix again
            if ($suffix === 'k') {
                $calculated = round($calculated / 1000, 1) . 'k';
            } elseif ($suffix === 'm') {
                $calculated = round($calculated / 1000000, 1) . 'm';
            }
        @endphp

        <div class="col-md-12 performance-stats-container">
            <div class="p-2">
                <div class="row g-2 mb-3" id="performanceTab" role="tablist">
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none active" id="commission-tab" data-bs-toggle="tab"
                            data-bs-target="#commission" type="button" role="tab" aria-controls="commission"
                            aria-selected="true">
                            <i class="las la-money-bill-wave-alt label-icon align-middle fs-16 me-2"></i>
                            Total Revenue
                            {{-- <span class="nav-tab-copy">
                                <span class="l">Total Revenue</span>
                                <span class="v">
                                    {{ $performanceOverview['commission']['count'] ?? 0 }}
                                    @if (!request()->start_date && !request()->end_date && isset($performanceOverview['commission']['percentage']))
                                        <span
                                            class="d @if ($performanceOverview['commission']['growth'] == 'up') up @else down @endif">
                                            <i
                                                class="fa-solid @if ($performanceOverview['commission']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                            {{ $performanceOverview['commission']['percentage'] ?? 0 }}
                                        </span>
                                    @endif
                                </span>
                            </span> --}}
                        </button>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="approved-commission-tab" data-bs-toggle="tab"
                            data-bs-target="#approvedcommission" type="button" role="tab"
                            aria-controls="approvedcommission" aria-selected="false">
                            <i class="las la-money-check-alt label-icon align-middle fs-16 me-2"></i>
                            Approved Revenue
                            {{-- <span class="nav-tab-copy">
                                <span class="l">Approved Revenue</span>
                                <span class="v">
                                    {{ $performanceOverview['approved']['count'] ?? 0 }}
                                    @if (!request()->start_date && !request()->end_date && isset($performanceOverview['approved']['percentage']))
                                        <span
                                            class="d @if ($performanceOverview['approved']['growth'] == 'up') up @else down @endif">
                                            <i
                                                class="fa-solid @if ($performanceOverview['approved']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                            {{ $performanceOverview['approved']['percentage'] ?? 0 }}
                                        </span>
                                    @endif
                                </span>
                            </span> --}}
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="pending-commission-tab" data-bs-toggle="tab"
                            data-bs-target="#pendingcommission" type="button" role="tab"
                            aria-controls="pendingcommission" aria-selected="false">
                            <i class="mdi mdi-clock-alert-outline label-icon align-middle fs-16 me-2"></i>
                            
                            Awaiting Revenue
                            {{-- <span class="nav-tab-copy">
                                <span class="l">Awaiting Revenue</span>
                                <span class="v">
                                    {{ $performanceOverview['pending']['count'] ?? 0 }}
                                    @if (!request()->start_date && !request()->end_date && isset($performanceOverview['pending']['percentage']))
                                        <span
                                            class="d @if ($performanceOverview['pending']['growth'] == 'up') up @else down @endif">
                                            <i
                                                class="fa-solid @if ($performanceOverview['pending']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                            {{ $performanceOverview['pending']['percentage'] ?? 0 }}
                                        </span>
                                    @endif
                                </span>
                            </span> --}}
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="declined-commission-tab" data-bs-toggle="tab"
                            data-bs-target="#declinedcommission" type="button" role="tab"
                            aria-controls="declinedcommission" aria-selected="false">
                            <i class="ri-close-circle-fill label-icon align-middle fs-16 me-2"></i>
                            Rejected Revenue
                            {{-- <span class="nav-tab-copy">
                                <span class="l">Rejected Revenue</span>
                                <span class="v">
                                    {{ $performanceOverview['declined']['count'] ?? 0 }}
                                    @if (!request()->start_date && !request()->end_date && isset($performanceOverview['declined']['percentage']))
                                        <span
                                            class="d @if ($performanceOverview['declined']['growth'] == 'up') up @else down @endif">
                                            <i
                                                class="fa-solid @if ($performanceOverview['declined']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                            {{ $performanceOverview['declined']['percentage'] ?? 0 }}
                                        </span>
                                    @endif
                                </span>
                            </span> --}}
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="transaction-tab" data-bs-toggle="tab"
                            data-bs-target="#transaction" type="button" role="tab" aria-controls="transaction"
                            aria-selected="false">
                            <i class="ri-exchange-dollar-line label-icon align-middle fs-16 me-2"></i>
                            Total Conversions
                            {{-- <span class="nav-tab-copy">
                                <span class="l">Total Conversions</span>
                                <span class="v">
                                    {{ $performanceOverview['transaction']['count'] ?? 0 }}
                                    @if (!request()->start_date && !request()->end_date && isset($performanceOverview['transaction']['percentage']))
                                        <span
                                            class="d @if ($performanceOverview['transaction']['growth'] == 'up') up @else down @endif">
                                            <i
                                                class="fa-solid @if ($performanceOverview['transaction']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                            {{ $performanceOverview['transaction']['percentage'] ?? 0 }}
                                        </span>
                                    @endif
                                </span>
                            </span> --}}
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale"
                        type="button" role="tab" aria-controls="sale" aria-selected="false">
                        <i class="ri-funds-line label-icon align-middle fs-16 me-2"></i>
                        Total Sales
                            {{-- <span class="nav-tab-copy">
                                <span class="l">Total Sales</span>
                                <span class="v">
                                    {{ $performanceOverview['sale']['count'] ?? 0 }}
                                    @if (!request()->start_date && !request()->end_date && isset($performanceOverview['sale']['percentage']))
                                        <span
                                            class="d @if ($performanceOverview['sale']['growth'] == 'up') up @else down @endif">
                                            <i
                                                class="fa-solid @if ($performanceOverview['sale']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                            {{ $performanceOverview['sale']['percentage'] ?? 0 }}
                                        </span>
                                    @endif
                                </span>
                            </span> --}}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="performanceTabContent">
            <div class="tab-pane fade show active" id="commission" role="tabpanel" aria-labelledby="commission-tab">
                <div class="card mb-0 shadow-none">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Total Revenue Data</h4>
                    </div>
                    <div class="card-body px-0">
                        <div id="commissionChartContent" style="height: 300px; position: relative;">

                            <div id="commissionChartLoader" class="d-flex justify-content-center align-items-center" style="height: 300px; position: absolute; inset: 0;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div id="commissionChart"
                                class="apex-charts"
                                data-colors='["--vz-primary", "--vz-success"]'
                                dir="ltr">
                            </div>

                        </div>

                        <ul class="legend-static d-flex justify-content-center" id="commissionPeriodContent"></ul>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="approvedcommission" role="tabpanel" aria-labelledby="approved-commission-tab">
                <div class="card mb-0 shadow-none">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Approved Revenue Data</h4>
                    </div>
                    <div class="card-body px-0">
                        <div id="approvedcommissionChartContent" style="height: 300px; position: relative;">

                            <div id="approvedcommissionChartLoader" class="d-flex justify-content-center align-items-center" style="height: 300px; position: absolute; inset: 0;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div id="approvedcommissionChart"
                                class="apex-charts"
                                data-colors='["--vz-primary", "--vz-success"]'
                                dir="ltr">
                            </div>

                        </div>

                        <ul class="legend-static d-flex justify-content-center" id="approvedcommissionPeriodContent"></ul>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pendingcommission" role="tabpanel" aria-labelledby="pending-commission-tab">
                <div class="card mb-0 shadow-none">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Awaiting Revenue Data</h4>
                    </div>
                    <div class="card-body px-0">
                        <div id="pendingcommissionChartContent" style="height: 300px; position: relative;">

                            <div id="pendingcommissionChartLoader" class="d-flex justify-content-center align-items-center" style="height: 300px; position: absolute; inset: 0;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div id="pendingcommissionChart"
                                class="apex-charts"
                                data-colors='["--vz-primary", "--vz-success"]'
                                dir="ltr">
                            </div>

                        </div>

                        <ul class="legend-static d-flex justify-content-center" id="pendingcommissionPeriodContent"></ul>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="declinedcommission" role="tabpanel" aria-labelledby="declined-commission-tab">
                <div class="card mb-0 shadow-none">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Rejected Revenue Data</h4>
                    </div>
                    <div class="card-body px-0">
                        <div id="declinedcommissionChartContent" style="height: 300px; position: relative;">

                            <div id="declinedcommissionChartLoader" class="d-flex justify-content-center align-items-center" style="height: 300px; position: absolute; inset: 0;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div id="declinedcommissionChart"
                                class="apex-charts"
                                data-colors='["--vz-primary", "--vz-success"]'
                                dir="ltr">
                            </div>

                        </div>

                        <ul class="legend-static d-flex justify-content-center" id="declinedcommissionPeriodContent"></ul>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
                <div class="card mb-0 shadow-none">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Total Conversions Data</h4>
                    </div>
                    <div class="card-body px-0">
                        <div id="transactionChartContent" style="height: 300px; position: relative;">

                            <div id="transactionChartLoader" class="d-flex justify-content-center align-items-center" style="height: 300px; position: absolute; inset: 0;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div id="transactionChart"
                                class="apex-charts"
                                data-colors='["--vz-primary", "--vz-success"]'
                                dir="ltr">
                            </div>

                        </div>

                        <ul class="legend-static d-flex justify-content-center" id="transactionPeriodContent"></ul>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="sale" role="tabpanel" aria-labelledby="sale-tab">
                <div class="card mb-0 shadow-none">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Total Sales Data</h4>
                    </div>
                    <div class="card-body px-0">
                        <div id="saleChartContent" style="height: 300px; position: relative;">

                            <div id="saleChartLoader" class="d-flex justify-content-center align-items-center" style="height: 300px; position: absolute; inset: 0;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div id="saleChart"
                                class="apex-charts"
                                data-colors='["--vz-primary", "--vz-success"]'
                                dir="ltr">
                            </div>

                        </div>

                        <ul class="legend-static d-flex justify-content-center" id="salePeriodContent"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('extended_scripts')
    <script>
        let commissionApexChart, 
            approvedcommissionApexChart, 
            pendingcommissionApexChart, 
            declinedcommissionApexChart, 
            transactionApexChart,
            saleApexChart = null;
        
        function commissionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);
            let chartColors = getChartColorsArray('commissionChart');
            let series = [];

            $('#commissionChartLoader').removeClass("d-none");

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['commission']['commission'] ?? []);
                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            @else
                let currentMonth = @json($performanceOverview['commission']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['commission']['dailyPreviousMonth'] ?? []);
                series = [
                    {
                        name: 'Current Month',
                        data: currentMonth
                    },
                    {
                        name: 'Previous Month',
                        data: previousMonth
                    }
                ];
            @endif

            let min = {{ $performanceOverview['commission']['min_value'] ?? 0 }};
            let max = {{ $performanceOverview['commission']['max_value'] ?? 0 }};
            let options = {
                series: series,
                chart: {
                    type: 'area',
                    height: 300,
                    parentHeightOffset: 0,
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
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    min: min,
                    max: max,
                    forceNiceScale: true,
                    labels: {
                        formatter: function (value) {
                            return value.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 4
                },
                legend: {
                    show: false
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

            // External legend
            let legendHtml = '';
            series.forEach(function (item, index) {
                legendHtml += `
                    <li class="custom-label">
                        <span class="dot" style="background-color: ${chartColors[index]};"></span>
                        ${item.name}
                    </li>
                `;
            });

            $('#commissionPeriodContent').html(legendHtml);

            // Initialize or update chart
            if (commissionApexChart) {
                commissionApexChart.updateOptions({
                    series: series,
                    colors: chartColors,
                    xaxis: {
                        categories: labels
                    },
                    yaxis: {
                        min: min,
                        max: max
                    }
                }).then(function () {
                    $('#commissionChartLoader').addClass("d-none");
                });
            } else {
                commissionApexChart = new ApexCharts(
                    document.querySelector('#commissionChart'),
                    options
                );
                commissionApexChart.render().then(function () {
                    $('#commissionChartLoader').addClass("d-none");
                });
            }
        }

        function approvedcommissionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);
            let chartColors = getChartColorsArray('approvedcommissionChart');
            let series = [];

            $('#approvedcommissionChartLoader').removeClass("d-none");

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['approved']['commission'] ?? []);

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            @else
                let currentMonth = @json($performanceOverview['approved']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['approved']['dailyPreviousMonth'] ?? []);

                series = [
                    {
                        name: 'Current Month',
                        data: currentMonth
                    },
                    {
                        name: 'Previous Month',
                        data: previousMonth
                    }
                ];
            @endif

            let min = {{ $performanceOverview['approved']['min_value'] ?? 0 }};
            let max = {{ $performanceOverview['approved']['max_value'] ?? 0 }};

            let options = {
                series: series,
                chart: {
                    type: 'area',
                    height: 300,
                    parentHeightOffset: 0,
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
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    min: min,
                    max: max,
                    forceNiceScale: true,
                    labels: {
                        formatter: function (value) {
                            return value.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 4
                },
                legend: {
                    show: false
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

            // External legend
            let legendHtml = '';

            series.forEach(function (item, index) {
                legendHtml += `
                    <li class="custom-label">
                        <span class="dot" style="background-color: ${chartColors[index]};"></span>
                        ${item.name}
                    </li>
                `;
            });

            $('#approvedcommissionPeriodContent').html(legendHtml);

            // Initialize or update chart
            if (approvedcommissionApexChart) {
                approvedcommissionApexChart.updateOptions({
                    series: series,
                    colors: chartColors,
                    xaxis: {
                        categories: labels
                    },
                    yaxis: {
                        min: min,
                        max: max
                    }
                }).then(function () {
                    $('#approvedcommissionChartLoader').addClass("d-none");
                });
            } else {
                approvedcommissionApexChart = new ApexCharts(
                    document.querySelector('#approvedcommissionChart'),
                    options
                );

                approvedcommissionApexChart.render().then(function () {
                    $('#approvedcommissionChartLoader').addClass("d-none");
                });
            }
        }

        function pendingcommissionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);
            let chartColors = getChartColorsArray('pendingcommissionChart');
            let series = [];

            $('#pendingcommissionChartLoader').removeClass("d-none");

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['pending']['commission'] ?? []);

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            @else
                let currentMonth = @json($performanceOverview['pending']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['pending']['dailyPreviousMonth'] ?? []);

                series = [
                    {
                        name: 'Current Month',
                        data: currentMonth
                    },
                    {
                        name: 'Previous Month',
                        data: previousMonth
                    }
                ];
            @endif

            let min = {{ $performanceOverview['pending']['min_value'] ?? 0 }};
            let max = {{ $performanceOverview['pending']['max_value'] ?? 0 }};

            let options = {
                series: series,
                chart: {
                    type: 'area',
                    height: 300,
                    parentHeightOffset: 0,
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
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    min: min,
                    max: max,
                    forceNiceScale: true,
                    labels: {
                        formatter: function (value) {
                            return value.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 4
                },
                legend: {
                    show: false
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

            // External legend
            let legendHtml = '';

            series.forEach(function (item, index) {
                legendHtml += `
                    <li class="custom-label">
                        <span class="dot" style="background-color: ${chartColors[index]};"></span>
                        ${item.name}
                    </li>
                `;
            });

            $('#pendingcommissionPeriodContent').html(legendHtml);

            // Initialize or update chart
            if (pendingcommissionApexChart) {
                pendingcommissionApexChart.updateOptions({
                    series: series,
                    colors: chartColors,
                    xaxis: {
                        categories: labels
                    },
                    yaxis: {
                        min: min,
                        max: max
                    }
                }).then(function () {
                    $('#pendingcommissionChartLoader').addClass("d-none");
                });
            } else {
                pendingcommissionApexChart = new ApexCharts(
                    document.querySelector('#pendingcommissionChart'),
                    options
                );

                pendingcommissionApexChart.render().then(function () {
                    $('#pendingcommissionChartLoader').addClass("d-none");
                });
            }
        }

        function declinedcommissionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);
            let chartColors = getChartColorsArray('declinedcommissionChart');
            let series = [];

            $('#declinedcommissionChartLoader').removeClass("d-none");

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['declined']['commission'] ?? []);

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            @else
                let currentMonth = @json($performanceOverview['declined']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['declined']['dailyPreviousMonth'] ?? []);

                series = [
                    {
                        name: 'Current Month',
                        data: currentMonth
                    },
                    {
                        name: 'Previous Month',
                        data: previousMonth
                    }
                ];
            @endif

            let min = {{ $performanceOverview['declined']['min_value'] ?? 0 }};
            let max = {{ $performanceOverview['declined']['max_value'] ?? 0 }};

            let options = {
                series: series,
                chart: {
                    type: 'area',
                    height: 300,
                    parentHeightOffset: 0,
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
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    min: min,
                    max: max,
                    forceNiceScale: true,
                    labels: {
                        formatter: function (value) {
                            return value.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 4
                },
                legend: {
                    show: false
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

            // External legend
            let legendHtml = '';

            series.forEach(function (item, index) {
                legendHtml += `
                    <li class="custom-label">
                        <span class="dot" style="background-color: ${chartColors[index]};"></span>
                        ${item.name}
                    </li>
                `;
            });

            $('#declinedcommissionPeriodContent').html(legendHtml);

            // Initialize or update chart
            if (declinedcommissionApexChart) {
                declinedcommissionApexChart.updateOptions({
                    series: series,
                    colors: chartColors,
                    xaxis: {
                        categories: labels
                    },
                    yaxis: {
                        min: min,
                        max: max
                    }
                }).then(function () {
                    $('#declinedcommissionChartLoader').addClass("d-none");
                });
            } else {
                declinedcommissionApexChart = new ApexCharts(
                    document.querySelector('#declinedcommissionChart'),
                    options
                );

                declinedcommissionApexChart.render().then(function () {
                    $('#declinedcommissionChartLoader').addClass("d-none");
                });
            }
        }

        function transactionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);
            let chartColors = getChartColorsArray('transactionChart');
            let series = [];

            $('#transactionChartLoader').removeClass("d-none");

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['transaction']['transaction'] ?? []);

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            @else
                let currentMonth = @json($performanceOverview['transaction']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['transaction']['dailyPreviousMonth'] ?? []);

                series = [
                    {
                        name: 'Current Month',
                        data: currentMonth
                    },
                    {
                        name: 'Previous Month',
                        data: previousMonth
                    }
                ];
            @endif

            let min = {{ $performanceOverview['transaction']['min_value'] ?? 0 }};
            let max = {{ $performanceOverview['transaction']['max_value'] ?? 0 }};

            let options = {
                series: series,
                chart: {
                    type: 'area',
                    height: 300,
                    parentHeightOffset: 0,
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
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    min: min,
                    max: max,
                    forceNiceScale: true,
                    labels: {
                        formatter: function (value) {
                            return value.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 4
                },
                legend: {
                    show: false
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

            // External legend
            let legendHtml = '';

            series.forEach(function (item, index) {
                legendHtml += `
                    <li class="custom-label">
                        <span class="dot" style="background-color: ${chartColors[index]};"></span>
                        ${item.name}
                    </li>
                `;
            });

            $('#transactionPeriodContent').html(legendHtml);

            // Initialize or update chart
            if (transactionApexChart) {
                transactionApexChart.updateOptions({
                    series: series,
                    colors: chartColors,
                    xaxis: {
                        categories: labels
                    },
                    yaxis: {
                        min: min,
                        max: max
                    }
                }).then(function () {
                    $('#transactionChartLoader').addClass("d-none");
                });
            } else {
                transactionApexChart = new ApexCharts(
                    document.querySelector('#transactionChart'),
                    options
                );

                transactionApexChart.render().then(function () {
                    $('#transactionChartLoader').addClass("d-none");
                });
            }
        }

        function saleChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);
            let chartColors = getChartColorsArray('saleChart');
            let series = [];

            $('#saleChartLoader').removeClass("d-none");

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['sale']['sale'] ?? []);

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            @else
                let currentMonth = @json($performanceOverview['sale']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['sale']['dailyPreviousMonth'] ?? []);

                series = [
                    {
                        name: 'Current Month',
                        data: currentMonth
                    },
                    {
                        name: 'Previous Month',
                        data: previousMonth
                    }
                ];
            @endif

            let min = {{ $performanceOverview['sale']['min_value'] ?? 0 }};
            let max = {{ $performanceOverview['sale']['max_value'] ?? 0 }};

            let options = {
                series: series,
                chart: {
                    type: 'area',
                    height: 300,
                    parentHeightOffset: 0,
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
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    min: min,
                    max: max,
                    forceNiceScale: true,
                    labels: {
                        formatter: function (value) {
                            return value.toLocaleString();
                        }
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 4
                },
                legend: {
                    show: false
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

            // External legend
            let legendHtml = '';

            series.forEach(function (item, index) {
                legendHtml += `
                    <li class="custom-label">
                        <span class="dot" style="background-color: ${chartColors[index]};"></span>
                        ${item.name}
                    </li>
                `;
            });

            $('#salePeriodContent').html(legendHtml);

            // Initialize or update chart
            if (saleApexChart) {
                saleApexChart.updateOptions({
                    series: series,
                    colors: chartColors,
                    xaxis: {
                        categories: labels
                    },
                    yaxis: {
                        min: min,
                        max: max
                    }
                }).then(function () {
                    $('#saleChartLoader').addClass("d-none");
                });
            } else {
                saleApexChart = new ApexCharts(
                    document.querySelector('#saleChart'),
                    options
                );

                saleApexChart.render().then(function () {
                    $('#saleChartLoader').addClass("d-none");
                });
            }
        }


        document.addEventListener("DOMContentLoaded", function () {
            commissionChartLine();
            approvedcommissionChartLine();
            pendingcommissionChartLine();
            declinedcommissionChartLine();
            transactionChartLine();
            saleChartLine();
        });
    </script>
@endpush