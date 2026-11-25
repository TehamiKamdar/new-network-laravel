
<div class="tab-content perfomence-tab-wrap" id="performanceTabWrapper">

    <div class="row tab-pane fade active show" id="w_perfomence-year" style="display: flex" role="tabpanel" aria-labelledby="w_perfomence-year">
        <?php
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
        ?>

        <div class="col-md-12 performance-stats-container">
            <div class="p-2">
                <div class="row g-2 mb-3" id="performanceTab" role="tablist">
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none active" id="commission-tab" data-bs-toggle="tab"
                            data-bs-target="#commission" type="button" role="tab" aria-controls="commission"
                            aria-selected="true">
                            <i class="las la-money-bill-wave-alt label-icon align-middle fs-16 me-2"></i>
                            Total Revenue
                            
                        </button>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="approved-commission-tab" data-bs-toggle="tab"
                            data-bs-target="#approvedcommission" type="button" role="tab"
                            aria-controls="approvedcommission" aria-selected="false">
                            <i class="las la-money-check-alt label-icon align-middle fs-16 me-2"></i>
                            Approved Revenue
                            
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="pending-commission-tab" data-bs-toggle="tab"
                            data-bs-target="#pendingcommission" type="button" role="tab"
                            aria-controls="pendingcommission" aria-selected="false">
                            <i class="mdi mdi-clock-alert-outline label-icon align-middle fs-16 me-2"></i>
                            
                            Awaiting Revenue
                            
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="declined-commission-tab" data-bs-toggle="tab"
                            data-bs-target="#declinedcommission" type="button" role="tab"
                            aria-controls="declinedcommission" aria-selected="false">
                            <i class="ri-close-circle-fill label-icon align-middle fs-16 me-2"></i>
                            Rejected Revenue
                            
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="transaction-tab" data-bs-toggle="tab"
                            data-bs-target="#transaction" type="button" role="tab" aria-controls="transaction"
                            aria-selected="false">
                            <i class="ri-exchange-dollar-line label-icon align-middle fs-16 me-2"></i>
                            Total Conversions
                            
                        </button>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-soft-dark btn-label w-100 material-shadow-none" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale"
                        type="button" role="tab" aria-controls="sale" aria-selected="false">
                        <i class="ri-funds-line label-icon align-middle fs-16 me-2"></i>
                        Total Sales
                            
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

