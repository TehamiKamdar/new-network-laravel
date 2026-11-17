@include("partial.admin.alert")
<form action="{{ route("publisher.changes.password-update") }}" method="POST" id="changePasswordForm" enctype="multipart/form-data">
    @csrf
    @method("PATCH")
    <div class="row g-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="current_password" class="form-label">Current Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="password" class="form-label">New password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm New Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-3" style="text-align: end">
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </div>
    </div>
</form>
