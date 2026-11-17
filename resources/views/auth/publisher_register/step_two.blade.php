@extends("auth.publisher_register.base")

@section("step_form_content")
    <div class="card step-card" data-select2-id="7">
        <div class="card-pad" data-select2-id="6">
            <div class="kicker">Step 2 of 4</div>
            <h2 class="font-display">Select Promotional Types</h2>
            <p class="desc">We'll match you with brands and campaign types that fit — you can change this later in Settings.
            </p>


            <form id="stepTwo" action="javascript:void(0)">
                <input type="hidden" id="dialCode" name="dialCode" value="{{ $stepTwo['dialCode'] ?? "+1" }}">
                <div class="form-group mb-3">
                    <label for="company_name" class="form-label">Company Legal Name<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="company_name" name="company_name"
                        placeholder="Enter company name (Legal)" value="{{ $stepTwo['company_name'] ?? null }}">
                </div>
                <div class="form-group mb-3">
                    <div class="countryOption">
                        <label for="entity_type" class="form-label">Entity Type<span
                                class="text-danger">*</span></label>
                        <select class="js-example-basic-single js-states form-control" id="entity_type" name="entity_type">
                            <option value="" disabled selected>Please Select</option>
                            @foreach(\App\Models\Publisher::getLegalEntity() as $entity)
                                <option {{ isset($stepTwo['entity_type']) && $stepTwo['entity_type'] == $entity['value'] ? "selected" : null }} value="{{ $entity['value'] }}">
                                    {{ $entity['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="contact_name" class="form-label">Contact name<span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder=""
                        value="{{ $stepTwo['contact_name'] ?? null }}">
                </div>
                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label">phone number<span
                            class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder=""
                        value="{{ $stepTwo['phone_number'] ?? null }}">
                </div>
                <div class="form-group mb-3">
                    <div class="countryOption">
                        <label for="country" class="form-label">Country / Region<span
                                class="text-danger">*</span></label>
                        <select class="js-example-basic-single js-states form-control" id="country" name="country">
                            <option value="" disabled selected>Please Select</option>
                            @foreach($countries as $country)
                                <option {{ isset($stepTwo['country']) && $stepTwo['country'] == $country['id'] ? "selected" : null }} value="{{ $country['id'] }}">{{ ucwords($country['name']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="state" class="form-label">State<span class="text-danger">*</span></label>
                    <select class="js-example-basic-single js-states form-control" id="state" name="state">
                        <option value="" disabled selected>First Select Country / Region</option>
                        @foreach($states as $state)
                            <option {{ isset($stepTwo['state']) && $stepTwo['state'] == $state['id'] ? "selected" : null }}
                                value="{{ $state['id'] }}">{{ ucwords($state['name']) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="city" class="form-label">City</label>
                    <select class="js-example-basic-single js-states form-control" id="city" name="city">
                        <option value="" disabled selected>First Select State</option>
                        @foreach($cities as $city)
                            <option {{ isset($stepTwo['city']) && $stepTwo['city'] == $city['id'] ? "selected" : null }}
                                value="{{ $city['id'] }}">{{ ucwords($city['name']) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="postal_code" class="form-label">Postal code<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder=""
                        value="{{ $stepTwo['postal_code'] ?? null }}">
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="address" name="address"
                        placeholder="Apartment, suite, unit etc." value="{{ $stepTwo['address'] ?? null }}">
                </div>

                <div class="step-foot">
                    <a href="javascript:void(0)" onclick="stepFormShow(1)" class="btn btn-outline">Back</a>
                    <span class="step-count">2 / 4 complete</span>
                    <button type="submit" id="saveTwoStep" class="btn btn-primary">Save &amp; Next</button>
                </div>
            </form>
        </div>
    </div>

@endsection