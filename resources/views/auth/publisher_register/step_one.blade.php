@extends("auth.publisher_register.base")

@section("step_form_content")

    <section class="step active" data-step="1">
        <div class="step-heading">
            <h5>Create your account</h5>
        </div>
        <p class="step-sub">Get your free Velzon account now</p>

            <form id="stepOne" class="stepOne needs-validation" novalidate action="javascript:void(0)">
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="lbl" for="first_name">First name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control w-100" placeholder="Amara" required>
                        <div class="invalid-feedback">
                            Please enter First name
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="lbl">Last name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control w-100" placeholder="Khan" required>
                        <div class="invalid-feedback">
                            Please enter Last name
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="lbl">Handle</label>
                        <input type="text" id="user_name" name="user_name" class="form-control w-100" placeholder="username" required>
                        <div class="invalid-feedback">
                            Please enter Handle
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="lbl">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control w-100" placeholder="amarakhan@example.com" required>
                        <div class="invalid-feedback">
                            Please enter Email Address
                        </div>
                    </div>
                    <div class="col-6 mb-3 position-relative">
                        <label class="lbl">Password</label>
                        <input type="password" id="password" name="password" class="form-control w-100"
                            placeholder="Min 8. Characters" required>
                        <div class="fa fa-fw fa-eye-slash field-icon" style="top: 72%" id="password-icon"
                            onclick="showPassword('password')"></div>
                        <div class="invalid-feedback">
                            Please enter Password
                        </div>
                    </div>
                    <div class="col-6 mb-3 position-relative">
                        <label class="lbl">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control w-100" placeholder="Same as password" required>
                        <div class="fa fa-fw fa-eye-slash field-icon" style="top: 72%" id="password_confirmation-icon"
                            onclick="showPassword('password_confirmation')"></div>
                        <div class="invalid-feedback">
                            Please enter same as password
                        </div>
                    </div>
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input me-2" type="checkbox" id="agree" name="agree" value="1" required {{ isset($stepOne['agree']) && $stepOne['agree'] ? "checked" : null }}>
                    <label class="form-check-label" for="agree" style="font-size:12.5px;"> I Agree with
                        the<a href="https://affentro.com/terms&conditions.html"> Terms and
                            Conditions</a>.</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="terms" name="terms" hidden
                        value="{{ $stepOne['terms'] ?? null }}" />
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('login', ['type' => 'partner']) }}" class="btn btn-soft-dark waves-effect waves-light material-shadow-none">Back</a>
                    <button type="submit" class="btn btn-success waves-effect waves-light">Continue</i></button>
                </div>
            </form>
        </div>
    </div>

@endsection