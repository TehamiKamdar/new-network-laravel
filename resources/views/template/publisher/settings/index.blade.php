@extends("layouts.publisher.publisher_panel")

@push('title', 'Profile Settings')

@pushonce('styles')
<link rel="stylesheet" href="{{ asset("vendor_assets/css/select2.min.css") }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker.min.css">
<style>
    .contents {
        margin-top: 60px;
    }

    .sidebarTextColor {
        font-size: 16px;
        font-weight: 600;
        color: #000;
    }

    .width-14 {
        width: 14px;
    }

    #verify-modal .modal-footer {
        justify-content: center !important;
    }

    .sidebar-fixed {
        height: 100%;
        width: 22.5%;
        position: fixed;
        overflow-x: hidden;
        z-index: 1;
    }
</style>
@endpushonce

@pushonce('scripts')
<script src="{{ asset("vendor_assets/js/select2.full.min.js") }}"></script>
<script src="{{ asset("vendor_assets/js/jquery.validate.min.js") }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>

<script>

    document.addEventListener("DOMContentLoaded", function () {
        

  /* ---------- Payment Settings: swap method-specific form on radio change ---------- */
        var paymentGrid = document.getElementById('paymentMethodGrid');
            if (paymentGrid) {
                var methodForms = { payoneer: document.getElementById('form-payoneer'), paypal: document.getElementById('form-paypal'), bank: document.getElementById('form-bank') };
                paymentGrid.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    Object.keys(methodForms).forEach(function (key) {
                    if (!methodForms[key]) return;
                    methodForms[key].classList.toggle('d-none', key !== radio.value);
                    });
                });
            });
        }
        $("#datepickerdob").datepicker({
            dateFormat: "d MM yy",
            duration: "medium",
            changeMonth: true,
            changeYear: true,
            yearRange: "{{ now()->subYears(100)->format("Y") }}:{{ now()->format("Y") }}",
        });
        $("#file-upload").change(function () {

            let reader = new FileReader();
            reader.onload = (e) => {
                $('#profilePic').attr('src', e.target.result);
                $('#sidebarProfilePic').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

            $("#profile-image-form").submit();
        });
        $("#profile-image-form").submit(function () {
            $.ajax({
                url: "{{ route("publisher.upload-profile-image") }}",
                method: 'POST',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    $("#profileImg").attr("src", response.image)
                },
                error: function (response) {
                    showErrors(response.message)
                }
            });
        });
    });
    function clickToCopy() {
        copyToClipboard(document.getElementById("api_token"))
        normalMsg({ "message": "API Token Successfully Copied.", "success": true });
    }

</script>

@if($type == \App\Helper\Static\Vars::BASIC_INFO)
    @include("template.publisher.settings.basic_info.js")
@elseif($type == \App\Helper\Static\Vars::COMPANY_INFO)
    @include("template.publisher.settings.company_info.js")
@elseif($type == \App\Helper\Static\Vars::WEBSITES)
    @include("template.publisher.settings.websites.js")
@elseif($type == \App\Helper\Static\Vars::LOGIN_INFO)
    @include("template.publisher.settings.login_info.js")
@elseif($type == \App\Helper\Static\Vars::API_INFO)
    @include("template.publisher.settings.api_info.js")
@elseif($type == \App\Helper\Static\Vars::BILLING_INFO)
    @include("template.publisher.settings.payment.billing_info.js")
@elseif($type == \App\Helper\Static\Vars::PAYMENT_SETTINGS)
    @include("template.publisher.settings.payment.payment_settings.js")
@endif

@endpushonce

