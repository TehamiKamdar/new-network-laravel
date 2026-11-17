<?php if (! $__env->hasRenderedOnce('741912c7-d357-4bd8-b00f-1974db644213')): $__env->markAsRenderedOnce('741912c7-d357-4bd8-b00f-1974db644213');
$__env->startPush('styles'); ?>

<style>
    
.form-section-title{
    font-size: 18px !important;
}
</style>

<?php $__env->stopPush(); endif; ?>

<?php if (! $__env->hasRenderedOnce('7739f20d-5721-45c9-adce-9b13b71ea7f9')): $__env->markAsRenderedOnce('7739f20d-5721-45c9-adce-9b13b71ea7f9');
$__env->startPush('scripts'); ?>
<script src="<?php echo e(\App\Helper\Static\Methods::staticAsset("vendor_assets/js/drawer.js")); ?>"></script>
<script>
    function clickToCopy(id, msg) {
        copyToClipboard(document.getElementById(id))
        normalMsg({ "message": msg, "success": true });
    }
    function prepareVoucherFormContent(id) {
        $.ajax({
            url: `/publisher/creatives/coupons/${id}`,
            type: 'GET',
            success: function (response) {
                $("#voucherModalContent").html(response)
            },
            error: function (response) {

            }
        });
    }
    function changeLimit() {
        $.ajax({
            url: '<?php echo e(route("publisher.set-limit")); ?>',
            type: 'GET',
            data: { "limit": $("#limit").val(), "type": "coupon" },
            success: function (response) {
                if (response) {
                    window.location.reload();
                }
            },
            error: function (response) {

            }
        });
    }
    function fetch_data(page = 1) {
        $.ajax({
            url: '<?php echo e(route("publisher.creatives.coupons.list")); ?>',
            type: 'GET',
            data: { "search_by_name": "<?php echo e($advertiser->advertiser_id); ?>", page },
            beforeSend: function () {
            },
            success: function (response) {
                $("#ap-overview").html(response.html);
                $("#limit").change(function () {
                    changeLimit();
                });
                $("#loading").removeClass('d-flex', true);
                $("#loading").addClass('d-none');
            },
            error: function (response) {

            }
        });
    }
    document.addEventListener("DOMContentLoaded", function () {
        $(document).on('click', '.atbd-pagination__item a', function (event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });
        $("#coupons-tab").one("click", function () {
            fetch_data();

        });
        $("#applyAdvertiser").submit(function () {
            $("#applyAdvertiserBttn").prop('disabled', true);
        });
        const sidebarTabs = document.querySelectorAll('#sidebarTabs .list-group-item');
        const tabContent = document.getElementById('profileTabContent');

        tabContent.addEventListener('shown.bs.tab', function (event) {
            const targetId = event.target.getAttribute('data-bs-target');

            // Remove active class from all tabs
            sidebarTabs.forEach(tab => {
                tab.classList.remove('active');
            });

            // Add active class to corresponding sidebar tab
            const activeTab = document.querySelector(`#sidebarTabs a[data-bs-target="${targetId}"]`);
            if (activeTab) {
                activeTab.classList.add('active');
            }
        });

        // Initialize first tab as active
        const firstTab = document.querySelector('#sidebarTabs .list-group-item:first-child');
        if (firstTab) {
            firstTab.classList.add('active');
        }
    });
</script>
<?php $__env->stopPush(); endif; ?>

