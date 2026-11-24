<?php $__env->startSection("step_form_content"); ?>

    <section class="step active">
        <div class="step-heading">
            <h5>Website Details</h5>
        </div>
        <p class="step-sub">This information will help us understand your audience and match you with relevant campaigns.</p>
        <form id="stepThree" class="needs-validation" novalidate action="javascript:void(0)">

            <div class="form-group mb-3">
                <label for="website_url" class="lbl">Website URL<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="website_url" name="website_url" placeholder="https://www.domain.com" required>
                    <div class="invalid-feedback">
                        Please enter Valid Website URL
                    </div>
            </div>

            <div class="form-group mb-3">
                <label for="brief_introduction" class="lbl">Brief Introduction<span
                        class="text-danger">*</span></label>
                <textarea class="form-control" id="brief_introduction" name="brief_introduction" rows="3"
                    placeholder="Please write a brief introduction to help us and the brand get to know you quickly." required></textarea>
                    <div class="invalid-feedback">
                        Please enter Brief Introduction
                    </div>
            </div>

            <div class="form-group mb-3">
                <div class="countryOption">
                    <label for="categories" class="lbl">Category (Max. 4)<span
                            class="text-danger">*</span></label>
                    <div class="atbd-select ">
                        <select name="categories[]" id="categories" class="form-control " multiple="multiple" required>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <div class="invalid-feedback">
                        Please Select Category
                    </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="countryOption">
                    <label for="partner_types" class="lbl">Partner Type (Max. 3)<span
                            class="text-danger">*</span></label>
                    <div class="atbd-select ">
                        <select name="partner_types[]" id="partner_types" class="form-control" multiple="multiple" required>
                            <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($partner['id']); ?>"><?php echo e($partner['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="invalid-feedback">
                            Please Select Partner Type
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="countryOption">
                    <label for="website_country" class="lbl">Website Country / Region<span
                            class="text-danger">*</span></label>
                    <select class="js-example-basic-single js-states form-control" id="website_country"
                        name="website_country" required>
                        <option value="" disabled selected>Please Select</option>
                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php echo e(isset($stepTwo['country']) && $stepTwo['country'] == $country['id'] ? "selected" : null); ?> value="<?php echo e($country['id']); ?>"><?php echo e(ucwords($country['name'])); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <div class="invalid-feedback">
                        Please Select Country / Region
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="monthly_traffic" class="lbl">Monthly Traffic<span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="monthly_traffic" name="monthly_traffic"
                    placeholder="" required>
                    <div class="invalid-feedback">
                        Please enter Monthly Traffic
                    </div>
            </div>
            <div class="form-group mb-3">
                <label for="monthly_page_views" class="lbl">Monthly Page Views<span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control" id="monthly_page_views" name="monthly_page_views"
                    placeholder="" required>
                    <div class="invalid-feedback">
                        Please enter Monthly Page Views
                    </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <a href="javascript:void(0)" onclick="stepFormShow(2)" class="btn btn-soft-dark waves-effect waves-light material-shadow-none">Back</a>
                <button type="submit" id="saveTwoStep" class="btn btn-success waves-effect waves-light">Continue</button>
            </div>
        </form>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("auth.publisher_register.base", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\pub.affishare.com\resources\views/auth/publisher_register/step_three.blade.php ENDPATH**/ ?>