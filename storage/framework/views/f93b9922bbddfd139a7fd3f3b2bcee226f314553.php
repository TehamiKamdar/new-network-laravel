<?php $__env->startSection("content"); ?>
<!-- end row -->

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4 card-bg-fill">

            <div class="card-body p-4">
                <div class="mb-4">
                    <div class="avatar-lg mx-auto">
                        <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                            <i class="ri-mail-line"></i>
                        </div>
                    </div>
                </div>

                <div class="p-2 mt-4">
                    <div class="text-muted text-center mb-4 mx-lg-3">
                        <h4>Verify Your Email</h4>
                        <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                        <form class="mb-3" method="POST" action="<?php echo e(route('verification.send')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success w-100">
                                <?php echo e(__('Resend Verification Email')); ?>

                            </button>
                        </form>
                        <span>or you can</span>
                        <form method="POST" class="mt-3" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>   
                            <button type="submit" class="btn btn-danger w-100 waves-effect waves-light"><?php echo e(__('Log Out')); ?></button>
                        
                        </form> 
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.panel_guest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/auth/verify-email.blade.php ENDPATH**/ ?>