<?php $__env->startSection("content"); ?>
    <div class="row g-3">
        <!-- ============ LEFT: summary + settings nav ============ -->
        <div class="col-lg-3">
            <div class="card filter-sticky">
                <div class="profile-summary" style="border-bottom:1px solid var(--line);">
                    <div class="avatar">
                        <?php if(!empty($advertiser->fetch_logo_url)): ?>
                            <img loading="lazy" src="<?php echo e($advertiser->fetch_logo_url); ?>" alt="<?php echo e($advertiser->name); ?>">
                        <?php elseif(!empty($advertiser->logo)): ?>
                            <img src="<?php echo e(\App\Helper\Static\Methods::staticAsset("$advertiser->logo")); ?>"
                                alt="<?php echo e($advertiser->name); ?>">
                        <?php else: ?>
                            <img loading="lazy" src="<?php echo e(\App\Helper\Static\Methods::isImageShowable($advertiser->logo)); ?>"
                                alt="<?php echo e($advertiser->name); ?>">
                        <?php endif; ?>
                    </div>
                    <h3><?php echo e($advertiser->name); ?></h3>
                    <div class="my-3">

                        <p>ID: <?php echo e($advertiser->sid); ?> · Commission:
                            <?php echo e($advertiser->commission); ?><?php echo e($advertiser->commission_type == "percentage" ? "%" : $advertiser->commission_type); ?>

                        </p>

                        <p>Payout: <?php echo e($advertiser->average_payment_time ?? "30"); ?> days ·
                            Region: <?php
                                $regions = $advertiser->primary_regions ?? [];
                                if (count($regions) > 1) {
                                    $regions = "Multi";
                                } elseif (count($regions) == 1 && $regions[0] == "00") {
                                    $regions = "All";
                                } elseif (count($regions) == 1) {
                                    $regions = $regions[0] . " Region ";
                                } else {
                                    $regions = "Region Data is not available";
                                }
                            ?>
                            <?php echo e($regions); ?>

                        </p>
                    </div>
                    <?php if(isset($advertiser->advertiser_applies->status) && $advertiser->advertiser_applies->status == \App\Models\AdvertiserApply::STATUS_PENDING): ?>

                        <button type="button" class="btn btn-warning status-btn" disabled>
                            <i class="fas fa-clock color-white me-2"></i> Pending
                        </button>

                    <?php elseif(isset($advertiser->advertiser_applies->status) && $advertiser->advertiser_applies->status == \App\Models\AdvertiserApply::STATUS_ACTIVE): ?>

                        <button type="button" class="btn btn-success status-btn" disabled>
                            <i class="fas fa-check color-white me-2"></i> Joined
                        </button>

                    <?php elseif(isset($advertiser->advertiser_applies->status) && $advertiser->advertiser_applies->status == \App\Models\AdvertiserApply::STATUS_REJECTED): ?>

                        <button type="button" class="btn btn-danger status-btn" disabled>
                            <i class="fas fa-times color-white me-2"></i> Rejected
                        </button>

                    <?php elseif(isset($advertiser->advertiser_applies->status) && $advertiser->advertiser_applies->status == \App\Models\AdvertiserApply::STATUS_HOLD): ?>

                        <button type="button" class="btn btn-secondary status-btn" disabled>
                            <i class="fas fa-stop-circle color-white me-2"></i> Hold
                        </button>

                    <?php else: ?>

                        <button type="button" class="btn btn-primary status-btn" data-bs-toggle="modal"
                            data-bs-target="#modal-basic">
                            <i class="fas fa-paper-plane me-2"></i> Apply
                        </button>

                    <?php endif; ?>
                    <!-- Profile Acoount End -->
                </div>
                <div class="settings-nav" id="profileTabs" role="tablist">
                    <a class="settings-pill active" id="intro-tab" data-bs-toggle="tab" data-bs-target="#intro"
                        role="tab" aria-controls="intro">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <circle cx="12" cy="8" r="4" />
                            <path d="M4 21c1.6-4 6-6 8-6s6.4 2 8 6" />
                        </svg> Profile
                    </a>

                    <a class="settings-pill" id="rules-tab" data-bs-toggle="tab" data-bs-target="#rules" role="tab"
                        aria-controls="rules">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <circle cx="12" cy="12" r="9" />
                            <path d="m5.5 5.5 13 13" />
                        </svg> Rules
                    </a>

                    <?php if(isset($advertiser->advertiser_applies->status) && $advertiser->advertiser_applies->status == \App\Models\AdvertiserApply::STATUS_ACTIVE): ?>
                        <a class="settings-pill" id="links-tab" data-bs-toggle="tab" data-bs-target="#links" role="tab"
                            aria-controls="links">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                <path d="M10 13a5 5 0 0 0 7.5.5l2-2a5 5 0 0 0-7-7l-1 1" />
                                <path d="M14 11a5 5 0 0 0-7.5-.5l-2 2a5 5 0 0 0 7 7l1-1" />
                            </svg> Links
                        </a>
                    <?php endif; ?>

                    <?php if(isset($advertiser->advertiser_applies->status) && $advertiser->advertiser_applies->status == \App\Models\AdvertiserApply::STATUS_ACTIVE): ?>
                        <a class="settings-pill" id="coupons-tab" data-bs-toggle="tab" data-bs-target="#coupons" role="tab"
                            aria-controls="coupons">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                <path d="M12 2 2 12l9 9a2 2 0 0 0 2.8 0l7.2-7.2a2 2 0 0 0 0-2.8L12 2z" />
                                <path d="M7 7h.01" />
                            </svg> Offers
                        </a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="tab-content p-0" id="profileTabContent">
                <!-- Intro Tab -->
                <div class="tab-pane fade show active" id="intro" role="tabpanel">
                    <div class="card card-pad">
                            <h4 class="form-section-title">About <?php echo e($advertiser->name); ?></h4>
                            <?php if($advertiser->short_description): ?>
                                <p class="text-secondary">
                                    <?php echo $advertiser->short_description; ?>

                                </p>
                            <?php elseif($advertiser->description): ?>
                                <p class="text-secondary">
                                    <?php echo $advertiser->description; ?>

                                </p>
                            <?php else: ?>
                                <p class="text-secondary">No description</p>
                            <?php endif; ?>

                            <div class="border-top pt-4">
                                <h4 class="form-section-title mb-3">Categories</h4>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php if($advertiser->categories): ?>
                                        <?php $__currentLoopData = \App\Helper\PublisherData::getMixNames($advertiser->categories); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="li-none badge bg-primary p-2 rounded-pill" style="font-size:90%;">
                                                <?php echo e($category); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <span class="li-none badge bg-teal py-2 px-3 rounded-pill" style="font-size:90%;">
                                            No Categories to show
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="border-top pt-4 mt-4">
                                <h4 class="form-section-title mb-3">
                                    <i class="fas fa-address-card me-2 text-primary"></i>
                                    Contact Information
                                </h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light p-2 me-3">
                                                <i class="fas fa-envelope text-primary"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Email</small>
                                                <strong><?php echo e($advertiser->user->email ?? "-"); ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light p-2 me-3">
                                                <i class="fas fa-globe text-primary"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Website</small>
                                                <strong><?php echo $url; ?></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light p-2 me-3">
                                                <i class="fas fa-clock text-primary"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Response Time</small>
                                                <strong>Within 24-48 hours</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <!-- Commission Rates Tab -->
                <div class="tab-pane fade w-100" id="commission" role="tabpanel">
                    <div class="card card-pad">
                            <h4 class="form-section-title mb-3">Commission Structure</h4>
                            <p class="text-secondary mb-4">Our commission rates vary based on product
                                category and performance tiers.</p>

                            <div class="table-responsive">
                                <table class="table table-hover table-primary">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Condition</th>
                                            <th class="text-center">Commission Rate</th>
                                            <th>Additional info</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($advertiser->commissions)): ?>
                                            <?php $__currentLoopData = $advertiser->commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <?php if(empty($commission->date)): ?>
                                                        <td><?php echo e(now()->format("Y-m-d")); ?></td>
                                                    <?php else: ?>
                                                        <td><?php echo e($commission->date); ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo e($commission->condition ?? "-"); ?></td>
                                                    <td class="text-center fw-bold">
                                                        <?php echo e($commission->rate ?? "-"); ?><?php echo e($commission->type == "amount" ? $advertiser->currency_code : "%"); ?>

                                                    </td>
                                                    <td><?php echo e($commission->info ?? "-"); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr>
                                                <td class="text-center py-4" colspan="4">
                                                    <div class="text-muted">
                                                        <i class="fas fa-info-circle me-2"></i>
                                                        No Commission Rates Exist
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>

                <!-- Terms Tab -->
                <div class="tab-pane fade" id="terms" role="tabpanel">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h4 class="form-section-title mb-3">Program Terms</h4>
                            <div class="bg-light p-4">
                                <?php echo $advertiser->program_policies ?? "-"; ?>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rules Tab -->
                <div class="tab-pane fade" id="rules" role="tabpanel">
                    <div class="card card-pad">
                            <div class="mb-3">
                                <h4 class="form-section-title">Preferred Promotional Methods</h4>
                                <small class="text-muted">Promotional Traffic from these sources is allowed:</small>
                            </div>
                            <div class="bg-light p-4 mb-5">
                                <?php $__empty_1 = true; $__currentLoopData = \App\Helper\PublisherData::getMixNames($advertiser->promotional_methods ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-3"></i>
                                        <span><?php echo e($method); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="text-muted">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No Method Found.
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <h4 class="form-section-title">Restricted Promotional Methods</h4>
                                <small class="text-muted">Promotional Traffic from these sources are strictly not allowed:</small>
                            </div>
                            <div class="bg-light p-4">
                                <?php $__empty_1 = true; $__currentLoopData = \App\Helper\PublisherData::getMixNames($advertiser->program_restrictions ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-times-circle text-danger me-3"></i>
                                        <span><?php echo e($method); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="text-muted">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No Method Found.
                                    </div>
                                <?php endif; ?>
                            </div>
                    </div>
                </div>

                <?php if(isset($advertiser->advertiser_applies->status) && $advertiser->advertiser_applies->status == \App\Models\AdvertiserApply::STATUS_ACTIVE): ?>
                    <div class="tab-pane fade" id="links" role="tabpanel">
                        <div class="card card-pad">
                                <h4 class="fw-bold mb-4">Links</h4>

                                <!-- Tracking Link Card -->
                                <div class="mb-5">
                                    <h4 class="form-section-title mb-3">Tracking Link</h4>
                                    <?php if(isset($advertiser->advertiser_applies->is_tracking_generate) && isset($advertiser->advertiser_applies->tracking_url) && $advertiser->advertiser_applies->is_tracking_generate == 1): ?>
                                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 mb-3">
                                            <div class="flex-grow-1">
                                                <a href="<?php echo e($advertiser->advertiser_applies->tracking_url_long ?? $advertiser->advertiser_applies->tracking_url); ?>"
                                                    target="_blank" id="trackingURL"
                                                    class="form-control">
                                                    <?php echo e($advertiser->advertiser_applies->tracking_url_long ?? $advertiser->advertiser_applies->tracking_url); ?>

                                                </a>
                                            </div>
                                            <button onclick="clickToCopy('trackingURL', 'Tracking URL Successfully Copied.')" class="btn btn-primary">
                                                Copy Link
                                            </button>
                                        </div>
                                    <?php elseif(isset($advertiser->advertiser_applies->is_tracking_generate) && $advertiser->advertiser_applies->is_tracking_generate == 2): ?>
                                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 mb-3">
                                            <div class="bg-light p-3 flex-grow-1">
                                                <span class="text-muted">
                                                    <i class="fas fa-spinner fa-spin me-2"></i>
                                                    Wait! Generating tracking links...
                                                </span>
                                            </div>
                                            <button class="btn btn-secondary" disabled>
                                                Copy Link
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <div class="bg-light p-4 text-center">
                                            <span class="text-muted">No tracking link available</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Short Tracking Link Card -->
                                <div class="mb-5">
                                    <h4 class="form-section-title mb-3">Short Tracking Link</h4>
                                    <?php if(isset($advertiser->advertiser_applies->is_tracking_generate) && isset($advertiser->advertiser_applies->tracking_url_short) && $advertiser->advertiser_applies->is_tracking_generate == 1): ?>
                                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                                            <div class="flex-grow-1">
                                                <a href="<?php echo e($advertiser->advertiser_applies->tracking_url_short); ?>"
                                                    id="trackingShortURL" target="_blank"
                                                    class="form-control">
                                                    <?php echo e($advertiser->advertiser_applies->tracking_url_short); ?>

                                                </a>
                                            </div>
                                            <button
                                                onclick="clickToCopy('trackingShortURL', 'Tracking Short URL Successfully Copied.')"
                                                class="btn btn-primary">
                                                Copy Short Link
                                            </button>
                                        </div>
                                    <?php elseif(isset($advertiser->advertiser_applies->is_tracking_generate) && $advertiser->advertiser_applies->is_tracking_generate == 2): ?>
                                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">
                                            <div class="bg-light p-3 flex-grow-1">
                                                <span class="text-muted">
                                                    <i class="fas fa-spinner fa-spin me-2"></i>
                                                    Wait! Generating short tracking links...
                                                </span>
                                            </div>
                                            <button class="btn btn-secondary" disabled>
                                                Copy Short Link
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <div class="bg-light p-4 text-center">
                                            <span class="text-muted">No short tracking link available</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-5">
                                    <h4 class="form-section-title mb-3">Deeplink Generator</h4>
                                    <?php echo $__env->make('template.publisher.widgets.deeplink', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(isset($advertiser->advertiser_applies->status) && $advertiser->advertiser_applies->status == \App\Models\AdvertiserApply::STATUS_ACTIVE): ?>
                    <div class="tab-pane fade" id="coupons" role="tabpanel">
                        <div id="loading" class="d-flex justify-content-center align-items-center py-5">

                            <h6>Loading Offers...</h6>
                        </div>
                        <div id="ap-overview">
                            <!-- Offers content will be loaded here -->
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <div class="modal-basic modal fade" id="modal-basic" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="<?php echo e(route('publisher.apply-advertiser')); ?>" method="POST" id="applyAdvertiser">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="a_id" value="<?php echo e($advertiser->sid); ?>">
                <input type="hidden" name="a_name" value="<?php echo e($advertiser->name); ?>">

                <div class="modal-content modal-bg-white">
                    <div class="modal-header">
                        <h5 class="modal-title">Apply to Program</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Advertiser Info -->
                        <div class="mb-3">
                            <h5 class="mb-1"><?php echo e($advertiser->name); ?></h5>
                            <span class="text-muted fs-14">Brand ID: <?php echo e($advertiser->sid); ?></span>
                        </div>

                        <!-- Extra Details -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="info-box py-2 px-3 border rounded">
                                    <div class="info-label text-muted fs-13">Commission Rate</div>
                                    <div class="info-value fw-600 text-success">
                                        <?php echo e($advertiser->commission); ?>

                                        <?php echo e(str_contains($advertiser->commission, '%') ? '' : ($advertiser->commission_type == 'percentage' ? '%' : $advertiser->commission_type)); ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-box py-2 px-3 border rounded">
                                    <div class="info-label text-muted fs-13">Payout Time</div>
                                    <div class="info-value fw-600">
                                        <?php echo e($advertiser->average_payment_time ?? 30); ?> days
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-box py-2 px-3 border rounded">
                                    <div class="info-label text-muted fs-13">Regions</div>
                                    <div class="info-value">

                                        <?php
                                            $regions = $advertiser->primary_regions ?? [];
                                        ?>

                                        <?php if(count($regions) > 1): ?>
                                            <span class="badge bg-primary">Multi-Region</span>
                                        <?php elseif(count($regions) == 1 && $regions[0] == "00"): ?>
                                            <span class="badge bg-success">Global</span>
                                        <?php elseif(count($regions) == 1): ?>
                                            <span class="fi fi-<?php echo e(strtolower($regions[0])); ?> me-1"></span>
                                            <?php echo e($regions[0]); ?>

                                        <?php else: ?>
                                            <span class="text-muted">Not Available</span>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label class="fw-600 mb-1">
                                Promotional Plan <span class="text-muted fs-12">(Optional)</span>
                            </label>
                            <textarea class="form-control" rows="4" name="message"
                                placeholder="Websites, traffic sources, PPC terms, social media, etc."></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Apply Now
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- .atbd-drawer -->
    
    <div class="overlay-dark"></div>
    <div class="overlay-dark-l2"></div>
    <!-- ends: .atbd-drawer -->




    

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.publisher.publisher_panel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/advertisers/detail.blade.php ENDPATH**/ ?>