@extends("layouts.publisher.publisher_panel")

@push('title', 'Notification Center')

@pushonce('styles')

    <style>
        .application-faqs .panel {
            margin-bottom: 25px !important;
        }
        .application-faqs .panel {
            background: #fff;
            margin: 10px 0;
        }
        .application-faqs .panel-title .title-foot {
            display: contents;
        }
        .application-faqs .panel-title .category {
           
            right: 30px;
            font-size: 13px;
            line-height: 20px;
            top: 10px;
        }
    </style>

@endpushonce

@pushonce('scripts')

@endpushonce

@section("content")

   <div class="az-content az-content-dashboard">

        <div class="container">
            <div class="az-content-body">
            <div class="row">
                <div class="col-xl-3 col-sm-5">
                    <!-- Card 1 -->
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="faqs-wrapper">

                                <div class="mb-3">
                                    <form action="/" class="order-search__form w-auto">

                                        <div class="input-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="11" cy="11" r="7" />
                                                <path d="m21 21-4.3-4.3" />
                                            </svg>
                                            <input type="text" class="form-control w-100"
                                                value="{{ request()->search_by_name }}" id="SearchByName"
                                                placeholder="Search by Name">
                                        </div>
                                    </form>
                                </div>

                                <div class="faqs-wrapper-tab">
                                    <div class="nav tab-pills flex-column w-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link @if(empty(request()->route()->parameter("category"))) active @endif" href="{{ route("publisher.notification-center.index") }}">
                                            <span class="dot bg-primary"></span>All Notifications</a>
                                        <a class="nav-link @if(request()->route()->parameter("category") == 'approvals') active @endif" href="{{ route("publisher.notification-center.index", ['category' => 'approvals']) }}">
                                            <span class="dot bg-success"></span>Approvals</a>
                                        <a class="nav-link @if(request()->route()->parameter("category") == 'rejections') active @endif" href="{{ route("publisher.notification-center.index", ['category' => 'rejections']) }}">
                                            <span class="dot bg-danger"></span>Rejections</a>
                                        <a class="nav-link @if(request()->route()->parameter("category") == 'promotions') active @endif" href="{{ route("publisher.notification-center.index", ['category' => 'promotions']) }}">
                                            <span class="dot bg-warning"></span>Promotions</a>
                                        <a class="nav-link @if(request()->route()->parameter("category") == 'advertiser-updates') active @endif" href="{{ route("publisher.notification-center.index", ['category' => 'advertiser-updates']) }}">
                                            <span class="dot bg-info"></span>Advertiser Updates</a>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- ends: col -->

                <div class="col-xl-9 col-sm-7">
                    <div class="mb-30">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <!-- Edit Profile -->
                                <div class="application-faqs">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        @include("template.publisher.notifications.content", compact('notifications'))
                                    </div>
                                </div>
                                <!-- Edit Profile End -->
                            </div>
                        </div>
                    </div>
                </div><!-- ends: col -->
            </div>
        </div>
    </div>
</div>
@endsection
