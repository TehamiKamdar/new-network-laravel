<?php if (! $__env->hasRenderedOnce('fe31c5a5-655e-4bdb-a78c-636cdf09f05d')): $__env->markAsRenderedOnce('fe31c5a5-655e-4bdb-a78c-636cdf09f05d');
$__env->startPush('styles'); ?>

<?php $__env->stopPush(); endif; ?>

<?php $__env->startPush('title', 'Dashboard'); ?>

<?php if (! $__env->hasRenderedOnce('e06b57f8-af62-4077-98c9-06a7147511ea')): $__env->markAsRenderedOnce('e06b57f8-af62-4077-98c9-06a7147511ea');
$__env->startPush('scripts'); ?>
<?php $__env->stopPush(); endif; ?>

<?php $__env->startSection("content"); ?>

    <?php if(auth()->user()->status == "active"): ?>
        <?php echo $__env->make("template.publisher.dashboard.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make("template.publisher.dashboard.not_active", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.publisher.publisher_panel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/dashboard/index.blade.php ENDPATH**/ ?>