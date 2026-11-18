<div class="card card-pad" id="ap-tabContent">
    <!-- Start Table Responsive -->
    <div class="table-responsive">
        <table class="table align-middle table-nowrap table-hover mb-0">
            <thead class="table-light">
                <tr class="userDatatable-header">
                    <th scope="col">Transaction ID</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Sale Amount</th>
                    <th scope="col">Revenue</th>
                    <th scope="col">Last Revenue</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($transactions) > 0): ?>
                <tr class="userDatatable-header">
                    <th>
                    </th>
                    <th>
                    </th>
                    <th>
                    </th>
                    <th class="text-center">
                        <span class="userDatatable-title fw-bold text-teal"><?php if(count($transactions)): ?><?php echo e(implode(', ', array_unique($transactions->pluck("sale_amount_currency")->toArray()))); ?> <?php echo e(number_format($totalSaleAmount, 2)); ?> <?php else: ?> $0 <?php endif; ?></span>
                    </th>
                    <th class="text-center">
                        <span class="userDatatable-title fw-bold text-teal"><?php if(count($transactions)): ?><?php echo e(implode(', ', array_unique($transactions->pluck("commission_amount_currency")->toArray()))); ?> <?php echo e(number_format($totalCommissionAmount, 2)); ?> <?php else: ?> $0 <?php endif; ?></span>
                    </th>
                    <th>

                    </th>
                    <th>

                    </th>
                </tr>
                <?php endif; ?>

                <?php if(count($transactions)): ?>
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                             <td>
                                <?php if($transaction->sub_id): ?>
                                    <div class="text-start">
                                        <?php echo e($transaction->transaction_id); ?><br>
                                        <a href="javascript:void(0)" onclick="showSubID('<?php echo e($key); ?>')"><i class="fas fa-plus-circle fs-12"></i></a><br>
                                        <span class="fs-12 d-none" id="subID<?php echo e($key); ?>">Sub ID: <?php echo e($transaction->sub_id); ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="text-start">
                                        <?php echo e($transaction->transaction_id); ?>

                                    </div>
                                <?php endif; ?>
                            </td>

                          
                            <td>
                                <div class="text-start">
                                    <?php echo e($transaction->advertiser_name); ?> <br>
                                    <span class="fs-12 color-gray">(<?php echo e($transaction->external_advertiser_id); ?>)</span>
                                </div>
                            </td>
                           

                              <td>
                                <div class="text-start float-right">
                                    <?php echo e(\Carbon\Carbon::parse($transaction->transaction_date)->format("F d, Y")); ?>

                                </div>
                            </td>

                            <td>
                                <div class="text-start">
                                    <?php echo e($transaction->sale_amount_currency . " " . number_format($transaction->sale_amount, 2)); ?>

                                </div>
                            </td>
                            <td>
                                <div class="text-start">
                                    <?php echo e($transaction->commission_amount_currency . " " . number_format($transaction->commission_amount, 2)); ?>

                                </div>
                            </td>

                            <td>
                                <div class="text-start">
                                    <?php if(!empty($transaction->old_commission_amount) || $transaction->old_commission_amount != 0): ?>
                                    <?php echo e($transaction->commission_amount_currency . " " . number_format($transaction->old_commission_amount, 2)); ?>

                                    <?php else: ?>
                                    <?php echo e($transaction->commission_amount_currency . " " . number_format($transaction->commission_amount, 2)); ?>

                                    <?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <div class="orderDatatable-status d-inline-block">
                                    <?php if($transaction->payment_status == \App\Models\Transaction::PAYMENT_STATUS_RELEASE_PAYMENT || $transaction->payment_status == \App\Models\Transaction::PAYMENT_STATUS_CONFIRM): ?>
                                    <?php if(isset($transaction->yespaid) && $transaction->yespaid == 1): ?>
                                        <span class="badge-soft dark-teal"><?php echo e(ucfirst(\App\Models\Transaction::STATUS_PAID)); ?></span>
                                        <?php else: ?>
                                        <span class="badge-soft teal"><?php echo e(ucfirst(\App\Models\Transaction::STATUS_APPROVED)); ?></span>
                                        <?php endif; ?>
                                    <?php elseif($transaction->payment_status == \App\Models\Transaction::PAYMENT_STATUS_RELEASE): ?>
                                        <span class="badge-soft amber"><?php echo e(ucwords(str_replace('_', ' ', \App\Models\Transaction::STATUS_PENDING_PAID))); ?></span>
                                    <?php elseif($transaction->commission_status == \App\Models\Transaction::STATUS_PENDING || $transaction->commission_status == 'Pending'): ?>
                                        <span class="badge-soft amber"><?php echo e(ucfirst(\App\Models\Transaction::STATUS_PENDING)); ?></span>
                                    <?php elseif($transaction->commission_status == \App\Models\Transaction::STATUS_HOLD): ?>
                                        <span class="badge-soft amber"><?php echo e(ucfirst(\App\Models\Transaction::STATUS_HOLD)); ?></span>
                                    <?php elseif($transaction->commission_status == \App\Models\Transaction::STATUS_APPROVED): ?>
                                        <span class="badge-soft teal"><?php echo e(ucfirst(\App\Models\Transaction::STATUS_APPROVED)); ?></span>
                                    <?php elseif($transaction->commission_status == \App\Models\Transaction::STATUS_PAID): ?>
                                        <span class="badge-soft dark-teal"><?php echo e(ucfirst(\App\Models\Transaction::STATUS_PAID)); ?></span>
                                    <?php elseif($transaction->commission_status == \App\Models\Transaction::STATUS_DECLINED): ?>
                                        <span class="badge-soft coral"><?php echo e(ucfirst(\App\Models\Transaction::STATUS_DECLINED)); ?></span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">
                            <h6 class="text-center my-2"><?php echo e(ucfirst(request('section', 'All'))); ?> Conversion Records are not available.</h6>
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
        <?php if(count($transactions) && $transactions instanceof \Illuminate\Pagination\LengthAwarePaginator ): ?>
            <div class="table-foot justify-content-end">
        
                <?php echo e($transactions->withQueryString()->links()); ?>

        
            </div>
        
        <?php endif; ?>
    </div>
</div>


<script>
    function showSubID(key)
    {
        $(`#subID${key}`).toggle();
    }
</script>
<?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/reports/transaction/list_view.blade.php ENDPATH**/ ?>