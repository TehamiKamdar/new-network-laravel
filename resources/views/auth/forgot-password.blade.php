@extends("layouts.panel_guest")

@section("content")

    <div class="auth-shell">

        <!-- ============ VISUAL SIDE ============ -->
        <div class="auth-visual">
            <div class="vbrand">
                <img src="{{asset('img/logo.png')}}" height="40">
            </div>

            <div class="copy">
                <div class="eyebrow">Account Security</div>
                <h2>Forgot Password?</h2>
                <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
            </div>

            <!-- Same directional / security-themed illustration used across the auth flow -->
            <svg class="cta-graphic" viewBox="0 0 340 260" fill="none" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path d="M20 210 C 70 210, 90 150, 130 150 S 190 90, 230 90 S 280 40, 320 40" stroke="#2E3C5C"
                    stroke-width="2" stroke-dasharray="4 6" />
                <path d="M20 210 C 70 210, 90 150, 130 150 S 190 90, 230 90 S 280 40, 320 40" stroke="url(#lineGrad2)"
                    stroke-width="3" stroke-linecap="round" />
                <defs>
                    <linearGradient id="lineGrad2" x1="20" y1="210" x2="320" y2="40" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#0F6E5F" />
                        <stop offset="1" stop-color="#F2A93B" />
                    </linearGradient>
                </defs>
                <circle cx="20" cy="210" r="5" fill="#0F6E5F" />
                <circle cx="130" cy="150" r="5" fill="#1D8C79" />
                <circle cx="230" cy="90" r="5" fill="#F2A93B" />
                <g transform="translate(298,18)">
                    <circle cx="22" cy="22" r="22" fill="#F2A93B" />
                    <path d="M22 12v10l7 4" stroke="#141B29" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" />
                </g>
                <path d="M320 40 L306 30 M320 40 L308 52" stroke="#F2A93B" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" />
                <g transform="translate(40,60)">
                    <rect width="112" height="30" rx="9" fill="#1D2739" stroke="#324062" />
                    <text x="12" y="19" fill="#C9D2DE" font-family="IBM Plex Mono" font-size="11">Link verified ✓</text>
                </g>
                <g transform="translate(150,190)">
                    <rect width="118" height="30" rx="9" fill="#1D2739" stroke="#324062" />
                    <text x="12" y="19" fill="#C9D2DE" font-family="IBM Plex Mono" font-size="11">Encrypted &amp;
                        secure</text>
                </g>
            </svg>

            <div class="proof">
                <div>
                    <div class="p-val">256-bit</div>
                    <div class="p-lab">Encryption</div>
                </div>
                <div>
                    <div class="p-val">312+</div>
                    <div class="p-lab">Active Brands</div>
                </div>
                <div>
                    <div class="p-val">4.8/5</div>
                    <div class="p-lab">Partner Rating</div>
                </div>
            </div>
        </div>

        <!-- ============ FORM SIDE ============ -->
        <div class="auth-form-side">
            <div class="auth-card">

                <h1 class="font-display" style="font-size:26px;font-weight:600;margin-bottom:4px;">Write Your Email Address</h1>
                <p style="font-size:13.5px;color:var(--slate);margin-bottom:24px;">We will send you a link to reset your password.</p>

                @include("partial.admin.alert")


                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 6h18v12H3z" />
                                <path d="m3 7 9 6 9-6" />
                            </svg>
                            <input id="email" class="form-control w-100" type="email" name="email" value="{{ old('email') }}" required autofocus  placeholder="Please Enter Email Address">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </form>

            </div>
        </div>

    </div>
@endsection
