<?php

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
  $start_date = Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
  $end_date = Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');

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

?>

<?php if (! $__env->hasRenderedOnce('ffe2a2c3-97c6-443a-a800-e5dac3f97b96')): $__env->markAsRenderedOnce('ffe2a2c3-97c6-443a-a800-e5dac3f97b96');
$__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); endif; ?>


<?php if (! $__env->hasRenderedOnce('0f0c920d-9ffb-4f1b-a68e-eb1a9b1ebf8a')): $__env->markAsRenderedOnce('0f0c920d-9ffb-4f1b-a68e-eb1a9b1ebf8a');
$__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.pie.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>

  $(function () {
    'use strict'
    chart_graph('commission')
    //-------------------------------------------------------------//
    var pieData = <?php echo $pieJson; ?>;
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
      labels: <?php echo json_encode($labels); ?>,
      datasets: [{
        data: <?php echo json_encode($values); ?>,
        backgroundColor: ['#0F6E5F', '#F2A93B', '#E85D4C', '#141B29', '#5B6472']
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
    let start_date = $('#start_date').val();
    let end_date = $('#end_date').val();

    console.log(start_date);
    console.log(end_date);
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


  $('#chart_type').on('change', function () {
    let type = $(this).val();
    chart_graph(type);
  })

  function chart_graph(type) {

    if (type === 'transaction') {
      var dailyCurrentMonth = <?php echo json_encode($transaction['dailyCurrentMonth'], 15, 512) ?>;
      var dailyPreviousMonth = <?php echo json_encode($transaction['dailyPreviousMonth'], 15, 512) ?>;
      var max = <?php echo json_encode($transaction['max_value'], 15, 512) ?>;
      var min = <?php echo json_encode($transaction['min_value'], 15, 512) ?>;

    } else if (type === 'sale') {
      var dailyCurrentMonth = <?php echo json_encode($sale['dailyCurrentMonth'], 15, 512) ?>;
      var dailyPreviousMonth = <?php echo json_encode($sale['dailyPreviousMonth'], 15, 512) ?>;
      var max = <?php echo json_encode($sale['max_value'], 15, 512) ?>;
      var min = <?php echo json_encode($sale['min_value'], 15, 512) ?>;

    } else {
      var dailyCurrentMonth = <?php echo json_encode($commission['dailyCurrentMonth'], 15, 512) ?>;
      var dailyPreviousMonth = <?php echo json_encode($commission['dailyPreviousMonth'], 15, 512) ?>;
      var max = <?php echo json_encode($commission['max_value'], 15, 512) ?>;
      var min = <?php echo json_encode($commission['min_value'], 15, 512) ?>;
    }
    dailyCurrentMonth = normalizeData(dailyCurrentMonth);
    dailyPreviousMonth = normalizeData(dailyPreviousMonth);
    console.log(type);
    console.log('current');
    console.log(dailyCurrentMonth)
    console.log('Previous');
    console.log(dailyPreviousMonth);
    console.log(max)
    console.log(min)
    var currentMonthData = [];
    var previousMonthData = [];

    var currentMonthData = dailyCurrentMonth.map((v, i) => [i + 1, v]);
    var previousMonthData = dailyPreviousMonth.map((v, i) => [i + 1, v]);


    var days = Math.max(dailyCurrentMonth.length, dailyPreviousMonth.length);
    console.log(currentMonthData)
    console.log(previousMonthData)
    var plot = $.plot('#flotChart', [{
      label: "Current Month",
      data: currentMonthData,
      color: '#0F6E5F',
      lines: { fill: true }
    }, {
      label: "Previous Month",
      data: previousMonthData,
      color: '#F2A93B',
      lines: { fill: true }
    }], {
      series: {
        shadowSize: 0,
        lines: {
          show: true,
          lineWidth: 2,
          fill: true
        },
        points: { show: true }
      },
      grid: {
        borderWidth: 0,
        labelMargin: 35,
        minBorderMargin: 20,
        hoverable: true,
        clickable: true
      },
      yaxis: {
        show: true,
        tickDecimals: 0,
        tickColor: '#dedcdcff'
      },
      xaxis: {
        min: 0.5,
        max: days + 0.5,
        tickSize: 1,
        tickDecimals: 0,
        ticks: [...Array(days)].map((_, i) => i + 1),
        color: '#f5f5f5ff'
      }
    });

  }



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
    let start_date = urlParams.get(`start_date`);
    $('#start_date').val(start_date);
  }

  if (urlParams.has(`end_date`)) {
    let end_date = urlParams.get(`end_date`);
    $('#end_date').val(end_date);
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

<?php $__env->stopPush(); endif; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="h-100">
        <div class="row mb-3 pb-1">
            <div class="col-12">
                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
                        <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                    </div>
                    <div class="mt-3 mt-lg-0">
                        <form action="javascript:void(0);">
                            <div class="row g-3 mb-0 align-items-center">
                                <div class="col-sm-auto">
                                    <div class="input-group">
                                        <input type="text" class="form-control border-0 minimal-border dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                        <div class="input-group-text bg-primary border-primary text-white">
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <button type="button" class="btn btn-soft-success material-shadow-none"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <button type="button" class="btn btn-soft-info btn-icon waves-effect material-shadow-none waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
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
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Earnings</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-success fs-14 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="559.25">0</span>k </h4>
                                <a href="" class="text-decoration-underline">View net earnings</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle rounded fs-3">
                                    <i class="bx bx-dollar-circle text-success"></i>
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
                              <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Orders</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-danger fs-14 mb-0">
                                    <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="36894">0</span></h4>
                                <a href="" class="text-decoration-underline">View all orders</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle rounded fs-3">
                                    <i class="bx bx-shopping-bag text-info"></i>
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
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Customers</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-success fs-14 mb-0">
                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M </h4>
                                <a href="" class="text-decoration-underline">See details</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-warning-subtle rounded fs-3">
                                    <i class="bx bx-user-circle text-warning"></i>
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
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> My Balance</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="text-muted fs-14 mb-0">
                                    +0.00 %
                                </h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="165.89">0</span>k </h4>
                                <a href="" class="text-decoration-underline">Withdraw money</a>
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
</div>


<div id="tooltip" style="
    position:absolute;
    display:none;
    padding:6px 10px;
    background:#222;
    color:#fff;
    border-radius:4px;
    font-size:12px;
    pointer-events:none;
    z-index:9999;">
</div>


<!-- WELCOME HEADER + DATE RANGE FILTER -->
<div class="welcome-head">
  <div>
    <h2 class="font-display">Hi, welcome back!</h2>
    <p class="sub">Your ThousandsLink partnerships dashboard.</p>
  </div>

  <form class="date-filter-row" id="dateFilterForm">
    <div class="field">
      <label for="start_date">Start Date</label>
      <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo e($start_date); ?>">
    </div>
    <div class="field">
      <label for="end_date">End Date</label>
      <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo e($end_date); ?>">
    </div>
    <button type="submit" class="btn btn-primary" id="filterbtn">Filter</button>
  </form>
</div>

<!-- PERFORMANCE ANALYSIS SUB-NAV -->
<div class="dash-subnav">
  <nav class="tabs-left">
    <a class="active" href="#">Performance Analysis</a>
  </nav>

  <nav class="actions-right">
    <a href="javascript:void(0)" onclick="printPage()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z" />
        <path d="M17 21v-8H7v8M7 3v5h8" />
      </svg>
      Save Report
    </a>
    <a href="javascript:void(0)" onclick="exportPDF()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
        <path d="M14 2v6h6" />
        <path d="M9 15h1.5a1.5 1.5 0 0 0 0-3H9v5M13 12v5h1.3a1.7 1.7 0 0 0 0-5H13z" />
      </svg>
      Export to PDF
    </a>
  </nav>
</div>

<div class="row g-3 mb-3">

  
  <div class="col-6 col-lg-3">
    <div class="card stat-card">
      <div class="top">

        <span class="ico teal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 1v22M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
          </svg>
        </span>

        <?php if(isset($earningOverview['pending']['growth']) && $earningOverview['pending']['growth'] == "up"): ?>
          <span class="delta up">
            ↑ <?php echo e($earningOverview['pending']['percentage'] ?? '0%'); ?>

          </span>
        <?php else: ?>
          <span class="delta down">
            ↓ <?php echo e($earningOverview['pending']['percentage'] ?? '0%'); ?>

          </span>
        <?php endif; ?>

      </div>

      <div class="value font-display">
        <?php echo e($pendingCurrency === 'USD' ? "$" : $pendingCurrency); ?><?php echo e($pending); ?>

      </div>

      <div class="label">
        Awaiting Revenue
      </div>
    </div>
  </div>


  
  <div class="col-6 col-lg-3">
    <div class="card stat-card">
      <div class="top">

        <span class="ico amber">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 11 20 4l-4 17-5-7-8-3z" />
          </svg>
        </span>

        <?php if(isset($earningOverview['approved']['growth']) && $earningOverview['approved']['growth'] == "up"): ?>
          <span class="delta up">
            ↑ <?php echo e($earningOverview['approved']['percentage'] ?? '0%'); ?>

          </span>
        <?php else: ?>
          <span class="delta down">
            ↓ <?php echo e($earningOverview['approved']['percentage'] ?? '0%'); ?>

          </span>
        <?php endif; ?>

      </div>

      <div class="value font-display">
        <?php echo e($approvedCurrency === 'USD' ? "$" : $approvedCurrency); ?><?php echo e($approved); ?>

      </div>

      <div class="label">
        Approved Revenue
      </div>
    </div>
  </div>


  
  <div class="col-6 col-lg-3">
    <div class="card stat-card">
      <div class="top">

        <span class="ico ink">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20.6 12 12 20.6 3.4 12 12 3.4z" />
          </svg>
        </span>

        <?php if(isset($earningOverview['declined']['growth']) && $earningOverview['declined']['growth'] == "up"): ?>
          <span class="delta up">
            ↑ <?php echo e($earningOverview['declined']['percentage'] ?? '0%'); ?>

          </span>
        <?php else: ?>
          <span class="delta down">
            ↓ <?php echo e($earningOverview['declined']['percentage'] ?? '0%'); ?>

          </span>
        <?php endif; ?>

      </div>

      <div class="value font-display">
        <?php if(isset($earningOverview['declined']['commission_amount_currency'])): ?>
          <?php echo e($earningOverview['declined']['commission_amount_currency'] === 'USD' ? "$" : $earningOverview['declined']['commission_amount_currency']); ?>

          <?php echo e(isset($earningOverview['declined']['total_commission_amount']) ? number_format($earningOverview['declined']['total_commission_amount'], 2) : '0.00'); ?>

        <?php else: ?>
          $ 0.00
        <?php endif; ?>
      </div>

      <div class="label">
        Rejected Revenue
      </div>
    </div>
  </div>


  
  <div class="col-6 col-lg-3">
    <div class="card stat-card">
      <div class="top">

        <span class="ico coral">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="9" />
            <path d="M12 7v5l3 3" />
          </svg>
        </span>

        <span class="delta down">
          ↓ 0.86%
        </span>

      </div>

      <div class="value font-display">
        $ <?php echo e(number_format($earningOverview['paid_status'] ?? 0, 2)); ?>

      </div>

      <div class="label">
        Payouts
      </div>
    </div>
  </div>

</div>



<div class="ticket mb-3">

  <div class="perf"></div>

  <div style="max-width:66%;">

    <div class="eyebrow">
      Total Revenue · <?php echo e(date('F')); ?>

    </div>

    <div class="headline font-display">

      $ <?php echo e(number_format($performanceOverview['commission']['count'] ?? 0, 2)); ?>


      <span style="font-size:16px;color:#93A0B8;font-weight:500;">
        revenue this month
      </span>

    </div>

    <div class="sub">

      Total Sales:
      <strong>
        <?php echo e($performanceOverview['sale']['count'] ?? 0); ?>

      </strong>

      ·

      Total Conversions:
      <strong>
        <?php echo e($performanceOverview['transaction']['count'] ?? 0); ?>

      </strong>

    </div>
  </div>


  
  <div class="stub">

    <?php
      $growth = is_array($clickPercentage)
        ? ($clickPercentage['growth'] ?? '+')
        : '+';
    ?>

    <div class="num">
      <?php echo e($totalClicks); ?>

    </div>

    <div class="cap">
      Total Clicks
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-12">
    <div class="card card-pad h-100">
      <div class="perf"></div>
      <div style="width:100%;">
        <!-- Header -->
        <div style="display:flex;justify-content:space-between;align-items:flex-start; gap:20px;padding-bottom:8px;border-bottom: 1px solid #ececec">
        <div class="section-head" style="margin-bottom:16px;">
          <div>
            <h2>Sales Performance Metrics</h2>
            <div class="sub">Key sales statistics recorded within the selected date range.</div>
          </div>
        </div>
          <!-- Chart Type -->
          <select id="chart_type" class="form-select-sm" style="width:auto;">
            <option value="sale">Sales</option>
            <option selected value="commission">Revenue</option>
            <option value="transaction">Transactions</option>
          </select>
        </div>
        <!-- Summary -->
        <div class="sub" style="margin-top:8px;">
          <div class="d-flex gap-3">
            <div>
              <h6 class="font-display">Total Sales</h6>
              <span class="h4 font-display text-teal">
                $<?php echo e($performanceOverview['sale']['count'] ?? 0); ?>

              </span>
            </div>
            <div>
              <h6 class="font-display">Total Revenue</h6>
              <span class="h4 font-display text-teal">
                $<?php echo e($performanceOverview['commission']['count'] ?? 0); ?>

              </span>
            </div>
            <div>
              <h6 class="font-display">Total Conversions</h6>
              <span class="h4 font-display text-teal">
                <?php echo e($performanceOverview['transaction']['count'] ?? 0); ?>

                </strong>
            </div>
          </div>
        </div>
        <!-- MAIN CHART -->
        <div class="flot-chart-wrapper" style="margin-top:30px;">
          <div id="flotChart" class="flot-chart" style="padding:0;position:relative;width:100%;height:350px;">
          </div>
        </div>
      </div>
    </div><!-- row -->
  </div>
  <div class="col-lg-4">
    <div class="card card-pad">
      <div class="section-head" style="margin-bottom:16px;">
        <div>
          <h2>Top Highest-Performing Brands Driving</h2>
          <div class="sub">Most Sales</div>
        </div>
      </div>
      <?php if(count($topSales)): ?>
        <div id="flotPie" style="width: 100%;height:300px;"></div>
      <?php else: ?>
        <p style="text-align:center;">No enough data</p>
      <?php endif; ?>

    </div><!-- card -->

  </div><!-- col -->

  <div class="col-lg-8">
    <div class="card card-pad h-100">
      <div class="section-head">
        <h2>Brands Status Summary</h2>
      </div>
      <div class="row align-items-center">
        <div class="col-md-5 d-flex justify-content-center">
          <div class="donut-wrap" style="width:200px;height:200px;">
            <canvas id="chartDonut"></canvas>
            <div class="donut-center">
              <div class="n"><?php echo e($total); ?></div>
              <div class="l">Brands</div>
            </div>
          </div>
        </div>
        <div class="col-md-7 mt-4 mt-md-0">
          <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="status-detail-item">
            <div class="sdi-row">
              <span class="lbl"><?php echo e($label); ?></span>
              <span class="val"><?php echo e(number_format($values[$i])); ?><span class="pct">(<?php echo e($percentages[$i]); ?>%)</span></span>
            </div>
            <div class="progress-thin
            <?php if($i == 0): ?> c-teal
            <?php elseif($i == 1): ?> c-coral
            <?php elseif($i == 2): ?> c-amber
            <?php elseif($i == 3): ?> c-ink
            <?php else: ?> c-slate
            <?php endif; ?>"><span style="width:<?php echo e($percentages[$i]); ?>%;"></span></div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card card-pad h-100">
      <div class="section-head" style="margin-bottom:16px;">
        <div>
          <h2>Traffic &amp; Conversion Summary</h2>
          <div class="sub">A quick snapshot of clicks, transactions, and conversion rate.</div>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-12">
          <div class="metric-tile">
            <span class="mt-chart teal"><span style="height:60%;"></span><span style="height:40%;"></span><span
                style="height:70%;"></span><span style="height:50%;"></span><span style="height:70%;"></span></span>
            <div class="mt-body">
              <label>Transactions</label>
              <h4><?php echo e($performanceOverview['transaction']['count'] ?? 0); ?></h4>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="metric-tile">
            <span class="mt-chart ink"><span style="height:60%;"></span><span style="height:70%;"></span><span
                style="height:90%;"></span><span style="height:40%;"></span><span style="height:80%;"></span></span>
            <div class="mt-body">
              <label>Total Clicks</label>
              <h4><?php echo e($totalClicks); ?></h4>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="metric-tile">
            <span class="mt-chart amber"><span style="height:70%;"></span><span style="height:40%;"></span><span
                style="height:50%;"></span><span style="height:70%;"></span><span style="height:20%;"></span></span>
            <div class="mt-body">
              <label>Conversion Rate</label>
              <h4><?php echo e($CVR_display); ?>%</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-8 col-xl-8">
    <div class="card">
      <div class="card-pad pb-0">
        <div class="section-head">
          <div>
            <h2>Brands Performance Summary</h2>
            <div class="sub">This table summarizes key performance indicators for each advertiser, including Total Sales, Revenue Earned, Transaction Volume, and Conversion Rate.</div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table mb-0">
          <thead>
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
            <?php if(count($topClicks)): ?>
              <?php $__currentLoopData = $topClicks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topClick): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($topClick['advertiser']['sid'])): ?>
                  <?php
                    $transactions = App\Models\Transaction::select(Illuminate\Support\Facades\DB::raw('SUM(sale_amount) as total_sales_amount, SUM(commission_amount) as total_commission_amount, COUNT(*) as total_count'))
                      ->where('publisher_id', auth()->user()->id)
                      ->where('advertiser_id', $topClick['advertiser']['advertiser_id'])
                      ->first();
                    $total_transactions = $transactions->total_count ?? 0;
                    $total_Clicks = $topClick['tracking'] ?? 0;
                    $CVR = ($total_transactions / $total_Clicks) * 100;
                    $CVR_display = number_format($CVR, 2);
                  ?>
                  <tr>
                    <td><a href="<?php echo e(route("publisher.view-advertiser", ['sid' => $topClick['advertiser']['sid']])); ?>" class="fw-semibold" style="color:var(--teal-deep);"><?php echo e($topClick['advertiser']['name']); ?></a></td>
                    <td class="font-mono">$ <?php echo e(number_format($transactions->total_sales_amount, 0) ?? 0); ?></td>
                    <td class="font-mono">$ <?php echo e(number_format($transactions->total_commission_amount, 2) ?? 0); ?></td>
                    <td class="font-mono"><?php echo e($transactions->total_count ?? 0); ?></td>
                    <td class="font-mono"><?php echo e($topClick['tracking'] ?? 0); ?></td>
                    <td class="font-mono" style="text-align:center;"><?php echo e($CVR_display); ?>%</td>
                  </tr>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
              <tr>
                <td colspan="6" style="text-align:center;">No enough data</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- RECENTLY APPROVED BRANDS -->
  <div class="col-lg-12">
    <div class="card h-100">
      <div class="card-pad pb-0">
        <div class="section-head">
          <div>
            <h2>Recently Approved Brands</h2>
            <div class="sub">Newest approved partnerships</div>
          </div>
        </div>
      </div>
      <?php echo $__env->make("template.publisher.advertisers.advertiser-list", compact('advertisers'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </div>
</div><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/dashboard/app.blade.php ENDPATH**/ ?>