 @php
    $notificationsCount = \App\Helper\Static\Methods::newNotificationCount();
@endphp

@if($notificationsCount == 0)
    <style>
        .navbar-right__menu .nav-notification .nav-item-toggle:before {
            background: unset;
        }
    </style>
@endif
 <div class="az-header">
      <div class="container">
        <div class="az-header-left">
          <a href="{{ route("dashboard", ["type" => "partner"]) }}" class="az-logo"><span></span> <img src="{{ asset('img/logo.png') }}" style="width: 200px;height: 40px;margin-top: 10px;"></a>
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
          <div class="az-header-menu-header">
            <a href="{{ route("dashboard", ["type" => "partner"]) }}" class="az-logo"><span></span> <img src="{{ asset('img/logo.png') }}" style="width: 200px;height: 40px;margin-top: 10px;"></a>
            <a href="" class="close">&times;</a>
          </div><!-- az-header-menu-header -->
          <ul class="nav">
            <li class="nav-item {{ \App\Helper\PublisherData::isDashboardActive() }}">
              <a href="{{ route("dashboard", ["type" => "partner"]) }}" class="nav-link {{ \App\Helper\PublisherData::isDashboardActive() }}"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
            </li>
            <li class="nav-item {{ \App\Helper\PublisherData::isAdvertiserActive() }}">
              <a href="" class="nav-link with-sub {{ \App\Helper\PublisherData::isAdvertiserActive() }}"><i class="typcn typcn-shopping-cart"></i>Brands</a>
              <nav class="az-menu-sub">
                <a href="{{ route("publisher.brand-analytics") }}" class="nav-link">Brand Insights</a>
                <a href="{{ route("publisher.find-advertisers") }}" class="nav-link">All Brands</a>
                <a href="{{ route("publisher.find-advertisers") }}?section=new" class="nav-link">Latest Brands</a>
                <a href="{{ route("publisher.own-advertisers") }}" class="nav-link">Approved Brands</a>
              </nav>
            </li>

           


             <li class="nav-item {{ \App\Helper\PublisherData::isCreativeActive() }}">
              <a href="" class="nav-link with-sub {{ \App\Helper\PublisherData::isCreativeActive() }}"><i class="typcn typcn-link-outline"></i>Campaign Materials</a>
              <nav class="az-menu-sub">
                <a href="{{ route("publisher.creatives.coupons.list") }}" class="nav-link">Special Offers</a>
                <a href="{{ route("publisher.creatives.text-links.list") }}" class="nav-link">Affiliate Links</a>
              </nav>
            </li>

             <li class="nav-item {{ \App\Helper\PublisherData::isReportActive() }}">
              <a href="" class="nav-link with-sub {{ \App\Helper\PublisherData::isReportActive() }}"><i class="typcn typcn-chart-pie"></i>Analytics</a>
              <nav class="az-menu-sub">
                <a href="{{ route("publisher.reports.performance-by-transactions.list") }}" class="nav-link">Analytical Report</a>
                <a href="{{ route("publisher.reports.transactions.list") }}" class="nav-link">All Conversions</a>
               
              </nav>
            </li>

            <li class="nav-item {{ \App\Helper\PublisherData::isPaymentActive() }}">
              <a href="{{ route("publisher.payments.index") }}" class="nav-link"><i class="typcn typcn-input-checked-outline"></i>Payouts</a>
            </li>
          </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
     
          <div class="dropdown az-header-notification">
            <a href="" class="new"><i class="typcn typcn-bell"></i></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header mg-b-20 d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              
              <h6 class="az-notification-title">Notifications</h6>
               @if($notificationsCount)
                                   <p class="az-notification-text" style="color:red;font-weight:500;">You have {{ $notificationsCount }} unread notification</p>
                                @endif
              <div class="az-notification-list">
                @foreach(\App\Helper\Static\Methods::getNotifications() as $notification)
                <div class="media new">
                 
                  <div class="media-body">
                    <a href="{{ route("publisher.notification-center.show", $notification->id) }}" class="subject stretched-link text-truncate-custom">
                                                    {{ $notification->notification_header }}
                                                </a>
                    <span class="time-posted">{{ $notification->created_at->diffForHumans() }}</span>
                  </div><!-- media-body -->
                </div><!-- media -->
                @endforeach
              </div><!-- az-notification-list -->
              <div class="dropdown-footer"><a href="{{ route("publisher.notification-center.index") }}">View All Notifications</a></div>
            </div><!-- dropdown-menu -->
          </div><!-- az-header-notification -->
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user"><img src="{{ \App\Helper\Static\Methods::staticAsset(isset($publisher->image) && $publisher->image ? $publisher->image : "img/blank_profile_img.png") }}" alt=""></a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="{{ \App\Helper\Static\Methods::staticAsset(isset($publisher->image) && $publisher->image ? $publisher->image : "img/blank_profile_img.png") }}" alt="">
                </div><!-- az-img-user -->
                <h6>{{ auth()->user()->user_name }}</h6>
                <span>({{ auth()->user()->sid }})</span>
              </div><!-- az-header-profile -->

             
              <a href="{{ route("publisher.profile.basic-information.index") }}" class="dropdown-item"><i class="typcn typcn-edit"></i>Profile Setting</a>
           
                                
              <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="dropdown-item">
                                   <i class="typcn typcn-power-outline"></i> Sign Out</a>
                                    <form id="logoutform" action="{{ route('logout') }}" method="POST" class="display-hidden">
                                    {{ csrf_field() }}
                                </form>
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->