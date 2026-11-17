<?php if($errors->any()): ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

<?php elseif(Session::has('success')): ?>

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <p style="margin-top:0rem; margin-bottom: 0rem;"><?php echo e(Session::get('success')); ?></p>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

    <?php
        Session::forget('success');
    ?>

<?php elseif(Session::has('status')): ?>

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <p style="margin-top:0rem; margin-bottom: 0rem;"><?php echo e(Session::get('status')); ?></p>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

    <?php
        Session::forget('success');
    ?>

<?php elseif(Session::has('high_priority_error')): ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <p style="margin-top:0rem; margin-bottom: 0rem;"><?php echo e(Session::get('high_priority_error')); ?></p>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

    <?php
        Session::forget('high_priority_error');
    ?>

<?php elseif(Session::has('error')): ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="alert-content">
            <p style="margin-top:0rem; margin-bottom: 0rem;"><?php echo Session::get('error'); ?></p>
            <button type="button" class="btn-close text-capitalize" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
        </div>
    </div>

    <?php
        Session::forget('error');
    ?>

<?php endif; ?>
<?php /**PATH D:\pub.thousandslink.com\resources\views/partial/admin/alert.blade.php ENDPATH**/ ?>