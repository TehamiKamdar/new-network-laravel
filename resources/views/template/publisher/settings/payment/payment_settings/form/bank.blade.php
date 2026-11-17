<div class="row g-3">
    <div class="text-capitalize alert alert-primary alert-dismissible fade show" role="alert">
        <div class="alert-content">
            We transfer funds in Australian Dollars (AUD) at the current date conversion rates.
        </div>
        <button type="button" class="btn-close text-capitalize" data-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="col-sm-6 col-12">
        <label for="bankCountry" class="form-label">
            Bank Country
        </label>
        <select class="js-example-basic-single js-states form-control" id="bank_location" name="bank_location" @if(!$isPaymentChangeable) disabled @endif>
            <option value="">Select Bank Location</option>
            @foreach($countries as $country)
                <option {{ isset($payment->bank_location) && $payment->bank_location == $country['id'] ? "selected" : null }}  value="{{ $country['id'] }}">{{ ucwords($country['name']) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-sm-6 col-12">
        <label for="account_holder_name" class="form-label">Account Holder Name</label>
        <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" placeholder="Enter Bank Account Holder Name" value="{{ $payment->account_holder_name ?? '' }}" @if(!$isPaymentChangeable) disabled @endif>
    </div>
    <div class="col-sm-6 col-12">
        <label for="account_number" id="account_number_text" class="form-label">Bank Account Number</label>
        <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" placeholder="Enter Complete Bank Account Number / IBAN / Routing" value="{{ $payment->bank_account_number ?? '' }}" @if(!$isPaymentChangeable) disabled @endif>
    </div>
    @if(isset($payment->bank_location) && $payment->bank_location == 166)

    @else
        <div class="col-sm-3 col-12" id="bankCodeContent">
            <label for="swift_number" class="form-label">BIC/SWIFT Code/BSB</label>
            <input type="text" class="form-control" id="bank_code" name="bank_code" placeholder="Enter BIC/SWIFT Code/BSB/ABA" value="{{ $payment->bank_code ?? '' }}" @if(!$isPaymentChangeable) disabled @endif>
        </div>
        <div class="col-sm-3 col-12" id="bankAccountTypeContent">
            <label for="bankCountry" class="form-label">
                Bank Account Type
            </label>
            <select class="js-example-basic-single js-states form-control" id="account_type" name="account_type"  @if(!$isPaymentChangeable) disabled @endif>
                <option value="">Select Account Type</option>
                <option {{ isset($payment->account_type) && $payment->account_type == "checking" ? "selected" : '' }} value="checking">Checking</option>
                <option {{ isset($payment->account_type) && $payment->account_type == "saving" ? "selected" : '' }} value="saving">Saving</option>
            </select>
        </div>
    @endif
    <small class="form-group text-muted">
        <p> <i class="fas fa-exclamation-circle text-warning"></i> 2% processing fee will be charged, capped to AUD 30.00.</p>
    </small>
</div>
