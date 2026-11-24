<!-- Profile Acoount -->
<?php
    $website = App\Models\Website::find($user->active_website_id);
    $company = $user->companies->first();

    $country = App\Models\Country::find($publisher->location_country);
    $city = App\Models\City::find($publisher->location_city);

?>

<div class="profile-summary" style="border-bottom:1px solid var(--line);">
    <div class="avatar">
        <img class="" id="profileImg" 
        src="<?php echo e(\App\Helper\Static\Methods::staticAsset(isset($publisher->image) && $publisher->image ? $publisher->image : "img/blank_profile_img.png")); ?>" alt="profile">
    </div>
    <h3><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></h3>
    <div class="my-3">
        
        <p>ID: <?php echo e($user->sid); ?> · <?php echo e($company->company_name); ?></p>
        <p><?php echo e($user->email); ?> · <span><a href="<?php echo e($website->url); ?>"><?php echo e($website->name); ?></a> (<?php echo e($website->wid); ?>)</span></p>
    </div>
    <form action="javascript:void(0)" id="profile-image-form" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="file" id="file-upload" name="fileUpload" accept="image/*" hidden>

        <label for="file-upload" class="btn btn-outline btn-sm w-100" id="remove_pro_pic">
            Change photo
        </label>
    </form>
</div>
<!-- Profile Acoount End --><?php /**PATH D:\pub.affishare.com\resources\views/template/publisher/settings/sidebar.blade.php ENDPATH**/ ?>