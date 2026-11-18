<div class="card" id="ap-tabContent">

    <!-- Start Table Responsive -->
    <div class="table-responsive">
        <table class="table align-middle table-nowrap table-hover mb-0">
            <thead class="table-light">
                <tr class="userDatatable-header">
                    <th scope="col">Invoice No#</th>
                    <th scope="col">Invoice Created</th>
                    <th scope="col">Payout ID</th>
                    <th scope="col">Website</th>
                    <th scope="col">Payout Method</th>
                    <th scope="col">Paid Amount</th>
                    <th scope="col">Paid Date</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($payments)): ?>
                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                            <td>
                                <div class="orderDatatable-title">
                                    <?php echo e($payment->invoice_id); ?>

                                </div>
                            </td>
                            <td>
                                <div class="orderDatatable-title">
                                    <?php echo e(\Carbon\Carbon::parse($payment->created_at)->format("d-m-Y")); ?>

                                </div>
                            </td>
                            <td>
                                <div class="orderDatatable-title">
                                    <?php echo e($payment->payment_id); ?>

                                </div>
                            </td>
                            <td>
                                <div class="orderDatatable-title">
                                    <?php
                                    $website = App\Models\Website::find($payment->website_id)
                                    ?>
                                    <?php if($website): ?>
                                    <?php echo e($website->name); ?>

                                    <?php endif; ?>

                                </div>
                            </td>
                            <td>
                                <div class="orderDatatable-title">
                                    <?php echo e(ucwords($payment->payment_method->payment_method ?? "-")); ?>

                                </div>
                            </td>
                            <td>
                                <div class="orderDatatable-title">
                                    <?php
                                        if($payment->is_new_invoice == \App\Models\PaymentHistory::INVOICE_NEW)
                                        {
                                            $cappedAmount = 30;
                                            if($payment->payment_method->payment_method == \App\Helper\Static\Vars::PAYONEER) {
                                                $cappedAmount = 20;
                                            }
                                            $processingFees = $payment->lc_commission_amount * 0.02;
                                            $processingFees = $processingFees > $cappedAmount ? round($cappedAmount, 1) : round($processingFees, 1);
                                            $amount = "$".number_format($payment->lc_commission_amount - $processingFees, 2);
                                        }
                                        else
                                        {
                                            $amount = "$".number_format($payment->lc_commission_amount, 2);
                                        }

                                    ?>
                                    <?php echo e($amount ?? 0); ?>

                                </div>
                            </td>
                            <td>
                                <div class="orderDatatable-title">
                                    <?php echo e($payment->paid_date ?? "-"); ?>

                                </div>
                            </td>
                            <td>
                                <?php if($payment->status == \App\Models\PaymentHistory::PENDING): ?>
                                    <div class="orderDatatable-status d-inline-block">
                                        <span class="badge-soft amber">Pending</span>
                                    </div>
                                <?php elseif($payment->status == \App\Models\PaymentHistory::PAID): ?>
                                    <div class="orderDatatable-status d-inline-block">
                                        <span class="badge-soft dark-teal">Paid</span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group atbd-button-group btn-group-normal" role="group ">
                                    <?php
                                        $status = $payment->status == \App\Models\Transaction::STATUS_PAID ? "paid" : "pending";
                                    ?>
                                    <a href="<?php echo e(route("publisher.reports.transactions.list")); ?>?payment_id=<?php echo e($payment->id); ?>&r_name=<?php echo e($status); ?>" type="button" class="btn  btn-xs btn-outline-dark">Transactions</a>
                                    <?php if($payment->status == \App\Models\PaymentHistory::PAID): ?>
                                        <a href="<?php echo e(route("publisher.payments.invoice", ['payment_history' => $payment->id])); ?>" type="button" class="btn btn-xs btn-outline-dark">Invoice</a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <!-- End: tr -->

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">
                            <h6 class="text-center">Payments record is not available at the moment.</h6>
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
        <?php if(count($payments) && $payments instanceof \Illuminate\Pagination\LengthAwarePaginator ): ?>
        
            <div class="table-foot justify-content-end">        
                        <?php echo e($payments->withQueryString()->links()); ?>

            </div>
        
        <?php endif; ?>
    </div>
    <!-- Table Responsive End -->


</div>

<?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/payments/list_view.blade.php ENDPATH**/ ?>