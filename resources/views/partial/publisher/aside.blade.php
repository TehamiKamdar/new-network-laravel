<div id="scrollbar">
    <div class="container-fluid">


        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route("dashboard", ["type" => "partner"]) }}">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                </a>
            </li> <!-- end Dashboard Menu -->
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarBrands" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarBrands">
                    <i class="ri-store-2-line"></i> <span data-key="t-apps">Brands Portfolio</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarBrands">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route("publisher.find-advertisers") }}" class="nav-link">
                                My Brands
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("publisher.find-advertisers") }}?section=new" class="nav-link" data-key="t-main-calender">
                                Latest Brands </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("publisher.own-advertisers") }}" class="nav-link" data-key="t-month-grid"> Active
                                Brands </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarCreatives" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarCreatives">
                    <i class="ri-coupon-3-line"></i> <span data-key="t-apps">Creative Offers</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarCreatives">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route("publisher.creatives.coupons.list") }}" class="nav-link">
                                Coupons
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("publisher.creatives.text-links.list") }}" class="nav-link"
                                data-key="t-main-calender">
                                Affiliate Links </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarReports" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarReports">
                    <i class="ri-bar-chart-grouped-line"></i> <span data-key="t-apps">Reports & Analytics</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarReports">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route("publisher.reports.performance-by-transactions.list") }}"
                                class="nav-link">
                                Revenue Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("publisher.reports.transactions.list") }}" class="nav-link"
                                data-key="t-main-calender">
                                Conversion Reports </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{ route("publisher.payments.index") }}">
                    <i class="ri-bank-card-line"></i> <span data-key="t-apps">Payments</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>

<div class="sidebar-background"></div>