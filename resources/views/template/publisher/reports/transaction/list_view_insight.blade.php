<div class="tab-content spin-embadded" id="ap-tabContent">

    <!-- Start Table Responsive -->
    <div class="table-responsive">
        <table class="table mb-0 table-hover table-primary border-0">
            <thead>
                <tr class="userDatatable-header">
                    <th>
                        <span class="userDatatable-title font-weight-bold text-black">Transaction ID</span>
                    </th>
                    <th>
                        <span class="userDatatable-title font-weight-bold text-black">Brand</span>
                    </th>
                   
 <th>
                        <span class="userDatatable-title float-right font-weight-bold text-black">Transaction Date</span>
                    </th>
                    <th>
                        <span class="userDatatable-title font-weight-bold text-black">Sale Amount</span>
                    </th>

                    <th>
                        <span class="userDatatable-title font-weight-bold text-black">Revenue</span>
                    </th>

                    <th>
                        <span class="userDatatable-title font-weight-bold text-black">Last Revenue</span>
                    </th>

                    <th>
                        <span class="userDatatable-title font-weight-bold text-black">Status</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                

                @if(count($transactions))
                    @foreach($transactions as $key => $transaction)

                        <tr>

                             <td>
                                @if($transaction->sub_id)
                                    <div class="orderDatatable-title">
                                        {{ $transaction->transaction_id }}<br>
                                        <a href="javascript:void(0)" onclick="showSubID('{{ $key }}')"><i class="fas fa-plus-circle fs-12"></i></a><br>
                                        <span class="fs-12 display-hidden" id="subID{{ $key }}">Sub ID: {{ $transaction->sub_id }}</span>
                                    </div>
                                @else
                                    <div class="orderDatatable-title">
                                        {{ $transaction->transaction_id }}
                                    </div>
                                @endif
                            </td>

                          
                            <td>
                                <div class="orderDatatable-title">
                                    {{ $transaction->advertiser_name }} <br>
                                    <span class="fs-12 color-gray">({{ $transaction->external_advertiser_id }})</span>
                                </div>
                            </td>
                           

                              <td>
                                <div class="orderDatatable-title float-right">
                                    {{ \Carbon\Carbon::parse($transaction->transaction_date)->format("F d, Y") }}
                                </div>
                            </td>

                            <td>
                                <div class="orderDatatable-title">
                                    {{ $transaction->sale_amount_currency . " " . number_format($transaction->sale_amount, 2)  }}
                                </div>
                            </td>
                            <td>
                                <div class="orderDatatable-title">
                                    {{ $transaction->commission_amount_currency . " " . number_format($transaction->commission_amount, 2)  }}
                                </div>
                            </td>

                            <td>
                                <div class="orderDatatable-title">
                                    @if(!empty($transaction->old_commission_amount) || $transaction->old_commission_amount != 0)
                                    {{ $transaction->commission_amount_currency . " " . number_format($transaction->old_commission_amount, 2)  }}
                                    @else
                                    {{ $transaction->commission_amount_currency . " " . number_format($transaction->commission_amount, 2)  }}
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div class="orderDatatable-status d-inline-block">
                                    @if($transaction->payment_status == \App\Models\Transaction::PAYMENT_STATUS_RELEASE_PAYMENT || $transaction->payment_status == \App\Models\Transaction::PAYMENT_STATUS_CONFIRM)
                                    @if(isset($transaction->yespaid) && $transaction->yespaid == 1)
                                        <span class="font-weight-bold order-bg-opacity-success text-success rounded-pill active">{{ \App\Models\Transaction::STATUS_PAID }}</span>
                                        @else
                                        <span class="font-weight-bold order-bg-opacity-success text-success rounded-pill active">{{ \App\Models\Transaction::STATUS_APPROVED }}</span>
                                        @endif
                                    @elseif($transaction->payment_status == \App\Models\Transaction::PAYMENT_STATUS_RELEASE)
                                        <span class="font-weight-bold order-bg-opacity-success text-warning rounded-pill active">{{ ucwords(str_replace('_', ' ', \App\Models\Transaction::STATUS_PENDING_PAID)) }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_PENDING || $transaction->commission_status == 'Pending')
                                        <span class="font-weight-bold order-bg-opacity-warning text-warning rounded-pill active">{{ \App\Models\Transaction::STATUS_PENDING }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_HOLD)
                                        <span class="font-weight-bold order-bg-opacity-info text-info rounded-pill active">{{ \App\Models\Transaction::STATUS_HOLD }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_APPROVED)
                                        <span class="font-weight-bold order-bg-opacity-success text-success rounded-pill active">{{ \App\Models\Transaction::STATUS_APPROVED }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_PAID)
                                        <span class="font-weight-bold order-bg-opacity-primary text-primary rounded-pill active">{{ \App\Models\Transaction::STATUS_PAID }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_DECLINED)
                                        <span class="font-weight-bold order-bg-opacity-danger text-danger rounded-pill active">{{ \App\Models\Transaction::STATUS_DECLINED }}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="7">
                            <h6 class="text-center my-2">Transaction Data Not Exist</h6>
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
    <!-- Table Responsive End -->

    @include("template.publisher.widgets.loader")

</div>

@if(count($transactions) && $transactions instanceof \Illuminate\Pagination\LengthAwarePaginator )

    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-sm-end justify-content-star mt-1 mb-30">

                {{ $transactions->withQueryString()->links() }}

            </div>
        </div>
    </div>

@endif

<script>
    function showSubID(key)
    {
        $(`#subID${key}`).toggle();
    }
</script>
