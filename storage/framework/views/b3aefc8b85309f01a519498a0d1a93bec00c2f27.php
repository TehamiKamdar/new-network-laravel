<?php
    $notificationsCount = \App\Helper\Static\Methods::newNotificationCount();
?>

<?php if($notificationsCount == 0): ?>
    <style>
        .navbar-right__menu .nav-notification .nav-item-toggle:before {
            background: unset;
        }
    </style>
<?php endif; ?>
<header class="app-topbar">
    <button class="menu-toggle" data-sidebar-toggle aria-label="Toggle menu">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round">
            <path d="M4 7h16M4 12h16M4 17h16" />
        </svg>
    </button>
    <div class="topbar-title">
        <span class="eyebrow current-date">Loading...</span>
        <h1><?php echo $__env->yieldPushContent('title'); ?></h1>
    </div>

    <div class="dropdown">
        <button class="icon-btn" data-bs-toggle="dropdown" aria-label="Notifications"><span class="dot"></span>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M6 8a6 6 0 1 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                <path d="M13.7 21a2 2 0 0 1-3.4 0" />
            </svg>
        </button>
        <div class="dropdown-menu dropdown-menu-end notif-menu">
            <div class="notif-head">
                Notifications
                <span class="badge-soft amber"><?php echo e($notificationsCount); ?> Unread</span>
            </div>
            <div class="notif-list">
                <?php $__currentLoopData = \App\Helper\Static\Methods::getNotifications(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="notif-item <?php echo e($notification->is_new == 1 ? 'unread' : ''); ?>">
                        <span class="dot-ico"></span>
                        <a href="<?php echo e(route("publisher.notification-center.show", $notification->id)); ?>"  class="txt">
                            <span class="t d-block"><?php echo e($notification->notification_header); ?></span>
                            <span class="time d-block"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="notif-foot"><a href="<?php echo e(route("publisher.notification-center.index")); ?>">View all notifications</a></div>
        </div>
    </div>

    <div class="dropdown">
        <button class="profile-btn" data-bs-toggle="dropdown">
            <span
                class="avatar"><?php echo e(strtoupper(substr(auth()->user()->first_name, 0, 1) . substr(auth()->user()->last_name, 0, 1))); ?></span>
            <span class="who">
                <span class="name d-block"><?php echo e(auth()->user()->first_name . ' ' . auth()->user()->last_name); ?></span>
                <span class="role d-block">(<?php echo e(auth()->user()->sid); ?>)</span>
            </span>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="m6 9 6 6 6-6" />
            </svg>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="<?php echo e(route("publisher.profile.basic-information.index")); ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21c1.6-4 6-6 8-6s6.4 2 8 6" />
                    </svg>
                    My profile
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="<?php echo e(route("publisher.account.login-info.index")); ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3" />
                        <path
                            d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1a2 2 0 1 1-2.9 2.9l-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1.1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1a2 2 0 1 1-2.9-2.9l.1-.1a1.7 1.7 0 0 0 .3-1.9 1.7 1.7 0 0 0-1.6-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.6-1 1.7 1.7 0 0 0-.3-1.9l-.1-.1a2 2 0 1 1 2.9-2.9l.1.1a1.7 1.7 0 0 0 1.9.3H9a1.7 1.7 0 0 0 1-1.6V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1a2 2 0 1 1 2.9 2.9l-.1.1a1.7 1.7 0 0 0-.3 1.9V9a1.7 1.7 0 0 0 1.6 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.6 1z" />
                    </svg>
                    Settings
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item danger" href="javascript:void(0)"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <path d="M16 17l5-5-5-5" />
                        <path d="M21 12H9" />
                    </svg>
                    Log out
                </a>
                <form id="logoutform" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo e(csrf_field()); ?>

                </form>
            </li>
        </ul>
    </div>
</header><?php /**PATH D:\pub.thousandslink.com\resources\views/partial/publisher/header.blade.php ENDPATH**/ ?>