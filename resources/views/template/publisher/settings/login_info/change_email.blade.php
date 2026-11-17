@include("partial.admin.alert")
<div class="d-flex justify-content-between align-items-end">
    <div class="col-md-9">
        <div class="form-group">
            <label for="email" class="form-label">User Email</label>
            <input type="email" disabled class="form-control" id="email" name="email" placeholder="User Email" value="{{ $user->email ?? null }}">
        </div>
    </div>
    <div class="col-md-2" style="text-align: end;">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#changeEmailModal" class="btn btn-primary w-100">Change Email</a>
    </div>
</div>

<div class="changeEmailModal modal fade show" id="changeEmailModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <form action="{{ route("publisher.changes.email-update") }}" method="post" id="changeEmailForm">
            @method("PATCH")
            @csrf
            <div class="modal-content modal-bg-white">
                <div class="modal-header">
                    <h6 class="modal-title" id="modelTitle"></h6>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="form-label">New Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email_confirmation" class="form-label">Confirm Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email_confirmation" name="email_confirmation" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" id="closeModal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
