@include("partial.admin.alert")
<form action="{{ route("publisher.payments.billing-information.update") }}" method="POST" id="billingForm" enctype="multipart/form-data">
    @csrf
    @method("PATCH")

    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="form-label">Billing Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') border-danger @enderror" id="name" name="name" placeholder="Enter Full Billing Name" value="{{ $billing->name ?? null }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone" class="form-label">Billing Phone<span class="text-danger">*</span></label>
                <input type="tel" class="form-control @error('phone') border-danger @enderror" id="phone" name="phone" placeholder="Enter Billing Phone Number" value="{{ $billing->phone ?? null }}">
            </div>
        </div>
        <div class="col-md-9">
            <div class="form-group">
                <label for="address" class="form-label">Billing Address<span class="text-danger">*</span></label>
                <input id="address" name="address" class="form-control @error('address') border-danger @enderror" value="{{ $billing->address ?? null }}" type="text">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="zip_code" class="form-label">Zip Code<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('zip_code') border-danger @enderror" id="zip_code" name="zip_code" placeholder="" value="{{ $billing->zip_code ?? null }}" >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                <select class="js-example-basic-single js-states form-control @error('country') border-danger @enderror" id="country" name="country">
                    <option value="" disabled selected>Please Select</option>
                    @foreach($countries as $country)
                        <option {{ isset($billing->country) && $billing->country == $country['id'] ? "selected" : null }}  value="{{ $country['id'] }}">{{ ucwords($country['name']) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="state" class="form-label">State<span class="text-danger">*</span></label>
                <select class="js-example-basic-single js-states form-control @error('state') border-danger @enderror" id="state" name="state">
                    <option value="" disabled selected>First Select Country / Region</option>
                    @foreach($states as $state)
                        <option {{ isset($billing->state) && $billing->state == $state['id'] ? "selected" : null }}  value="{{ $state['id'] }}">{{ ucwords($state['name']) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="city" class="form-label">City</label>
                <select class="js-example-basic-single js-states form-control @error('city') border-danger @enderror" id="city" name="city">
                    <option value="" disabled selected>First Select State</option>
                    @foreach($cities as $city)
                        <option {{ isset($billing->city) && $billing->city == $city['id'] ? "selected" : null }}  value="{{ $city['id'] }}">{{ ucwords($city['name']) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row border-top mt-4" style="padding-top: 20px;">
        <div class="col-md-6">
            <div class="form-group">
                <label for="company_registration_no" class="form-label">Company Registration Number</label>
                <input type="text" class="form-control @error('company_registration_no') border-danger @enderror" id="company_registration_no" name="company_registration_no" placeholder="Enter Registration Number" value="{{ $billing->company_registration_no ?? null }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tax_vat_no" class="form-label">TAX/VAT Number</label>
                <input type="tel" class="form-control @error('tax_vat_no') border-danger @enderror" id="tax_vat_no" name="tax_vat_no" placeholder="Enter TAX/VAT Number" value="{{ $billing->tax_vat_no ?? null }}">
            </div>
        </div>
    </div>


    <div class="button-group d-flex flex-wrap mt-3" style="justify-content: end;">
        <button class="btn btn-sm text-white btn-primary btn-default btn-squared mr-15 text-capitalize">update</button>
    </div>
</form>
