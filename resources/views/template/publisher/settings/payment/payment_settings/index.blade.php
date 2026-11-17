<!-------------- Panel ---->

@include("partial.admin.alert")
<form action="{{ route("publisher.payments.payment-settings.update") }}" method="POST" id="paymentSettingForm" enctype="multipart/form-data">
    @csrf
    @method("PATCH")

    <div class="row g-3 mb-2">

        <div class="col-md-6">
            <div class="form-group">
                <label for="payment_frequency" class="form-label">Payment Frequency <span class="text-danger">*</span></label>
                <select class="form-control " id="payment_frequency" name="payment_frequency" aria-invalid="false">
                    <option value="" selected="" disabled="">Please Select</option>
{{--                    <option {{ isset($payment->payment_frequency) && $payment->payment_frequency == "every_week" ? "selected" : "" }} value="every_week">Every Week</option>--}}
                    <option {{ isset($payment->payment_frequency) && $payment->payment_frequency == "every_month" ? "selected" : "" }} value="every_month">Every Month</option>
                    <option {{ isset($payment->payment_frequency) && $payment->payment_frequency == "after_45_days" ? "selected" : "" }} value="after_45_days">After 45 Days</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="payment_threshold" class="form-label">Payment Threshold <span class="text-danger">*</span></label>
                <select class="form-control " id="payment_threshold" name="payment_threshold" aria-invalid="false"><option value="" selected="" disabled="">Please Select</option>
{{--                    <option {{ isset($payment->payment_threshold) && $payment->payment_threshold == "50" ? "selected" : "" }} value="50">$50</option>--}}
                    <option {{ isset($payment->payment_threshold) && $payment->payment_threshold == "100" ? "selected" : "" }} value="100">$100</option>
                    <option {{ isset($payment->payment_threshold) && $payment->payment_threshold == "500" ? "selected" : "" }} value="500">$500</option>
                    <option {{ isset($payment->payment_threshold) && $payment->payment_threshold == "1000" ? "selected" : "" }} value="1000">$1000</option>
                    <option {{ isset($payment->payment_threshold) && $payment->payment_threshold == "2500" ? "selected" : "" }} value="2500">$2500</option>
                    <option {{ isset($payment->payment_threshold) && $payment->payment_threshold == "5000" ? "selected" : "" }} value="5000">$5000</option>
                    <option {{ isset($payment->payment_threshold) && $payment->payment_threshold == "10000" ? "selected" : "" }} value="10000">$10000</option>
                </select>
            </div>
        </div>
        <small class="alert fs-12 pt-0 pb-0">Note: You can schedule when you would like to receive your commission payments and at what threshold your Approved commissions must reach before pay out.</small>
    </div>
    @if (!isset($payment->payment_method))
    @php
        $isPaymentChangeable = true;
    @endphp
    <div class="alert alert-danger " role="alert">
        <div class="alert-content">
            <p style="margin-top: 0; margin-bottom: 0;">No Payment method is selected. Please select one.</p>
        </div>
    </div>
    @else
    <div class="default-method-card mb-4">
        <span class="dm-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="5" width="20" height="14" rx="2" />
                <path d="M2 10h20" />
            </svg>
        </span>
        <div class="dm-body">
            <div class="dm-label">Current default method</div>

        @php
            $isPaymentChangeable = false;
            if(session()->has("is_payment_viewed") || !isset($payment->payment_method)) {
                $isPaymentChangeable = true;
            }
        @endphp

        @if(isset($payment->payment_method) && $payment->payment_method)

            @if($payment->payment_method == "bank")
                @include("template.publisher.settings.payment.payment_settings.default_method.bank", compact('payment', 'isPaymentChangeable'))
            @elseif($payment->payment_method == "paypal")
                @include("template.publisher.settings.payment.payment_settings.default_method.paypal", compact('payment', 'isPaymentChangeable'))
            @elseif($payment->payment_method == "payoneer")
                @include("template.publisher.settings.payment.payment_settings.default_method.payoneer", compact('payment', 'isPaymentChangeable'))
            @endif

        @else
            <div class="card-body radius-xl px-sm-20 px-10 pt-15"></div>
        @endif
        </div>
        <span class="badge-soft teal">Active</span>
    </div>
    @endif

    <div id="settingOptions">
        @include("template.publisher.settings.payment.payment_settings.form.options", compact('payment', 'countries', 'isPaymentChangeable'))
    </div>

</form>
    <!-------------- Panel End ----->


