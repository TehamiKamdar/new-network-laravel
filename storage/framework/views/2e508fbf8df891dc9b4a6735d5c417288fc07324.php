<?php if (! $__env->hasRenderedOnce('a3f06634-7646-4f25-835e-64abf26d0f30')): $__env->markAsRenderedOnce('a3f06634-7646-4f25-835e-64abf26d0f30');
$__env->startPush('styles'); ?>

<?php $__env->stopPush(); endif; ?>

<?php $__env->startPush('title', 'Dashboard'); ?>

<?php if (! $__env->hasRenderedOnce('487db4e9-3b65-47a8-a417-0ac763cd05bd')): $__env->markAsRenderedOnce('487db4e9-3b65-47a8-a417-0ac763cd05bd');
$__env->startPush('scripts'); ?>
<?php $__env->stopPush(); endif; ?>

<?php $__env->startSection("content"); ?>

    <?php if(auth()->user()->status == "active"): ?>
        <?php echo $__env->make("template.publisher.dashboard.app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php else: ?>
        <?php echo $__env->make("template.publisher.dashboard.not_active", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.publisher.publisher_panel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.thousandslink.com\resources\views/template/publisher/dashboard/index.blade.php ENDPATH**/ ?>