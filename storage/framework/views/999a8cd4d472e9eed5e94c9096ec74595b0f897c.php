<?php
    $checkAdmin = auth()->user()->getRoleName() != \App\Models\Role::ADMIN_ROLE
?>

<div class="card card-pad">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr class="userDatatable-header">
                    <th>
                        <span class="projectDatatable-title">Advertiser</span>
                    </th>
                    <th>
                        <span class="projectDatatable-title">Commission</span>
                    </th>
                    <th>
                        <span class="projectDatatable-title">Region</span>
                    </th>
                    <th>
                        <span class="projectDatatable-title">APC</span>
                    </th>
                    <?php if($checkAdmin): ?>
                        <th>
                            Status
                        </th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if(count($advertisers)): ?>

                    <?php $__currentLoopData = $advertisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertiser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div>
                                        <span class="brand-mark" style="width:30px;height:30px;font-size:8px;color:black;">
                                            <?php if(!empty($fetch->fetch_logo_url)): ?>

                                                <img loading="lazy" class="ap-img__main h-auto mr-10"
                                                    src="<?php echo e($fetch->fetch_logo_url); ?>" alt="<?php echo e($advertiser->name); ?>"
                                                    style="width: 30px">
                                            <?php elseif(!empty($advertiser->logo)): ?>
                                                <img loading="lazy" class="ap-img__main h-auto mr-10"
                                                    src="<?php echo e(\App\Helper\Static\Methods::staticAsset("$advertiser->logo")); ?>"
                                                    alt="<?php echo e($advertiser->name); ?>" style="width: 30px">
                                            <?php else: ?>
                                                <img loading="lazy" class="ap-img__main h-auto mr-10"
                                                    src="<?php echo e(\App\Helper\Static\Methods::isImageShowable($advertiser->logo)); ?>"
                                                    alt="<?php echo e($advertiser->name); ?>" style="width: 30px">
                                            <?php endif; ?></span>
                                    </div>
                                    <a href="<?php echo e(route("publisher.view-advertiser", $advertiser->sid )); ?>" class="fw-semibold" style="color:var(--teal-deep);"><?php echo e($advertiser->name); ?></a>
                                </div>
                            </td>
                            <td><?php echo e($advertiser->commission); ?><?php echo e($advertiser->commission_type == "percentage" ? "%" : $advertiser->commission_type); ?>

                            </td>
                            <td>
                                <?php
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
                                ?>
                                <span class=""><?php echo e($regions); ?></span>
                                <span class="po-details__sTitle">Region</span>
                            </td>
                            <td>
                                <?php if($advertiser->average_payment_time): ?>
                                    <?php echo e($advertiser->average_payment_time); ?> days
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($checkAdmin): ?>
                                    <?php
                                        $status = null;
                                        if (isset($advertiser->advertiser_applies->status)) {
                                            $status = $advertiser->advertiser_applies->status;
                                            
                                        } elseif (isset($advertiser->advertiser_applies_status)) {
                                            $status = $advertiser->advertiser_applies_status;
                                        }
                                    ?>
                                    <?php if($status && $status == \App\Models\AdvertiserApply::STATUS_PENDING): ?>

                                        <span class="badge-soft amber" disabled>
                                            <i class="fas fa-clock color-white"></i> Pending
                                        </span>

                                    <?php elseif($status && $status == \App\Models\AdvertiserApply::STATUS_ACTIVE): ?>

                                        <span class="badge-soft dark-teal" disabled>
                                            <i class="fas fa-check color-white"></i> Joined
                                        </span>

                                    <?php elseif($status && $status == \App\Models\AdvertiserApply::STATUS_REJECTED): ?>

                                        <span class="badge-soft coral" disabled>
                                            <i class="fas fa-times color-white"></i> Rejected
                                        </span>

                                    <?php elseif($status && $status == \App\Models\AdvertiserApply::STATUS_HOLD || $status && $status == \App\Models\AdvertiserApply::STATUS_ADMITAD_HOLD): ?>

                                        <span class="badge-soft amber" disabled>
                                            <i class="fas fa-stop-circle color-white"></i> Hold
                                        </span>

                                    <?php else: ?>

                                        <span class="badge-soft teal" data-toggle="modal" data-target="#modal-basic"
                                            <?php if($advertisers instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                                            onclick="openApplyModal('<?php echo e($advertiser->sid); ?>', '<?php echo e($advertiser->name); ?>', '<?php echo e($advertiser->average_payment_time); ?>', '<?php echo e($regions); ?>')" <?php else: ?>
                                                onclick="window.location.href='<?php echo e(route("publisher.view-advertiser", ['sid' => $advertiser->sid])); ?>'"
                                            <?php endif; ?>>
                                            <span class="fas fa-user-plus follow-icon"></span> Apply
                                        </span>

                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">
                            <h6 class="text-center"><?php echo e(ucfirst(request('section', 'All'))); ?> Brands Records are not available.</h6>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if(count($advertisers) && $advertisers instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
            <div class="table-foot justify-content-end">
                <?php echo e($advertisers->withQueryString()->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
        

<?php /**PATH D:\pub.thousandslink.com\resources\views/template/publisher/advertisers/advertiser-list.blade.php ENDPATH**/ ?>