<?php $__env->startPush('extended_scripts'); ?>
    <script>
        let commissionApexChart, 
            approvedcommissionApexChart, 
            pendingcommissionApexChart, 
            declinedcommissionApexChart, 
            transactionApexChart,
            saleApexChart = null;
        
        function commissionChartLine() {
            let labels = <?php echo json_encode($performanceOverview['extra']['labels'] ?? [], 15, 512) ?>;
            let chartColors = getChartColorsArray('commissionChart');
            let series = [];

            $('#commissionChartLoader').removeClass("d-none");

            <?php if(request()->start_date && request()->end_date): ?>
                let data = <?php echo json_encode($performanceOverview['commission']['commission'] ?? [], 15, 512) ?>;
                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            <?php else: ?>
                let currentMonth = <?php echo json_encode($performanceOverview['commission']['dailyCurrentMonth'] ?? [], 15, 512) ?>;
                let previousMonth = <?php echo json_encode($performanceOverview['commission']['dailyPreviousMonth'] ?? [], 15, 512) ?>;
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
            <?php endif; ?>

            let min = <?php echo e($performanceOverview['commission']['min_value'] ?? 0); ?>;
            let max = <?php echo e($performanceOverview['commission']['max_value'] ?? 0); ?>;
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
            let labels = <?php echo json_encode($performanceOverview['extra']['labels'] ?? [], 15, 512) ?>;
            let chartColors = getChartColorsArray('approvedcommissionChart');
            let series = [];

            $('#approvedcommissionChartLoader').removeClass("d-none");

            <?php if(request()->start_date && request()->end_date): ?>
                let data = <?php echo json_encode($performanceOverview['approved']['commission'] ?? [], 15, 512) ?>;

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            <?php else: ?>
                let currentMonth = <?php echo json_encode($performanceOverview['approved']['dailyCurrentMonth'] ?? [], 15, 512) ?>;
                let previousMonth = <?php echo json_encode($performanceOverview['approved']['dailyPreviousMonth'] ?? [], 15, 512) ?>;

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
            <?php endif; ?>

            let min = <?php echo e($performanceOverview['approved']['min_value'] ?? 0); ?>;
            let max = <?php echo e($performanceOverview['approved']['max_value'] ?? 0); ?>;

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
            let labels = <?php echo json_encode($performanceOverview['extra']['labels'] ?? [], 15, 512) ?>;
            let chartColors = getChartColorsArray('pendingcommissionChart');
            let series = [];

            $('#pendingcommissionChartLoader').removeClass("d-none");

            <?php if(request()->start_date && request()->end_date): ?>
                let data = <?php echo json_encode($performanceOverview['pending']['commission'] ?? [], 15, 512) ?>;

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            <?php else: ?>
                let currentMonth = <?php echo json_encode($performanceOverview['pending']['dailyCurrentMonth'] ?? [], 15, 512) ?>;
                let previousMonth = <?php echo json_encode($performanceOverview['pending']['dailyPreviousMonth'] ?? [], 15, 512) ?>;

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
            <?php endif; ?>

            let min = <?php echo e($performanceOverview['pending']['min_value'] ?? 0); ?>;
            let max = <?php echo e($performanceOverview['pending']['max_value'] ?? 0); ?>;

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
            let labels = <?php echo json_encode($performanceOverview['extra']['labels'] ?? [], 15, 512) ?>;
            let chartColors = getChartColorsArray('declinedcommissionChart');
            let series = [];

            $('#declinedcommissionChartLoader').removeClass("d-none");

            <?php if(request()->start_date && request()->end_date): ?>
                let data = <?php echo json_encode($performanceOverview['declined']['commission'] ?? [], 15, 512) ?>;

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            <?php else: ?>
                let currentMonth = <?php echo json_encode($performanceOverview['declined']['dailyCurrentMonth'] ?? [], 15, 512) ?>;
                let previousMonth = <?php echo json_encode($performanceOverview['declined']['dailyPreviousMonth'] ?? [], 15, 512) ?>;

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
            <?php endif; ?>

            let min = <?php echo e($performanceOverview['declined']['min_value'] ?? 0); ?>;
            let max = <?php echo e($performanceOverview['declined']['max_value'] ?? 0); ?>;

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
            let labels = <?php echo json_encode($performanceOverview['extra']['labels'] ?? [], 15, 512) ?>;
            let chartColors = getChartColorsArray('transactionChart');
            let series = [];

            $('#transactionChartLoader').removeClass("d-none");

            <?php if(request()->start_date && request()->end_date): ?>
                let data = <?php echo json_encode($performanceOverview['transaction']['transaction'] ?? [], 15, 512) ?>;

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            <?php else: ?>
                let currentMonth = <?php echo json_encode($performanceOverview['transaction']['dailyCurrentMonth'] ?? [], 15, 512) ?>;
                let previousMonth = <?php echo json_encode($performanceOverview['transaction']['dailyPreviousMonth'] ?? [], 15, 512) ?>;

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
            <?php endif; ?>

            let min = <?php echo e($performanceOverview['transaction']['min_value'] ?? 0); ?>;
            let max = <?php echo e($performanceOverview['transaction']['max_value'] ?? 0); ?>;

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
            let labels = <?php echo json_encode($performanceOverview['extra']['labels'] ?? [], 15, 512) ?>;
            let chartColors = getChartColorsArray('saleChart');
            let series = [];

            $('#saleChartLoader').removeClass("d-none");

            <?php if(request()->start_date && request()->end_date): ?>
                let data = <?php echo json_encode($performanceOverview['sale']['sale'] ?? [], 15, 512) ?>;

                series = [
                    {
                        name: 'Current Period',
                        data: data
                    }
                ];
            <?php else: ?>
                let currentMonth = <?php echo json_encode($performanceOverview['sale']['dailyCurrentMonth'] ?? [], 15, 512) ?>;
                let previousMonth = <?php echo json_encode($performanceOverview['sale']['dailyPreviousMonth'] ?? [], 15, 512) ?>;

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
            <?php endif; ?>

            let min = <?php echo e($performanceOverview['sale']['min_value'] ?? 0); ?>;
            let max = <?php echo e($performanceOverview['sale']['max_value'] ?? 0); ?>;

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
<?php $__env->stopPush(); ?><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/widgets/section_performance_overview.blade.php ENDPATH**/ ?>