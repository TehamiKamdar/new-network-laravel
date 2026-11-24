@extends("layouts.panel_guest")

@section("content")
<!-- end row -->

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4 card-bg-fill">

            <div class="card-body p-4">
                <div class="mb-4">
                    <div class="avatar-lg mx-auto">
                        <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                            <i class="ri-mail-line"></i>
                        </div>
                    </div>
                </div>

                <div class="p-2 mt-4">
                    <div class="text-muted text-center mb-4 mx-lg-3">
                        <h4>Verify Your Email</h4>
                        <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                        <form class="mb-3" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </form>
                        <span>or you can</span>
                        <form method="POST" class="mt-3" action="{{ route('logout') }}">
                            @csrf   
                            <button type="submit" class="btn btn-danger w-100 waves-effect waves-light">{{ __('Log Out') }}</button>
                        
                        </form> 
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>

    </div>
</div>

@endsection