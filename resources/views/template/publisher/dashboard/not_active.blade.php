<div class="az-content az-content-dashboard">
    <div class="container">
        <div class="az-content-body">

            <div class="contents  mt-5">
                <div class="row">
                    <div class="col-lg-12">
                        @if(auth()->user()->status == \App\Models\User::PENDING)
                            <div class="alert-icon-big alert alert-danger " role="alert">
                                <div class="alert-icon">
                                </div>
                                <div class="alert-content">
                                    <h3 class="alert-heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-info">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg> Account Review in Progress</h3>

                                    <p>Hello,</p>

                                    <p class="mt-3">
                                        Thank you for applying to join the ThousandsLink Affiliate Network. Your application has
                                        been successfully received and is currently under review by our Compliance Team.
                                    </p>

                                    <p class="mt-3">
                                        While the review is in progress, your account status will remain
                                        <strong>Pending</strong>. If any additional information is required, your Account
                                        Manager will contact you directly.
                                    </p>

                                    <p class="mt-3">
                                        You will be notified as soon as your account is approved.
                                    </p>

                                    <p class="mt-3">Best regards,</p>
                                    <p>ThousandsLink Support Team</p>
                                </div>

                            </div>
                        @elseif(auth()->user()->status == \App\Models\User::HOLD)
                            <div class="alert-icon-big alert alert-danger " role="alert">
                                <div class="alert-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-info">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                </div>
                                <div class="alert-content">
                                    <h3 class="alert-heading">Announcement</h3>
                                    <p>Your account is currently HOLD. Please contact the support team of ThousandsLink to better
                                        understand the issue.</p>
                                </div>
                            </div>
                        @elseif(auth()->user()->status == \App\Models\User::REJECTED)
                            <div class="alert-icon-big alert alert-danger " role="alert">
                                <div class="alert-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-info">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="16" x2="12" y2="12"></line>
                                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                    </svg>
                                </div>
                                <div class="alert-content">
                                    <h3 class="alert-heading">Announcement</h3>
                                    <p>Your account is currently Rejected. Please contact the support team of ThousandsLink to
                                        better understand the issue.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>