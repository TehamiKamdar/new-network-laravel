@extends("layouts.panel_guest")

@pushonce('styles')
<style>
    .loaded {
        background: #fff !important;
    }

    .coming-soon {
        padding: unset !important;
    }

    .coming-soon__body {
        margin-top: 68px !important;
        margin-bottom: unset !important;
        padding: 0 30px !important;
    }
</style>
@endpushonce

@section("content")
    <div class="verify-shell">

        <!-- top bar: just a logout action, same pattern used across the app -->
        <div class="verify-topbar">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf   
                <button type="submit" class="btn btn-sm" style="background:var(--coral-tint); color:var(--coral);">{{ __('Log Out') }}</button>
            
            </form> 
        </div>

        <div class="verify-main">
            <div class="verify-card">

                <div class="step-brand justify-content-center">
                    <img src="{{asset('img/logo.png')}}" width="300px" height="60px">
                </div>  

                <h1 class="font-display">Email Verification Required</h1>
                <p class="subtitle">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <!-- Shown after a resend request succeeds (e.g. session('status') == 'verification-link-sent') -->
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <div class="alert-content">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form class="form-inline justify-content-center my-n10 subscribe-bar" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-amber" style="padding:13px 28px;">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>
            </div>
        </div>

    </div>

@endsection