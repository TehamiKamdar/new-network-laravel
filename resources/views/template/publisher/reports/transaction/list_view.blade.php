<div class="card card-pad" id="ap-tabContent">
    <!-- Start Table Responsive -->
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr class="userDatatable-header">
                    <th>
                        <span class="userDatatable-title">Transaction ID</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Brand</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Transaction Date</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Sale Amount</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Revenue</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Last Revenue</span>
                    </th>
                    <th>
                        <span class="userDatatable-title">Status</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="userDatatable-header">
                    <th>
                    </th>
                    <th>
                    </th>
                    <th>
                    </th>
                    <th class="text-center">
                        <span class="userDatatable-title fw-bold text-teal">@if(count($transactions)){{ implode(', ', array_unique($transactions->pluck("sale_amount_currency")->toArray())) }} {{ number_format($totalSaleAmount, 2) }} @else $0 @endif</span>
                    </th>
                    <th class="text-center">
                        <span class="userDatatable-title fw-bold text-teal">@if(count($transactions)){{ implode(', ', array_unique($transactions->pluck("commission_amount_currency")->toArray())) }} {{ number_format($totalCommissionAmount, 2) }} @else $0 @endif</span>
                    </th>
                    <th>

                    </th>
                    <th>

                    </th>
                </tr>

                @if(count($transactions))
                    @foreach($transactions as $key => $transaction)

                        <tr>

                             <td>
                                @if($transaction->sub_id)
                                    <div class="text-start">
                                        {{ $transaction->transaction_id }}<br>
                                        <a href="javascript:void(0)" onclick="showSubID('{{ $key }}')"><i class="fas fa-plus-circle fs-12"></i></a><br>
                                        <span class="fs-12 d-none" id="subID{{ $key }}">Sub ID: {{ $transaction->sub_id }}</span>
                                    </div>
                                @else
                                    <div class="text-start">
                                        {{ $transaction->transaction_id }}
                                    </div>
                                @endif
                            </td>

                          
                            <td>
                                <div class="text-start">
                                    {{ $transaction->advertiser_name }} <br>
                                    <span class="fs-12 color-gray">({{ $transaction->external_advertiser_id }})</span>
                                </div>
                            </td>
                           

                              <td>
                                <div class="text-start float-right">
                                    {{ \Carbon\Carbon::parse($transaction->transaction_date)->format("F d, Y") }}
                                </div>
                            </td>

                            <td>
                                <div class="text-start">
                                    {{ $transaction->sale_amount_currency . " " . number_format($transaction->sale_amount, 2)  }}
                                </div>
                            </td>
                            <td>
                                <div class="text-start">
                                    {{ $transaction->commission_amount_currency . " " . number_format($transaction->commission_amount, 2)  }}
                                </div>
                            </td>

                            <td>
                                <div class="text-start">
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
                                        <span class="badge-soft dark-teal">{{ ucfirst(\App\Models\Transaction::STATUS_PAID) }}</span>
                                        @else
                                        <span class="badge-soft teal">{{ ucfirst(\App\Models\Transaction::STATUS_APPROVED) }}</span>
                                        @endif
                                    @elseif($transaction->payment_status == \App\Models\Transaction::PAYMENT_STATUS_RELEASE)
                                        <span class="badge-soft amber">{{ ucwords(str_replace('_', ' ', \App\Models\Transaction::STATUS_PENDING_PAID)) }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_PENDING || $transaction->commission_status == 'Pending')
                                        <span class="badge-soft amber">{{ ucfirst(\App\Models\Transaction::STATUS_PENDING) }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_HOLD)
                                        <span class="badge-soft amber">{{ ucfirst(\App\Models\Transaction::STATUS_HOLD) }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_APPROVED)
                                        <span class="badge-soft teal">{{ ucfirst(\App\Models\Transaction::STATUS_APPROVED) }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_PAID)
                                        <span class="badge-soft dark-teal">{{ ucfirst(\App\Models\Transaction::STATUS_PAID) }}</span>
                                    @elseif($transaction->commission_status == \App\Models\Transaction::STATUS_DECLINED)
                                        <span class="badge-soft coral">{{ ucfirst(\App\Models\Transaction::STATUS_DECLINED) }}</span>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @endforeach
                @else
                    <tr>
                        <td colspan="7">
                            <h6 class="text-center my-2">{{ ucfirst(request('section', 'All')) }} Conversion Records are not available.</h6>
                        </td>
                    </tr>
                @endif

            </tbody>
        </table>
        @if(count($transactions) && $transactions instanceof \Illuminate\Pagination\LengthAwarePaginator )
            <div class="table-foot justify-content-end">
        
                {{ $transactions->withQueryString()->links() }}
        
            </div>
        
        @endif
    </div>
</div>


<script>
    function showSubID(key)
    {
        $(`#subID${key}`).toggle();
    }
</script>
