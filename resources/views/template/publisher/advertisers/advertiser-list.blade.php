@php
    $checkAdmin = auth()->user()->getRoleName() != \App\Models\Role::ADMIN_ROLE
@endphp

    <div class="table-responsive table-card mb-3">
        <table class="table align-middle table-nowrap table-hover mb-0" id="customerTable">
            <thead class="table-light">
                <tr>
                    <th data-sort="name" scope="col">Advertiser</th>
                    <th data-sort="owner" scope="col">Commission</th>
                    <th data-sort="industry_type" scope="col">Region</th>
                    <th data-sort="star_value" scope="col">APC</th>
                    <th data-sort="star_value" scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="list">
                @if(count($advertisers))

                    @foreach($advertisers as $advertiser)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div>
                                        <span class="brand-mark" style="width:30px;height:30px;font-size:8px;color:black;">
                                            @if (!empty($fetch->fetch_logo_url))

                                                <img loading="lazy" class="ap-img__main h-auto mr-10"
                                                    src="{{ $fetch->fetch_logo_url }}" alt="{{ $advertiser->name }}"
                                                    style="width: 30px">
                                            @elseif (!empty($advertiser->logo))
                                                <img loading="lazy" class="ap-img__main h-auto mr-10"
                                                    src="{{ \App\Helper\Static\Methods::staticAsset("$advertiser->logo") }}"
                                                    alt="{{ $advertiser->name }}" style="width: 30px">
                                            @else
                                                <img loading="lazy" class="ap-img__main h-auto mr-10"
                                                    src="{{ \App\Helper\Static\Methods::isImageShowable($advertiser->logo) }}"
                                                    alt="{{ $advertiser->name }}" style="width: 30px">
                                            @endif</span>
                                    </div>
                                    <a href="{{ route("publisher.view-advertiser", $advertiser->sid )}}" class="fw-semibold" style="color:var(--teal-deep);">{{ $advertiser->name }}</a>
                                </div>
                            </td>
                            <td class="owner">{{ $advertiser->commission }}{{ $advertiser->commission_type == "percentage" ? "%" : $advertiser->commission_type }}
                            </td>
                            <td class="industry_type">
                                @php
                                    $regions = [];
                                    if (is_string($advertiser->primary_regions)) {
                                        $regions = json_decode($advertiser->primary_regions);
                                    } elseif (is_array($advertiser->primary_regions)) {
                                        $regions = $advertiser->primary_regions;
                                    }
                                    if (count($regions) > 1) {
                                        $regions = "Multi";
                                    } elseif (count($regions) == 1 && $regions[0] == "00") {
                                        $regions = "All";
                                    } elseif (count($regions) == 1) {
                                        $regions = $regions[0];
                                    } else {
                                        $regions = "N/A";
                                    }
                                @endphp
                                <span class="">{{ $regions }}</span>
                                <span class="po-details__sTitle">Region</span>
                            </td>
                            <td class="star_value">
                                @if($advertiser->average_payment_time)
                                    {{ $advertiser->average_payment_time }} days
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($checkAdmin)
                                    @php
                                        $status = null;
                                        if (isset($advertiser->advertiser_applies->status)) {
                                            $status = $advertiser->advertiser_applies->status;
                                            
                                        } elseif (isset($advertiser->advertiser_applies_status)) {
                                            $status = $advertiser->advertiser_applies_status;
                                        }
                                    @endphp
                                    @if($status && $status == \App\Models\AdvertiserApply::STATUS_PENDING)

                                        <span class="badge bg-warning-subtle text-warning text-uppercase" disabled>
                                            <i class="fas fa-clock color-white me-2"></i> Pending
                                        </span>

                                    @elseif($status && $status == \App\Models\AdvertiserApply::STATUS_ACTIVE)

                                        <span class="badge bg-success-subtle text-success text-uppercase" disabled>
                                            <i class="fas fa-check color-white me-2"></i> Joined
                                        </span>

                                    @elseif($status && $status == \App\Models\AdvertiserApply::STATUS_REJECTED)

                                        <span class="badge bg-danger-subtle text-danger text-uppercase" disabled>
                                            <i class="fas fa-times color-white me-2"></i> Rejected
                                        </span>

                                    @elseif($status && $status == \App\Models\AdvertiserApply::STATUS_HOLD || $status && $status == \App\Models\AdvertiserApply::STATUS_ADMITAD_HOLD)

                                        <span class="badge bg-primary-subtle text-primary text-uppercase" disabled>
                                            <i class="fas fa-stop-circle color-white me-2"></i> Hold
                                        </span>

                                    @else

                                        <span class="badge bg-warning-subtle text-warning text-uppercase">
                                            {{-- @if($advertisers instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                            onclick="openApplyModal('{{ $advertiser->sid }}', '{{ $advertiser->name }}', '{{ $advertiser->average_payment_time }}', '{{ $regions }}')" @else
                                                onclick="window.location.href='{{ route("publisher.view-advertiser", ['sid' => $advertiser->sid]) }}'"
                                            @endif> --}}
                                            <span class="fas fa-stop-circle follow-icon me-2"></span> Not Applied
                                        </span>

                                    @endif
                                @endif
                            </td>
                            <td>
                                <ul class="list-inline hstack gap-2 mb-0">
                                    <li class="list-inline-item {{ $status }}" title="View Details">
                                        <a href="javascript:void(0);" 
                                        class="view-item-btn" 
                                        onclick="viewBrandDetails('{{ route('publisher.brand-details', $advertiser->id) }}')"
                                        >
                                            <i class="ri-eye-fill align-bottom text-muted"></i>
                                        </a>
                                    </li>
                                    
                                    @php
                                        $status = null;
                                        if (isset($advertiser->advertiser_applies->status)) {
                                            $status = $advertiser->advertiser_applies->status;
                                            
                                        } elseif (isset($advertiser->advertiser_applies_status)) {
                                            $status = $advertiser->advertiser_applies_status;
                                        }
                                    @endphp
                                    @if(!$status)
                                        <li class="list-inline-item {{ $status }}" title="Apply">
                                            <a class="remove-item-btn"
                                                @if($advertisers instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                                    onclick="openApplyModal(
                                                        '{{ $advertiser->sid }}',
                                                        '{{ $advertiser->name }}',
                                                        '{{ $advertiser->average_payment_time }}',
                                                        '{{ $regions }}'
                                                    )"
                                                @else
                                                    onclick="window.location.href='{{ route('publisher.view-advertiser', ['sid' => $advertiser->sid]) }}'"
                                                @endif
                                                data-bs-toggle="modal" data-bs-target="#modal-basic">

                                                <i class="ri-user-add-fill align-bottom text-muted"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            <h6 class="text-center">{{ ucfirst(request('section', 'All')) }} Brands Records are not available.</h6>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if(count($advertisers) && $advertisers instanceof \Illuminate\Pagination\LengthAwarePaginator )
        <div class="d-flex justify-content-end mt-3">
            <div class="pagination-wrap hstack gap-2">
            {{ $advertisers->withQueryString()->links() }}
            </div>
        </div>
    @endif

