

@if ($paginator->hasPages())

    {{-- Previous Page --}}
    @if ($paginator->onFirstPage())
        <a class="page-item pagination-prev disabled"
            aria-disabled="true"
            aria-label="@lang('pagination.previous')">
            Previous
        </a>
    @else
        <a class="page-item pagination-prev "
            href="{{ $paginator->previousPageUrl() }}"
            rel="prev"
            aria-label="@lang('pagination.previous')">
            Previous
        </a>
    @endif

    <ul class="pagination listjs-pagination mb-0">

        {{-- Pagination Elements --}}
    @foreach ($elements as $element)

        {{-- Three Dots --}}
        @if (is_string($element))
        <li aria-disabled="true">
            <span class="page">{{ $element }}</span>
        </li>
        @endif


        {{-- Page Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)

                @if ($page == $paginator->currentPage())
                    <li class="active" aria-current="page">
                        <a class="page">{{ $page }}</a>
                    </li>
                @else
                    <li class="">
                        <a class="page" href="{{ $url }}">
                            {{ $page }}
                        </a>
                    </li>
                @endif

            @endforeach
        @endif
        
    @endforeach
    </ul>


    {{-- Next Page --}}
    @if ($paginator->hasMorePages())
        <a class="page-item pagination-next"
            href="{{ $paginator->nextPageUrl() }}"
            rel="next"
            aria-label="@lang('pagination.next')">
            Next
        </a>
    @else
        <a class="page-item pagination-next disabled"
            aria-disabled="true"
            aria-label="@lang('pagination.next')">
            Next
        </a>
    @endif

@endif


{{-- Pagination Limit --}}
@if(
    request()->route()->getName() == "publisher.reports.transactions.list"
    || request()->route()->getName() == "publisher.find-advertisers"
    || request()->route()->getName() == "publisher.own-advertisers"
    || request()->route()->getName() == "publisher.reports.performance-by-transactions.list"
    || request()->route()->getName() == "publisher.reports.performance-by-clicks.list"
    || request()->route()->getName() == "publisher.creatives.coupons.list"
    || request()->route()->getName() == "publisher.creatives.text-links.list"
)


        <div class="paging-option">

            @if(request()->route()->getName() == "publisher.find-advertisers" || request()->route()->getName() == "publisher.own-advertisers")

                @php
                    $limit = \App\Helper\Static\Vars::DEFAULT_PUBLISHER_ADVERTISER_PAGINATION;

                    if(session()->has('publisher_advertiser_limit')) {
                        $limit = session()->get('publisher_advertiser_limit');
                    }
                @endphp

            @elseif(request()->route()->getName() == "publisher.reports.transactions.list")

                @php
                    $limit = \App\Helper\Static\Vars::DEFAULT_PUBLISHER_TRANSACTION_PAGINATION;

                    if(session()->has('publisher_transaction_limit')) {
                        $limit = session()->get('publisher_transaction_limit');
                    }
                @endphp

            @elseif(request()->route()->getName() == "publisher.reports.performance-by-transactions.list")

                @php
                    $limit = \App\Helper\Static\Vars::DEFAULT_PUBLISHER_EARNING_PERFORMANCE_PAGINATION;

                    if(session()->has('publisher_earning_performance_limit')) {
                        $limit = session()->get('publisher_earning_performance_limit');
                    }
                @endphp

            @elseif(request()->route()->getName() == "publisher.reports.performance-by-clicks.list")

                @php
                    $limit = \App\Helper\Static\Vars::DEFAULT_PUBLISHER_EARNING_PERFORMANCE_PAGINATION;

                    if(session()->has('publisher_click_performance_limit')) {
                        $limit = session()->get('publisher_click_performance_limit');
                    }
                @endphp

            @elseif(request()->route()->getName() == "publisher.creatives.coupons.list")

                @php
                    $limit = \App\Helper\Static\Vars::DEFAULT_PUBLISHER_COUPON_PAGINATION;

                    if(session()->has('publisher_coupon_limit')) {
                        $limit = session()->get('publisher_coupon_limit');
                    }
                @endphp

            @elseif(request()->route()->getName() == "publisher.creatives.text-links.list")

                @php
                    $limit = \App\Helper\Static\Vars::DEFAULT_PUBLISHER_COUPON_PAGINATION;

                    if(session()->has('publisher_text_link_limit')) {
                        $limit = session()->get('publisher_text_link_limit');
                    }
                @endphp

            @endif


            <select name="limit" id="limit" class="page-selection">
                <option value="10" @if($limit == "10") selected @endif>10/page</option>
                <option value="20" @if($limit == "20") selected @endif>20/page</option>
                <option value="40" @if($limit == "40") selected @endif>40/page</option>
                <option value="60" @if($limit == "60") selected @endif>60/page</option>
            </select>

        </div>


@endif
