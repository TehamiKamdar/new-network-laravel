@php
    $dateArr = [];
@endphp

@if(count($notifications))
    @foreach($notifications as $notification)

        @php
            $date = \Carbon\Carbon::parse($notification->created_at)->format("F Y");
            $id = $notification->id;
        @endphp

        @if(!in_array($date, $dateArr))
            <h4 class="fw-500">{{ $date }}</h4>

            @php
                $dateArr[] = $date;
            @endphp

        @endif

        <div class="notif-panel">
            <button class="np-head" data-bs-toggle="collapse" data-bs-target="#n{{ $id }}" aria-expanded="false">
                <span class="np-icon teal">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.6 12 12 20.6 3.4 12 12 3.4z" />
                        <circle cx="12" cy="12" r="2" />
                    </svg>
                </span>
                <span class="np-body">
                    <span class="np-title d-block">{!! $notification->notification_header !!}</span>
                    <span class="np-meta">
                        <span class="badge-soft teal">{{ $notification->type }}</span>
                        <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                        <span class="{{ $notification->is_new == 1 ? 'np-unread' : 'np-read' }}"></span>
                    </span>
                </span>
                <span class="np-chev"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </span>
            </button>
            <div id="n{{ $id }}" class="collapse" data-bs-parent="#notifAccordion">
                <div class="np-content">
                    {!! $notification->content !!}
                    <a href="{{ route("publisher.notification-center.show", $notification->id) }}" class="link-more">Open full notification
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- panel 1 -->
        {{-- <div class="panel panel-default shadow-lg">
            <div class="panel-heading" role="tab" id="heading{{ $id }}" style="
            padding: 20px;
        ">
                <h4 class="panel-title">

                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $id }}"
                        aria-expanded="false" aria-controls="collapse{{ $id }}">
                        {!! $notification->header !!}
                    </a>
                    <span class="category mb-0 fs-14 color-light fw-400">{{ $notification->type }}</span>
                </h4>
            </div>
            <div id="collapse{{ $id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $id }}">
                <div class="panel-body" style="padding: 20px;">
                    {!! $notification->content !!}
                </div>
            </div>
        </div> --}}

    @endforeach
@else

    <!-- Advertiser card -->
    <div class="col-xxl-12 col-lg-12 col-md-12 mb-10 px-10">
        <div class="card">
            <div class="card-body text-center">
                <h6>{{ ucwords(str_replace('-', ' ', request()->route()->parameter("category"))) }} Data Not Exist</h6>
            </div>
        </div>
    </div>

@endif

@if(count($notifications) && $notifications instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-sm-end justify-content-star mt-1 mb-30">

                {{ $notifications->withQueryString()->links() }}

            </div>
        </div>
    </div>
@endif