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


                    <?php if(count($coupons)): ?>
                        <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="name">
                                    <?php echo e($coupon->advertiser_name); ?> <br>
                                    <span class="fs-12 color-gray">(<?php echo e($coupon->sid ?? 0); ?>)</span>
                                </td>
                                <td class="createBy">
                                    <?php echo $coupon->title; ?>

                                </td>
                                <td class="apikey">
                                    <input type="text" class="form-control apikey-value" readonly
                                        value="<?php echo e($coupon->code ? $coupon->code : "No code required"); ?>">
                                </td>
                                <td class="create_date">
                                    <?php if($coupon->start_date): ?>
                                        <?php echo e(\Carbon\Carbon::parse($coupon->start_date)->format("d m, Y")); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td class="expiry_date">
                                    <?php if($coupon->end_date): ?>
                                        <?php echo e(\Carbon\Carbon::parse($coupon->end_date)->format("d m, Y")); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
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
                                                    data-target="#showVoucherForm" onclick="prepareVoucherFormContent('<?php echo e($coupon->id); ?>')">
                                                    VIEW
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                            <!-- End: tr -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <h6 class="text-center">Yikes! No Offers Available at the moment. Stay Tuned!.</h6>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(count($coupons) && $coupons instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
            <div class="d-flex justify-content-end mt-3">
                <div class="pagination-wrap hstack gap-2">
                    <?php echo e($coupons->withQueryString()->links()); ?>

                </div>
            </div>
        <?php endif; ?>

    </div>
</div>


<!-- Modal -->
<div class="modal fade showVoucherForm" id="showVoucherForm" role="dialog" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content radius-xl" id="voucherModalContent"></div>
    </div>
</div><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/creatives/coupons/list_view.blade.php ENDPATH**/ ?>