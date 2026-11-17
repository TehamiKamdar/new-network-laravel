@extends("layouts.publisher.publisher_panel")

@push('title', 'Notification View')

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
        position: absolute;
        right: 30px;
        font-size: 13px;
        line-height: 20px;
        top: 30px;
    }
</style>

@endpushonce

@pushonce('scripts')

@endpushonce

@section("content")


    <a href="{{ route("publisher.notification-center.index") }}" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m15 18-6-6 6-6" />
        </svg>
        Back to notifications
    </a>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card card-pad">

                <div class="notif-detail-head">
                    <span class="np-icon teal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.6 12 12 20.6 3.4 12 12 3.4z" />
                            <circle cx="12" cy="12" r="2" />
                        </svg>
                    </span>
                    <div>
                        <h1 class="font-display">{!! $notification->notification_header !!}</h1>
                        <div class="meta-row">
                            <span class="badge-soft teal">{{ $notification->type }}</span>
                            <span class="time">{{ \Carbon\Carbon::parse($notification->created_at)->format('d M, Y') }} · {{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <div class="np-content">
                    {!! $notification->content !!}
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-pad">
                <div class="section-head">
                    <h2>Related</h2>
                </div>
                @foreach(\App\Helper\Static\Methods::getNotifications() as $notification)
                    <div class="notif-item {{ $notification->is_new == 1 ? 'unread' : '' }}">
                        <span class="dot-ico"></span>
                        <a href="{{ route("publisher.notification-center.show", $notification->id) }}"  class="txt">
                            <span class="t d-block">{{ $notification->notification_header }}</span>
                            <span class="time d-block">{{ $notification->created_at->diffForHumans() }}</span>
                        </a>
                    </div>
                @endforeach
                <a href="notifications.html" class="link-more mt-2">See all notifications
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endsection