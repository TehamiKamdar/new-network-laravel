<?php $__env->startPush('title', 'Notification View'); ?>

<?php if (! $__env->hasRenderedOnce('f65025e0-6487-40ec-9a9a-90ff1643a2ed')): $__env->markAsRenderedOnce('f65025e0-6487-40ec-9a9a-90ff1643a2ed');
$__env->startPush('styles'); ?>

<style>
    .application-faqs .panel {
        margin-bottom: 25px !important;
    }

    .application-faqs .panel {
        background: #fff;
        margin: 10px 0;
    }

    .application-faqs .panel-title .title-foot {
        display: contents;
    }

    .application-faqs .panel-title .category {
        position: absolute;
        right: 30px;
        font-size: 13px;
        line-height: 20px;
        top: 30px;
    }
</style>

<?php $__env->stopPush(); endif; ?>

<?php if (! $__env->hasRenderedOnce('1375bb9e-f3c6-46ea-b991-9386fa179a3b')): $__env->markAsRenderedOnce('1375bb9e-f3c6-46ea-b991-9386fa179a3b');
$__env->startPush('scripts'); ?>

<?php $__env->stopPush(); endif; ?>

<?php $__env->startSection("content"); ?>


    <a href="<?php echo e(route("publisher.notification-center.index")); ?>" class="back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="m15 18-6-6 6-6" />
        </svg>
        Back to notifications
    </a>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="card card-pad">

                <div class="notif-detail-head">
                    <span class="np-icon teal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.6 12 12 20.6 3.4 12 12 3.4z" />
                            <circle cx="12" cy="12" r="2" />
                        </svg>
                    </span>
                    <div>
                        <h1 class="font-display"><?php echo $notification->notification_header; ?></h1>
                        <div class="meta-row">
                            <span class="badge-soft teal"><?php echo e($notification->type); ?></span>
                            <span class="time"><?php echo e(\Carbon\Carbon::parse($notification->created_at)->format('d M, Y')); ?> · <?php echo e($notification->created_at->diffForHumans()); ?></span>
                        </div>
                    </div>
                </div>

                <div class="np-content">
                    <?php echo $notification->content; ?>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-pad">
                <div class="section-head">
                    <h2>Related</h2>
                </div>
                <?php $__currentLoopData = \App\Helper\Static\Methods::getNotifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="notif-item <?php echo e($notification->is_new == 1 ? 'unread' : ''); ?>">
                        <span class="dot-ico"></span>
                        <a href="<?php echo e(route("publisher.notification-center.show", $notification->id)); ?>"  class="txt">
                            <span class="t d-block"><?php echo e($notification->notification_header); ?></span>
                            <span class="time d-block"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a href="notifications.html" class="link-more mt-2">See all notifications
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.publisher.publisher_panel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/notifications/show.blade.php ENDPATH**/ ?>