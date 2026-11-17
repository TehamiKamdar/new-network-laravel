@extends("auth.publisher_register.base")

@section("step_form_content")

    <div class="card step-card" data-select2-id="7">
        <div class="card-pad" data-select2-id="6">
            <div class="kicker">Step 3 of 4</div>
            <h2 class="font-display">Tell us about your website</h2>
            <p class="desc">This information will help us understand your audience and match you with relevant campaigns.
            </p>
            <form id="stepThree" action="javascript:void(0)">

                <div class="form-group mb-3">
                    <label for="website_url" class="form-label">Website URL<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="website_url" name="website_url"
                        placeholder="https://www.domain.com">
                </div>

                <div class="form-group mb-3">
                    <label for="brief_introduction" class="form-label">Brief Introduction<span
                            class="text-danger">*</span></label>
                    <textarea class="form-control" id="brief_introduction" name="brief_introduction" rows="3"
                        placeholder="Please write a brief introduction to help us and the brand get to know you quickly."></textarea>
                </div>

                <div class="form-group mb-3">
                    <div class="countryOption">
                        <label for="categories" class="form-label">Category (Max. 4)<span
                                class="text-danger">*</span></label>
                        <div class="atbd-select ">
                            <select name="categories[]" id="categories" class="form-control " multiple="multiple">
                                @foreach($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="countryOption">
                        <label for="partner_types" class="form-label">Partner Type (Max. 3)<span
                                class="text-danger">*</span></label>
                        <div class="atbd-select ">
                            <select name="partner_types[]" id="partner_types" class="form-control" multiple="multiple">
                                @foreach($partners as $partner)
                                    <option value="{{ $partner['id'] }}">{{ $partner['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="countryOption">
                        <label for="website_country" class="form-label">Website Country / Region<span
                                class="text-danger">*</span></label>
                        <select class="js-example-basic-single js-states form-control" id="website_country"
                            name="website_country">
                            <option value="" disabled selected>Please Select</option>
                            @foreach($countries as $country)
                                <option {{ isset($stepTwo['country']) && $stepTwo['country'] == $country['id'] ? "selected" : null }} value="{{ $country['id'] }}">{{ ucwords($country['name']) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="monthly_traffic" class="form-label">Monthly Traffic<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="monthly_traffic" name="monthly_traffic"
                                placeholder="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="monthly_page_views" class="form-label">Monthly Page Views<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="monthly_page_views" name="monthly_page_views"
                                placeholder="">
                        </div>
                    </div>
                </div>

                <div class="step-foot">
                    <a href="javascript:void(0)" onclick="stepFormShow(2)" class="btn btn-outline">Back</a>
                    <span class="step-count">3 / 4 complete</span>
                    <button type="submit" id="saveTwoStep" class="btn btn-primary">Save &amp; Next</button>
                </div>
            </form>
        </div>
    </div><!-- ends: .card -->

@endsection