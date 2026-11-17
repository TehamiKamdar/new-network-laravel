<div class="row g-3">
    <div class="col-sm-6 col-12">
        <label for="paypal_holder_name" class="form-label">Payoneer Account Name</label>
        <input type="text" class="form-control" id="payoneer_holder_name" name="payoneer_holder_name" placeholder="Enter Payoneer Account Holder Name" value="{{ $payment->payoneer_holder_name ?? null }}" @if(!$isPaymentChangeable) disabled @endif>
    </div>
    <div class="col-sm-6 col-12">
        <label for="pyoneer_email" class="form-label">Payoneer Email Address</label>
        <input type="text" class="form-control" id="payoneer_email" name="payoneer_email" placeholder="Enter Payoneer Email Address" value="{{ $payment->payoneer_email ?? null }}" @if(!$isPaymentChangeable) disabled @endif>
    </div>
    <small class="form-group text-muted">
        <p> <i class="fas fa-exclamation-circle text-warning"></i> 2% processing fee will be charged, capped to USD 20.00.</p>
    </small>
</div>
