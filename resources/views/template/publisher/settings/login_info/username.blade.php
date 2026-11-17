@include("partial.admin.alert")
<form action="{{ route("publisher.changes.username-update") }}" method="POST" id="userNameUpdateForm" enctype="multipart/form-data">
    @csrf
    @method("PATCH")
    <div class="d-flex justify-content-between align-items-end">
        <div class="col-md-9">
            <div class="form-group">
                <label for="user_name" class="form-label">User Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" value="{{ $user->user_name ?? null }}">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </div>
    </div>
</form>
