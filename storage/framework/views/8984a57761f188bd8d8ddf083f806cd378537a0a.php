<aside class="app-sidebar">
    <div class="sidebar-brand">
        <a href="<?php echo e(route("dashboard", ["type" => "partner"])); ?>"><img src="<?php echo e(asset('img/logo.png')); ?>" height="30"></a>
    </div>

    <nav class="sidebar-nav">
        <a class="nav-link <?php echo e(\App\Helper\PublisherData::isDashboardActive()); ?>" href="<?php echo e(route("dashboard", ["type" => "partner"])); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M3 10.5 12 3l9 7.5" />
                <path d="M5 9.5V21h14V9.5" />
            </svg>
            Dashboard
        </a>

        <button class="nav-link nav-toggle <?php echo e(\App\Helper\PublisherData::isAdvertiserActive()); ?>" data-bs-toggle="collapse" data-bs-target="#brandsSub" aria-expanded="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M20.6 12 12 20.6 3.4 12 12 3.4z" />
                <circle cx="12" cy="12" r="2" />
            </svg>
            Brands
            <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </button>
        <div class="collapse nav-sub <?php echo e(\App\Helper\PublisherData::isAdvertiserSubActive()); ?>" id="brandsSub">
            <a href="<?php echo e(route("publisher.find-advertisers")); ?>">All Brands</a>
            <a href="<?php echo e(route("publisher.find-advertisers")); ?>?section=new">Latest</a>
            <a href="<?php echo e(route("publisher.own-advertisers")); ?>">Active Brands</a>
        </div>

        <button class="nav-link nav-toggle <?php echo e(\App\Helper\PublisherData::isCreativeActive()); ?>" data-bs-toggle="collapse" data-bs-target="#campaignsSub"
            aria-expanded="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M3 11 20 4l-4 17-5-7-8-3z" />
            </svg>
            Campaigns
            <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </button>
        <div class="collapse nav-sub <?php echo e(\App\Helper\PublisherData::isCreativeSubActive()); ?>" id="campaignsSub">
            <a href="<?php echo e(route("publisher.creatives.coupons.list")); ?>" class="<?php echo e(\App\Helper\PublisherData::isCreativeOffersActive()); ?>">Offers</a>
            <a href="<?php echo e(route("publisher.creatives.text-links.list")); ?>" class="<?php echo e(\App\Helper\PublisherData::isCreativeLinksActive()); ?>">Affiliate Links</a>
        </div>
        <button class="nav-link nav-toggle <?php echo e(\App\Helper\PublisherData::isReportActive()); ?>" data-bs-toggle="collapse" data-bs-target="#analyticsSub"
            aria-expanded="false">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M4 20V10M12 20V4M20 20v-7" />
            </svg>
            Analytics
            <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
            </svg>
        </button>
        <div class="collapse nav-sub <?php echo e(\App\Helper\PublisherData::isReportSubActive()); ?>" id="analyticsSub">
            <a href="<?php echo e(route("publisher.reports.performance-by-transactions.list")); ?>" class="<?php echo e(\App\Helper\PublisherData::isReportTransactionActive()); ?>">Reports</a>
            <a href="<?php echo e(route("publisher.reports.transactions.list")); ?>" class="<?php echo e(\App\Helper\PublisherData::isReportConversionActive()); ?>">All Conversions</a>
        </div>
        <a class="nav-link <?php echo e(\App\Helper\PublisherData::isPaymentActive()); ?>" href="<?php echo e(route("publisher.payments.index")); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <rect x="3" y="6" width="18" height="13" rx="2" />
                <path d="M3 10h18" />
                <circle cx="16" cy="14" r="1.3" fill="currentColor" stroke="none" />
            </svg>
            Payments
        </a>
    </nav>

    <div class="sidebar-foot">
        <div class="plan-card">
            <strong>Payout runs on Sept 1</strong>
            Next scheduled settlement for 6 active brands.
        </div>
    </div>
</aside><?php /**PATH D:\pub.thousandslink.com\resources\views/partial/publisher/aside.blade.php ENDPATH**/ ?>