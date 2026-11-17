@extends("auth.publisher_register.base")

@section("step_form_content")

    <div class="card mb-3" style="max-width:460px; margin-left:auto; margin-right:auto;">
        <div class="card-pad text-center" style="padding:26px 24px;">
            <span class="verify-icon"
                style="width:44px; height:44px; background:var(--teal); color:#fff; margin-bottom:14px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round" width="18" height="18">
                    <path d="M20 6 9 17l-5-5" />
                </svg>
            </span>
            <h4 class="font-display" style="font-size:17px; font-weight:600; margin:0;">Account Created</h4>
        </div>
    </div>

    <!-- Content card -->
    <div class="card step-card mx-auto">
        <div class="card-pad text-center">
            <h2 class="font-display">You're Only One Step Away!</h2>

            <p class="desc" style="margin-bottom:10px;">
                An email has been sent to your inbox. Please verify your email to complete registration.
            </p>
            <p style="font-size:12.5px; color:var(--slate-2); margin-bottom:26px;">
                If you didn't receive the email, check your spam folder or resend it below.
            </p>

            <form id="stepFour" action="javascript:void(0)">
                <button type="submit" class="btn btn-amber">Resend Verification Email</button>
            </form>
        </div>
    </div>


@endsection