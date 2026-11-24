@extends("auth.publisher_register.base")

@section("step_form_content")
    <section class="step active">
        <div class="step-heading">
            <h5>Select Promotional Types</h5>
        </div>
        <p class="step-sub">We'll match you with brands and campaign types that fit — you can change this later in Settings.</p>
        <form id="stepTwo" class="stepTwo needs-validation" action="javascript:void(0)">
            <div class="row">    
                <input type="hidden" id="dialCode" name="dialCode" value="{{ $stepTwo['dialCode'] ?? "+1" }}">
                <div class="col-6 form-group mb-3">
                    <label for="company_name" class="lbl">Company Legal Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="company_name" name="company_name"
                        placeholder="Enter company name (Legal)" value="{{ $stepTwo['company_name'] ?? null }}" required>
                        <div class="invalid-feedback">
                            Please enter Company Legal Name
                        </div>
                </div>
                <div class="col-6 form-group mb-3">
                    <div class="countryOption">
                        <label for="entity_type" class="lbl">Entity Type<span
                                class="text-danger">*</span></label>
                        <select class="js-example-basic-single js-states form-control" id="entity_type" name="entity_type" required>
                            <option value="" disabled selected>Please Select</option>
                            @foreach(\App\Models\Publisher::getLegalEntity() as $entity)
                                <option {{ isset($stepTwo['entity_type']) && $stepTwo['entity_type'] == $entity['value'] ? "selected" : null }} value="{{ $entity['value'] }}">
                                    {{ $entity['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please Select Entity Type
                        </div>
                    </div>
                </div>
        
                <div class="col-6 form-group mb-3">
                    <label for="contact_name" class="lbl">Contact name<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder=""
                        value="{{ $stepTwo['contact_name'] ?? null }}" required>
                    <div class="invalid-feedback">
                        Please Contact name
                    </div>
                </div>
                <div class="col-6 form-group mb-3">
                    <label for="phone_number" class="lbl">Phone Number<span
                            class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder=""
                        value="{{ $stepTwo['phone_number'] ?? null }}" required>
                    <div class="invalid-feedback">
                        Please enter Phone Number
                    </div>
                </div>
                <div class="col-6 form-group mb-3">
                    <div class="countryOption">
                        <label for="country" class="lbl">Country / Region<span
                                class="text-danger">*</span></label>
                        <select class="js-example-basic-single js-states form-control" id="country" name="country" required>
                            <option value="" disabled selected>Please Select</option>
                            @foreach($countries as $country)
                                <option {{ isset($stepTwo['country']) && $stepTwo['country'] == $country['id'] ? "selected" : null }} value="{{ $country['id'] }}">{{ ucwords($country['name']) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback">
                        Please Select Country / Region
                    </div>
                </div>
                <div class="col-6 form-group mb-3">
                    <label for="state" class="lbl">State<span class="text-danger">*</span></label>
                    <select class="js-example-basic-single js-states form-control" id="state" name="state" required>
                        <option value="" disabled selected>First Select Country / Region</option>
                        @foreach($states as $state)
                            <option {{ isset($stepTwo['state']) && $stepTwo['state'] == $state['id'] ? "selected" : null }}
                                value="{{ $state['id'] }}">{{ ucwords($state['name']) }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please Select State
                    </div>
                </div>
                <div class="col-6 form-group mb-3">
                    <label for="city" class="lbl">City</label>
                    <select class="js-example-basic-single js-states form-control" id="city" name="city" required>
                        <option value="" disabled selected>First Select State</option>
                        @foreach($cities as $city)
                            <option {{ isset($stepTwo['city']) && $stepTwo['city'] == $city['id'] ? "selected" : null }}
                                value="{{ $city['id'] }}">{{ ucwords($city['name']) }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please Select City
                    </div>
                </div>
                <div class="col-6 form-group mb-3">
                    <label for="postal_code" class="lbl">Postal code<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder=""
                        value="{{ $stepTwo['postal_code'] ?? null }}" required>
                    <div class="invalid-feedback">
                        Please enter Postal code
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="address" class="lbl">Address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address"
                    placeholder="Apartment, suite, unit etc." value="{{ $stepTwo['address'] ?? null }}" required>
                <div class="invalid-feedback">
                    Please enter Full Address
                </div>
            </div>
        
            <div class="d-flex justify-content-between mt-3">
                <a href="javascript:void(0)" onclick="stepFormShow(1)" class="btn btn-soft-dark waves-effect waves-light material-shadow-none">Back</a>
                <button type="submit" id="saveTwoStep" class="btn btn-success waves-effect waves-light">Continue</button>
            </div>
        </form>
    </section>



@endsection