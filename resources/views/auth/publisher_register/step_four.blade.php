@extends("auth.publisher_register.base")

@section("step_form_content")

    <div class="card shadow-none mx-auto mb-3">
        <div class="text-center" style="padding:26px 24px;">
            <span class="bg-success-subtle text-success d-block align-content-center mx-auto rounded-circle" style="width: 70px;height: 70px;margin-bottom:14px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" width="30" height="30">
                    <path d="M20 6 9 17l-5-5"></path>
                </svg>
            </span>
            
            <h2>Account Created</h2>

            <p class="desc" style="margin-bottom:10px;">
                An email has been sent to your inbox. Please verify your email to complete registration.
            </p>
            <p style="font-size:12.5px; color:var(--slate-2); margin-bottom:26px;">
                If you didn't receive the email, check your spam folder or resend it below.
            </p>

            <form id="stepFour" action="javascript:void(0)">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Resend Verification Email</button>
            </form>
        </div>
    </div>


@endsection