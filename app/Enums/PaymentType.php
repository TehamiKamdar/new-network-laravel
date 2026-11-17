<?php
namespace App\Enums;

enum PaymentType: string
{
    case PAYPAL = 'paypal';
    case PAYONEER = 'payoneer';
    case BANKWIRE = 'bank-wire';
}
