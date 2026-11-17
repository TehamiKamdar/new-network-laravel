

        <!-- Start Table Responsive -->
        <div class="card card-pad">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="6" class="text-center">
                                <h5 class="fw-bold text-primary">Earnings</h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="fw-bold text-uppercase text-secondary">Advertiser</span>
                            </td>
                            <td>
                                <span class="fw-bold text-uppercase text-secondary">Transactions</span>
                            </td>
                            <td>
                                <span class="fw-bold text-uppercase text-secondary">Sale Amount</span>
                            </td>
                            <td>
                                <span class="fw-bold text-uppercase text-secondary">Revenue</span>
                            </td>

                            <td>
                                <span class="fw-bold text-uppercase text-secondary">Avg. Payout</span>
                            </td>
                        </tr>
                        @if($performanceOverviewList && count($performanceOverviewList))
                            @foreach($performanceOverviewList as $list)
                                @php
                                    $totalClicks = $list->total_clicks ?? 0;
                                    $totalTransactions = $list->total_transactions ?? 0;
                                    $totalSaleAmount = $list->total_sale_amount ?? 0;
                                    $totalCommissionAmount = $list->total_commission_amount ?? 0;
                                    $totalCommissionPayoutAmount = ((float) \App\Helper\Static\Vars::COMMISSION_PERCENTAGE / 100) * (float) $list->total_commission_amount;
                                @endphp
                                <tr>
                                    <td>
                                        <a target="_blank"
                                            href="{{ route("publisher.reports.transactions.list", ['search_by_name' => $list->external_advertiser_id ?? "-", 'start_date' => request()->start_date ?? now()->format("Y-m-01"), 'end_date' => now()->format("Y-m-t")]) }}">{{ $list->advertiser_name ?? "-" }}
                                            <br><span class="fs-12 color-gray">({{ $list->external_advertiser_id }})</span></a>
                                    </td>
                                    <td><a target="_blank"
                                            href="{{ route("publisher.reports.transactions.list", ['search_by_name' => $list->external_advertiser_id ?? "-", 'start_date' => request()->start_date ?? now()->format("Y-m-01"), 'end_date' => now()->format("Y-m-t")]) }}">{{ number_format($totalTransactions) }}</a>
                                    </td>
                                    <td>{{ $list->sale_amount_currency ?? "USD" }} {{ number_format($totalSaleAmount, 2) }}</td>
                                    <td>{{ $list->commission_amount_currency ?? "USD" }}
                                        {{ number_format($totalCommissionAmount, 2) }}</td>

                                    @if($totalCommissionAmount > 0 && $totalSaleAmount > 0)
                                        <td>{{ number_format(round($totalCommissionAmount / $totalSaleAmount * 100), 1) }}%</td>
                                    @else
                                        <td>{{ number_format(0, 1) }}%</td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <h6 class="my-2 text-center">Performance Overview Data Not Exist</h6>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if(count($performanceOverviewList) && $performanceOverviewList instanceof \Illuminate\Pagination\LengthAwarePaginator)
                
                    <div class="table-foot justify-content-end">
                
                        {{ $performanceOverviewList->withQueryString()->links() }}
                
                    </div>
                
                @endif
            </div>
        </div>
