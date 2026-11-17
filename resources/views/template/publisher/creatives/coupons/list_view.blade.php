<!-- Start Table Responsive -->
<div class="card-body">
    <div>
        <div class="table-responsive table-card mb-3">
            <table class="table align-middle table-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th data-sort="name" scope="col">Brand</th>
                        <th data-sort="createBy" scope="col">Offer Name</th>
                        <th data-sort="apikey" scope="col">Code</th>
                        <th data-sort="status" scope="col">Start Date</th>
                        <th data-sort="create_date" scope="col">End Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="list">


                    @if(count($coupons))
                        @foreach($coupons as $key => $coupon)
                            <tr>
                                <td class="name">
                                    {{ $coupon->advertiser_name }} <br>
                                    <span class="fs-12 color-gray">({{ $coupon->sid ?? 0}})</span>
                                </td>
                                <td class="createBy">
                                    {!! $coupon->title !!}
                                </td>
                                <td class="apikey">
                                    <input type="text" class="form-control apikey-value" readonly
                                        value="{{ $coupon->code ? $coupon->code : "No code required" }}">
                                </td>
                                <td class="create_date">
                                    @if($coupon->start_date)
                                        {{ \Carbon\Carbon::parse($coupon->start_date)->format("d m, Y") }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="expiry_date">
                                    @if($coupon->end_date)
                                        {{ \Carbon\Carbon::parse($coupon->end_date)->format("d m, Y") }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0)" class="btn btn-outline btn-sm" data-toggle="modal"
                                                    data-target="#showVoucherForm" onclick="prepareVoucherFormContent('{{ $coupon->id }}')">
                                                    VIEW
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- End: tr -->
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <h6 class="text-center">Yikes! No Offers Available at the moment. Stay Tuned!.</h6>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if(count($coupons) && $coupons instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="d-flex justify-content-end mt-3">
                <div class="pagination-wrap hstack gap-2">
                    {{ $coupons->withQueryString()->links() }}
                </div>
            </div>
        @endif

    </div>
</div>


<!-- Modal -->
<div class="modal fade showVoucherForm" id="showVoucherForm" role="dialog" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-xl" id="voucherModalContent"></div>
    </div>
</div>