@section("content")
    <div class="row g-3">
        <!-- ============ LEFT: summary + settings nav ============ -->
        <div class="col-lg-3">
            <div class="card filter-sticky">
                @include("template.publisher.settings.sidebar")
                @include('template.publisher.settings.bar')
            </div>
        </div>
        <div class="col-xxl-9 col-lg-9 col-sm-7">
            <div class="tab-content" id="v-pills-tabContent">
                @if(request()->is('partner/profile/basic-information'))
                    <div class="tab-pane fade @if(request()->is('partner/profile/basic-information')) active show @endif"
                        id="v-pills-basic-settings" role="tabpanel" aria-labelledby="v-pills-basic-settings-tab">
                        @if($type == \App\Helper\Static\Vars::BASIC_INFO)
                            <!-- Edit Profile -->
                            <div class="card card-pad">
                                <h2 class="form-section-title">API TOKEN</h2>
                                <div class="form-section-sub">(This will be used for API documentation.)</div>
                                <div class="row form-group">
                                    <div class="col-md-9">

                                        <input type="text" readonly class="form-control w-100 @error('api_token') border-danger @enderror" id="api_token" name="api_token" value="{{ auth()->user()->api_token }}">
                                    </div>
                                    <div class="col-md-3">
                                        <a href="javascript:void(0)" onclick="clickToCopy()" id="copyToken"
                                            class="btn btn-primary float-left mr-3">Copy</a>
                                    </div>
                                </div>
                                <h2 class="form-section-title mt-5">Personal Information</h2>
                                <div class="form-section-sub">Set up your personal information</div>
                                @include("template.publisher.settings.basic_info.index")
                            </div>
                            <!-- Edit Profile End -->
                        @endif
                    </div>
                @elseif(request()->is('partner/profile/company'))
                    <div class="tab-pane fade @if(request()->is('partner/profile/company')) active show @endif"
                        id="v-pills-company-settings" role="tabpanel" aria-labelledby="v-pills-company-settings-tab">
                        @if($type == \App\Helper\Static\Vars::COMPANY_INFO)
                            <!-- Edit Profile -->
                                <div class="card card-pad">
                                    <h2 class="form-section-title">Company</h2>
                                    <div class="form-section-sub">Set up your company</div>
                                    @include("template.publisher.settings.company_info.index")
                                </div>
                            <!-- Edit Profile End -->
                        @endif
                    </div>
                @elseif(request()->is('partner/profile/websites'))
                    <div class="tab-pane fade @if(request()->is('partner/profile/websites')) active show @endif"
                        id="v-pills-websites" role="tabpanel" aria-labelledby="v-pills-websites-tab">
                        @if($type == \App\Helper\Static\Vars::WEBSITES)
                            <!-- Edit Profile -->                                
                                <div class="card">
                                    <div class="card-pad pb-0">
                                        <div class="section-head">
                                        <div>
                                            <h2>Websites</h2>
                                            <div class="sub">Properties you promote brands on</div>
                                        </div>
                                        <button type="button" class="btn btn-amber" onclick="openWebsiteModal()" data-toggle="modal" data-target="#website-modal">+ Add website</button>
                                        </div>
                                    </div>
                                    @include("template.publisher.settings.websites.index")
                                </div>
                            <!-- Edit Profile End -->
                        @endif
                    </div>
                @elseif(request()->is('partner/payouts/billing-information'))
                    <div class="tab-pane fade @if(request()->is('partner/payouts/billing-information')) active show @endif"
                        id="v-pills-basic-settings" role="tabpanel" aria-labelledby="v-pills-basic-settings-tab">
                        @if($type == \App\Helper\Static\Vars::BILLING_INFO)
                        <!-- Edit Profile -->
                            <div class="card card-pad">
                                <h2 class="form-section-title">Billing Information</h2>
                                <div class="form-section-sub">Set Up Your Billing Information</div>
                                    @include("template.publisher.settings.payment.billing_info.index")
                            </div>
                        <!-- Edit Profile End -->
                        @endif
                    </div>
                @elseif(request()->is('partner/payouts/payment-settings'))
                    <div class="tab-pane fade @if(request()->is('partner/payouts/payment-settings')) active show @endif"
                        id="v-pills-payment-settings" role="tabpanel" aria-labelledby="v-pills-payment-settings-tab">
                        @if($type == \App\Helper\Static\Vars::PAYMENT_SETTINGS)
                        
                        <!-- Edit Profile -->
                            <div class="card card-pad">
                                <h2 class="form-section-title">Payment Settings</h2>
                                <div class="form-section-sub">Set Up Your Payment Methods To Withdraw Funds.</div>


                            @if($billing)
                                @include("template.publisher.settings.payment.payment_settings.index")
                            @else
                                <div class="alert-icon-big alert alert-danger " role="alert">
                                    <div class="alert-content">
                                        <h3 class="alert-heading">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-info">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                            </svg>
                                            Notice
                                        </h3>
                                        <p>Please complete billing information to add payment methods.</p>
                                    </div>
                                </div>
                            @endif
                            </div>
                        <!-- Edit Profile End -->
                        @endif
                    </div>
                @elseif(request()->is('partner/account/login-info') || request()->is('partner/account/login-info/*'))
                    <div class="tab-pane fade @if(request()->is('partner/account/login-info') || request()->is('partner/account/login-info/*')) active show @endif"
                        id="v-pills-login-information" role="tabpanel" aria-labelledby="v-pills-login-information-tab">
                        @if($type == \App\Helper\Static\Vars::LOGIN_INFO)
                        
                        <!-- Edit Profile -->
                            <div class="card card-pad">
                                <h2 class="form-section-title">Login Information</h2>
                                <div class="form-section-sub">Set up your login information</div>
                                        @include("template.publisher.settings.login_info.index")
                            </div>
                        <!-- Edit Profile End -->
                        @endif
                    </div>
                @elseif(request()->is('publisher/account/api-info') || request()->is('publisher/account/api-info/*'))
                    <div class="tab-pane fade @if(request()->is('publisher/account/api-info') || request()->is('publisher/account/api-info/*')) active show @endif"
                        id="v-pills-api-information" role="tabpanel" aria-labelledby="v-pills-api-information-tab">
                        @if($type == \App\Helper\Static\Vars::API_INFO)
                            <!-- Edit Profile -->
                            <div class="edit-profile">
                                <div class="card">
                                    <div class="card-header px-sm-25 px-3">
                                        <div class="edit-profile__title">
                                            <h6 class="font-weight-bold">API Information</h6>
                                            <span class="fs-13 color-light fw-400">View your api information</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @include("template.publisher.settings.api_info.index")
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Profile End -->
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection