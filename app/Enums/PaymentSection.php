<?php
namespace App\Enums;

enum PaymentSection: string
{
    case PENDING_TO_PAY = 'pending-to-pay';
    case PAID_TO_PUBLISHER = 'paid-to-publisher';
    case RELEASE_PAYMENT = 'release-payment';
    case PAYMENT_HISTORY = 'payment-history';
    case NO_PUBLISHER_PAYMENT = 'no-publisher-payment';
}
