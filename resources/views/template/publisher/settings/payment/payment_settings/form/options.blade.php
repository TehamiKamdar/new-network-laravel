<div class="method-grid" id="paymentMethodGrid">

    {{-- Payoneer --}}
    @if(
        (isset($payment->payment_method) && $payment->payment_method == "payoneer")
        || $isPaymentChangeable
        || (isset($payment->payment_method) && $payment->payment_method == "")
    )
        <label class="method-card">
            <input type="radio" name="payment_method" value="payoneer" {{ isset($payment->payment_method) && $payment->payment_method == "payoneer" ? "checked" : "" }} >

            <img src="{{ asset('img/payoneer.png') }}" alt="Payoneer Logo">

        </label>
    @endif


    {{-- PayPal --}}
    @if(
        (isset($payment->payment_method) && $payment->payment_method == "paypal")
        || $isPaymentChangeable
        || (isset($payment->payment_method) && $payment->payment_method == "")
    )
        <label class="method-card">
            <input type="radio" name="payment_method" value="paypal" {{ isset($payment->payment_method) && $payment->payment_method == "paypal" ? "checked" : "" }} >

            <img src="{{ asset('img/paypal.png') }}" alt="Paypal Logo">

        </label>
    @endif


    {{-- Bank Transfer --}}
    @if(
        (isset($payment->payment_method) && $payment->payment_method == "bank")
        || $isPaymentChangeable
        || (isset($payment->payment_method) && $payment->payment_method == "")
    )
        <label class="method-card">
            <input type="radio" name="payment_method" value="bank" {{ isset($payment->payment_method) && $payment->payment_method == "bank" ? "checked" : "" }} >

            <img src="{{ asset('img/bank.png') }}" alt="Bank Transfer Logo">


        </label>
    @endif

</div>


{{-- Payoneer Form --}}
@if(
    (isset($payment->payment_method) && $payment->payment_method == "payoneer")
    || $isPaymentChangeable
    || (isset($payment->payment_method) && $payment->payment_method == "")
)
    <div
        class="method-form {{ isset($payment->payment_method) && $payment->payment_method == 'payoneer' ? '' : 'd-none' }}"
        id="form-payoneer"
    >
        @include(
            "template.publisher.settings.payment.payment_settings.form.payoneer",
            compact('payment')
        )
    </div>
@endif


{{-- PayPal Form --}}
@if(
    (isset($payment->payment_method) && $payment->payment_method == "paypal")
    || $isPaymentChangeable
    || (isset($payment->payment_method) && $payment->payment_method == "")
)
    <div
        class="method-form {{ isset($payment->payment_method) && $payment->payment_method == 'paypal' ? '' : 'd-none' }}"
        id="form-paypal"
    >
        @include(
            "template.publisher.settings.payment.payment_settings.form.paypal",
            compact('payment')
        )
    </div>
@endif


{{-- Bank Transfer Form --}}
@if(
    (isset($payment->payment_method) && $payment->payment_method == "bank")
    || $isPaymentChangeable
    || (isset($payment->payment_method) && $payment->payment_method == "")
)
    <div
        class="method-form {{ isset($payment->payment_method) && $payment->payment_method == 'bank' ? '' : 'd-none' }}"
        id="form-bank"
    >
        @include(
            "template.publisher.settings.payment.payment_settings.form.bank",
            compact('payment', 'isPaymentChangeable')
        )
    </div>
@endif


@if(session()->has("is_payment_viewed"))
    <div class="button-group d-flex flex-wrap pt-30 mb-15">
        <button class="btn btn-primary btn-default btn-squared mr-15 text-capitalize">
            {{ isset($payment->id) ? "update" : "save" }}
        </button>
    </div>
@endif