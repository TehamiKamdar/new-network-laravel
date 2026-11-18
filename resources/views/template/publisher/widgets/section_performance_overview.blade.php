
        <div class="tab-content perfomence-tab-wrap" id="performanceTabWrapper">

            <div class="row tab-pane fade active show" id="w_perfomence-year" style="display: flex" role="tabpanel"
                aria-labelledby="w_perfomence-year">
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
                    <div class="nav nav-tabs performance-tabs border-0 mb-4 mt-2">
                        <div class="row g-2 mb-3" id="performanceTab" role="tablist">
                            <div class="col-md-6">
                                <button class="nav-tab active" id="commission-tab" data-bs-toggle="tab"
                                    data-bs-target="#commission" type="button" role="tab" aria-controls="commission"
                                    aria-selected="true">
                                    <span class="nav-tab-icon teal">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 17l6-6 4 4 8-8" />
                                            <path d="M17 7h4v4" />
                                        </svg>
                                    </span>
                                    <span class="nav-tab-copy">
                                        <span class="l">Total Revenue</span>
                                        <span class="v">
                                            {{ $performanceOverview['commission']['count'] ?? 0 }}
                                            @if (!request()->start_date && !request()->end_date && isset($performanceOverview['commission']['percentage']))
                                                <span
                                                    class="d @if ($performanceOverview['commission']['growth'] == 'up') up @else down @endif">
                                                    <i
                                                        class="fa-solid @if ($performanceOverview['commission']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                                    {{ $performanceOverview['commission']['percentage'] ?? 0 }}
                                            @endif
                                            </span>
                                        </span>
                                </button>
                            </div>

                            <div class="col-md-6">
                                <button class="nav-tab" id="approved-commission-tab" data-bs-toggle="tab"
                                    data-bs-target="#approvedcommission" type="button" role="tab"
                                    aria-controls="approvedcommission" aria-selected="false">
                                    <span class="nav-tab-icon teal-solid">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="9" />
                                            <path d="M8 12l3 3 5-6" />
                                        </svg>
                                    </span>
                                    <span class="nav-tab-copy">
                                        <span class="l">Approved Revenue</span>
                                        <span class="v">
                                            {{ $performanceOverview['approved']['count'] ?? 0 }}
                                            @if (!request()->start_date && !request()->end_date && isset($performanceOverview['approved']['percentage']))
                                                <span
                                                    class="d @if ($performanceOverview['approved']['growth'] == 'up') up @else down @endif">
                                                    <i
                                                        class="fa-solid @if ($performanceOverview['approved']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                                    {{ $performanceOverview['approved']['percentage'] ?? 0 }}
                                            @endif
                                            </span>
                                        </span>
                                </button>
                            </div>
                            
                            <div class="col-md-6">
                                <button class="nav-tab" id="pending-commission-tab" data-bs-toggle="tab"
                                    data-bs-target="#pendingcommission" type="button" role="tab"
                                    aria-controls="pendingcommission" aria-selected="false">
                                    <span class="nav-tab-icon amber">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="9" />
                                            <path d="M12 7v5l3 3" />
                                        </svg>
                                    </span>
                                    <span class="nav-tab-copy">
                                        <span class="l">Awaiting Revenue</span>
                                        <span class="v">
                                            {{ $performanceOverview['pending']['count'] ?? 0 }}
                                            @if (!request()->start_date && !request()->end_date && isset($performanceOverview['pending']['percentage']))
                                                <span
                                                    class="d @if ($performanceOverview['pending']['growth'] == 'up') up @else down @endif">
                                                    <i
                                                        class="fa-solid @if ($performanceOverview['pending']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                                    {{ $performanceOverview['pending']['percentage'] ?? 0 }}
                                            @endif
                                            </span>
                                        </span>
                                </button>
                            </div>
                            
                            <div class="col-md-6">
                                <button class="nav-tab" id="declined-commission-tab" data-bs-toggle="tab"
                                    data-bs-target="#declinedcommission" type="button" role="tab"
                                    aria-controls="declinedcommission" aria-selected="false">
                                    <span class="nav-tab-icon coral">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="9" />
                                            <path d="m9.5 9.5 5 5m0-5-5 5" />
                                        </svg>
                                    </span>
                                    <span class="nav-tab-copy">
                                        <span class="l">Rejected Revenue</span>
                                        <span class="v">
                                            {{ $performanceOverview['declined']['count'] ?? 0 }}
                                            @if (!request()->start_date && !request()->end_date && isset($performanceOverview['declined']['percentage']))
                                                <span
                                                    class="d @if ($performanceOverview['declined']['growth'] == 'up') up @else down @endif">
                                                    <i
                                                        class="fa-solid @if ($performanceOverview['declined']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                                    {{ $performanceOverview['declined']['percentage'] ?? 0 }}
                                            @endif
                                            </span>
                                        </span>
                                </button>
                            </div>
                            
                            <div class="col-md-6">
                                <button class="nav-tab" id="transaction-tab" data-bs-toggle="tab"
                                    data-bs-target="#transaction" type="button" role="tab" aria-controls="transaction"
                                    aria-selected="false">
                                    <span class="nav-tab-icon ink">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 4h16l-6 8v6l-4 2v-8z" />
                                        </svg>
                                    </span>
                                    <span class="nav-tab-copy">
                                        <span class="l">Total Conversions</span>
                                        <span class="v">
                                            {{ $performanceOverview['transaction']['count'] ?? 0 }}
                                            @if (!request()->start_date && !request()->end_date && isset($performanceOverview['transaction']['percentage']))
                                                <span
                                                    class="d @if ($performanceOverview['transaction']['growth'] == 'up') up @else down @endif">
                                                    <i
                                                        class="fa-solid @if ($performanceOverview['transaction']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                                    {{ $performanceOverview['transaction']['percentage'] ?? 0 }}
                                            @endif
                                            </span>
                                        </span>
                                </button>
                            </div>
                            
                            <div class="col-md-6">
                                <button class="nav-tab" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale"
                                    type="button" role="tab" aria-controls="sale" aria-selected="false">
                                    <span class="nav-tab-icon amber-solid">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="9" cy="21" r="1" />
                                            <circle cx="20" cy="21" r="1" />
                                            <path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6" />
                                        </svg>
                                    </span>
                                    <span class="nav-tab-copy">
                                        <span class="l">Total Sales</span>
                                        <span class="v">
                                            {{ $performanceOverview['sale']['count'] ?? 0 }}
                                            @if (!request()->start_date && !request()->end_date && isset($performanceOverview['sale']['percentage']))
                                                <span
                                                    class="d @if ($performanceOverview['sale']['growth'] == 'up') up @else down @endif">
                                                    <i
                                                        class="fa-solid @if ($performanceOverview['sale']['growth'] == 'up') fa-arrow-up @else fa-arrow-down @endif"></i>
                                                    {{ $performanceOverview['sale']['percentage'] ?? 0 }}
                                            @endif
                                            </span>
                                        </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="performanceTabContent">
                    <div class="tab-pane fade show active" id="commission" role="tabpanel" ria-labelledby="commission-tab">
                        <h3 class="chart-pane-title">Total Revenue Data</h3>
                        <div style="height:240px;" id="commissionChartContent"><canvas id="commissionChart"></canvas></div>
                        <ul class="legend-static" id="commissionPeriodContent">
                            <li><span class="dot" style="background:var(--teal);"></span>Current Period</li>
                            <li><span class="dot" style="background:#F2A93B;"></span>Previous Period</li>
                        </ul>
                    </div>

                    <div class="tab-pane fade" id="approvedcommission" role="tabpanel"
                        aria-labelledby="approved-commission-tab">
                        <h3 class="chart-pane-title">Approved Revenue Data</h3>
                        <div style="height:240px;" id="approvedcommissionChartContent"><canvas id="approvedcommissionChart"></canvas></div>
                        <ul class="legend-static" id="approvedcommissionPeriodContent">
                            <li><span class="dot" style="background:var(--teal);"></span>Current Period</li>
                            <li><span class="dot" style="background:#F2A93B;"></span>Previous Period</li>
                        </ul>
                    </div>

                    <div class="tab-pane fade" id="pendingcommission" role="tabpanel"
                        aria-labelledby="pending-commission-tab">
                        <h3 class="chart-pane-title">Awaiting Revenue Data</h3>
                        <div style="height:240px;" id="declinedcommissionChartContent"><canvas id="pendingcommissionChart"></canvas></div>
                        <ul class="legend-static" id="declinedcommissionPeriodContent">
                            <li><span class="dot" style="background:var(--teal);"></span>Current Period</li>
                            <li><span class="dot" style="background:#F2A93B;"></span>Previous Period</li>
                        </ul>
                    </div>

                    <div class="tab-pane fade" id="declinedcommission" role="tabpanel"
                        aria-labelledby="declined-commission-tab">
                        <h3 class="chart-pane-title">Rejected Revenue Data</h3>
                        <div style="height:240px;" id="pendingcommissionChartContent"><canvas id="declinedcommissionChart"></canvas></div>
                        <ul class="legend-static" id="pendingcommissionPeriodContent">
                            <li><span class="dot" style="background:var(--teal);"></span>Current Period</li>
                            <li><span class="dot" style="background:#F2A93B;"></span>Previous Period</li>
                        </ul>
                    </div>

                    <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
                        <h3 class="chart-pane-title">Total Conversions Data</h3>
                        <div style="height:240px;" id="transactionChartContent"><canvas id="transactionChart"></canvas></div>
                        <ul class="legend-static" id="transactionPeriodContent">
                            <li><span class="dot" style="background:var(--teal);"></span>Current Period</li>
                            <li><span class="dot" style="background:#F2A93B;"></span>Previous Period</li>
                        </ul>
                    </div>

                    <div class="tab-pane fade" id="sale" role="tabpanel" aria-labelledby="sale-tab">
                        <h3 class="chart-pane-title">Total Sales Data</h3>
                        <div style="height:240px;" id="saleChartContent"><canvas id="saleChart"></canvas></div>
                        <ul class="legend-static" id="salePeriodContent">
                            <li><span class="dot" style="background:var(--teal);"></span>Current Period</li>
                            <li><span class="dot" style="background:#F2A93B;"></span>Previous Period</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@push('extended_scripts')
    <script src="{{ asset('vendor_assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor_assets/js/charts.js') }}"></script>

    <script>
        function commissionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['commission']['commission'] ?? []);
                chartjsLineChartFive(
                    "commissionChart",
                    "#0F6E5F",
                    "45",
                    data,
                    labels,
                                            {{ $performanceOverview['commission']['min_value'] ?? 0 }},
                    {{ $performanceOverview['commission']['max_value'] ?? 0 }}
                );
                $("#commissionPeriodContent").html(`
                                        <li class="custom-label">
                                            <span style="background-color: var(--teal);"></span>Current Period
                                        </li>
                                    `)
            @else
                let currentMonth = @json($performanceOverview['commission']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['commission']['dailyPreviousMonth'] ?? []);
                chartjsLineChartFour(
                    "commissionChart",
                    "#0F6E5F",
                    "45",
                    currentMonth,
                    previousMonth,
                    labels,
                                            {{ $performanceOverview['commission']['min_value'] ?? 0 }},
                    {{ $performanceOverview['commission']['max_value'] ?? 0 }}
                );
            @endif
                    }


        function approvedcommissionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['approved']['commission'] ?? []);
                chartjsLineChartFive(
                    "approvedcommissionChart",
                    "#0F6E5F",
                    "45",
                    data,
                    labels,
                                            {{ $performanceOverview['approved']['min_value'] ?? 0 }},
                    {{ $performanceOverview['approved']['max_value'] ?? 0 }}
                );
                $("#approvedcommissionPeriodContent").html(`
                                        <li class="custom-label">
                                            <span style="background-color: var(--teal);"></span>Current Period
                                        </li>
                                    `)
            @else
                let currentMonth = @json($performanceOverview['approved']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['approved']['dailyPreviousMonth'] ?? []);
                chartjsLineChartFour(
                    "approvedcommissionChart",
                    "#0F6E5F",
                    "45",
                    currentMonth,
                    previousMonth,
                    labels,
                                            {{ $performanceOverview['approved']['min_value'] ?? 0 }},
                    {{ $performanceOverview['approved']['max_value'] ?? 0 }}
                );
            @endif
                    }


        function pendingcommissionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['pending']['commission'] ?? []);
                chartjsLineChartFive(
                    "pendingcommissionChart",
                    "#0F6E5F",
                    "45",
                    data,
                    labels,
                                            {{ $performanceOverview['pending']['min_value'] ?? 0 }},
                    {{ $performanceOverview['pending']['max_value'] ?? 0 }}
                );
                $("#pendingcommissionPeriodContent").html(`
                                        <li class="custom-label">
                                            <span style="background-color: var(--teal);"></span>Current Period
                                        </li>
                                    `)
            @else
                let currentMonth = @json($performanceOverview['pending']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['pending']['dailyPreviousMonth'] ?? []);
                chartjsLineChartFour(
                    "pendingcommissionChart",
                    "#0F6E5F",
                    "45",
                    currentMonth,
                    previousMonth,
                    labels,
                                            {{ $performanceOverview['pending']['min_value'] ?? 0 }},
                    {{ $performanceOverview['pending']['max_value'] ?? 0 }}
                );
            @endif
                    }


        function declinedcommissionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['declined']['commission'] ?? []);
                chartjsLineChartFive(
                    "declinedcommissionChart",
                    "#0F6E5F",
                    "45",
                    data,
                    labels,
                                            {{ $performanceOverview['declined']['min_value'] ?? 0 }},
                    {{ $performanceOverview['declined']['max_value'] ?? 0 }}
                );
                $("#declinedcommissionPeriodContent").html(`
                                        <li class="custom-label">
                                            <span style="background-color: var(--teal);"></span>Current Period
                                        </li>
                                    `)
            @else
                let currentMonth = @json($performanceOverview['declined']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['declined']['dailyPreviousMonth'] ?? []);
                chartjsLineChartFour(
                    "declinedcommissionChart",
                    "#0F6E5F",
                    "45",
                    currentMonth,
                    previousMonth,
                    labels,
                                            {{ $performanceOverview['declined']['min_value'] ?? 0 }},
                    {{ $performanceOverview['declined']['max_value'] ?? 0 }}
                );
            @endif
                    }


        function transactionChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['transaction']['transaction'] ?? []);
                chartjsLineChartFive(
                    "transactionChart",
                    "#0F6E5F",
                    "45",
                    data,
                    labels,
                                            {{ $performanceOverview['transaction']['min_value'] ?? 0 }},
                    {{ $performanceOverview['transaction']['max_value'] ?? 0 }}
                );
                $("#transactionPeriodContent").html(`
                                        <li class="custom-label">
                                            <span style="background-color: var(--teal);"></span>Current Period
                                        </li>
                                    `)
            @else
                let currentMonth = @json($performanceOverview['transaction']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['transaction']['dailyPreviousMonth'] ?? []);
                chartjsLineChartFour(
                    "transactionChart",
                    "#0F6E5F",
                    "45",
                    currentMonth,
                    previousMonth,
                    labels,
                                            {{ $performanceOverview['transaction']['min_value'] ?? 0 }},
                    {{ $performanceOverview['transaction']['max_value'] ?? 0 }}
                );
            @endif
                    }


        function saleChartLine() {
            let labels = @json($performanceOverview['extra']['labels'] ?? []);

            @if (request()->start_date && request()->end_date)
                let data = @json($performanceOverview['sale']['sale'] ?? []);
                chartjsLineChartFive(
                    "saleChart",
                    "#0F6E5F",
                    "45",
                    data,
                    labels,
                                            {{ $performanceOverview['sale']['min_value'] ?? 0 }},
                    {{ $performanceOverview['sale']['max_value'] ?? 0 }}
                );
                $("#salePeriodContent").html(`
                                        <li class="custom-label">
                                            <span style="background-color: var(--teal);"></span>Current Period
                                        </li>
                                    `)
            @else
                let currentMonth = @json($performanceOverview['sale']['dailyCurrentMonth'] ?? []);
                let previousMonth = @json($performanceOverview['sale']['dailyPreviousMonth'] ?? []);
                chartjsLineChartFour(
                    "saleChart",
                    "#0F6E5F",
                    "45",
                    currentMonth,
                    previousMonth,
                    labels,
                                            {{ $performanceOverview['sale']['min_value'] ?? 0 }},
                    {{ $performanceOverview['sale']['max_value'] ?? 0 }}
                );
            @endif
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