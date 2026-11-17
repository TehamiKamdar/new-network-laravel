@extends("auth.publisher_register.base")

@section("step_form_content")

    <div class="card step-card">

        <div class="loader-overlay" id="showLoader">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </div>
        <div class="card-pad">
            <div class="kicker">Step 1 of 4</div>
            <h2 class="font-display">Tell us about you</h2>
            <p class="desc">This appears on your public partner profile and on brand-facing proposals.</p>

            <form id="stepOne" class="stepOne" action="javascript:void(0)">
                <div class="mb-3">
                    <label class="form-label">First name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control w-100" placeholder="Amara">
                </div>
                <div class="mb-3">
                    <label class="form-label">Last name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control w-100" placeholder="Khan">
                </div>
                <div class="mb-3">
                    <label class="form-label">Handle</label>
                    <input type="text" id="user_name" name="user_name" class="form-control w-100" placeholder="username">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control w-100" placeholder="amarakhan@example.com">
                </div>
                <div class="mb-3 position-relative">
                    <label class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control w-100" placeholder="Min 8. Characters">
                    <div class="fa fa-fw fa-eye-slash field-icon" style="top: 72%" id="password-icon" onclick="showPassword('password')"></div>
                </div>
                <div class="mb-3 position-relative">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control w-100" placeholder="Same as password">
                    <div class="fa fa-fw fa-eye-slash field-icon" style="top: 72%" id="password_confirmation-icon" onclick="showPassword('password_confirmation')"></div>
                </div>
                <div class="form-check mb-4 mt-3">
                    <input class="form-check-input me-2" type="checkbox" id="agree" name="agree" value="1" {{ isset($stepOne['agree']) && $stepOne['agree'] ? "checked" : null }}>
                    <label class="form-check-label" for="agree" style="font-size:12.5px;color:var(--slate);"> I Agree with the<a href="https://affentro.com/terms&conditions.html" style="color: var(--teal)"> Terms and Conditions</a>.</label>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="terms" name="terms" hidden value="{{ $stepOne['terms'] ?? null }}" />
                </div>
                
                <div class="step-foot">
                    <a href="{{ route('login', ['type' => 'partner']) }}" class="btn btn-outline">Back</a>
                    <span class="step-count">1 / 4 complete</span>
                    <button type="submit" class="btn btn-primary">Save &amp; Next</i></button>
                </div>
            </form>
        </div>
    </div>

@endsection