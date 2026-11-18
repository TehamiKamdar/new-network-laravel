<!-- Start Table Responsive -->

<!-- Start Table Responsive -->
<div class="card-body">
    <div>
        <div class="table-responsive table-card mb-3">
            <table class="table align-middle table-nowrap mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Advertiser</th>
                        <th scope="col">Tracking Short Link</th>
                        <th scope="col">Tracking Link</th>
                        <th scope="col">Hits</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php if(count($links)): ?>
                        <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="name">
                                    <?php echo e($link->name); ?> <br>
                                    <span class="fs-12 color-gray">(<?php echo e($link->sid ?? 0); ?>)</span>
                                </td>
                                <td class="createBy">
                                    <span class="url-text"><?php echo e(\Illuminate\Support\Str::limit($link->tracking_url_short ?? "-", 40, $end = '...')); ?></span>
                                    <button class="copy-btn btn btn-sm btn-success bg-success-subtle text-success" data-copy="<?php echo e($link->tracking_url_short); ?>"
                                        aria-label="Copy short URL">
                                        <span class="tip">Copied!</span>
                                        <svg class="icon-copy" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <rect x="9" y="9" width="12" height="12" rx="2" />
                                            <path d="M5 15V5a2 2 0 0 1 2-2h10" />
                                        </svg>
                                        <svg class="icon-check" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2.5">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="apikey">
                                    <span class="url-text">
                                        <?php echo e(\Illuminate\Support\Str::limit($link->tracking_url_long ?? "-", 60, $end = '...')); ?>

                                    </span>
                                    <button class="copy-btn btn btn-sm btn-success bg-success-subtle text-success" data-copy="<?php echo e($link->tracking_url_long); ?>"
                                        aria-label="Copy tracking URL">
                                        <span class="tip">Copied!</span>
                                        <svg class="icon-copy" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <rect x="9" y="9" width="12" height="12" rx="2" />
                                            <path d="M5 15V5a2 2 0 0 1 2-2h10" />
                                        </svg>
                                        <svg class="icon-check" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2.5">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                    </button>
                                </td>
                                <td><?php echo e($link->hits); ?></td>
                            </tr>

                            <!-- End: tr -->
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                <h6 class="text-center">Text Link Data Not Exist</h6>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(count($links) && $links instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
            <div class="d-flex justify-content-end mt-3">
                <div class="pagination-wrap hstack gap-2">
                    <?php echo e($links->withQueryString()->links()); ?>

                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/creatives/text-links/list_view.blade.php ENDPATH**/ ?>