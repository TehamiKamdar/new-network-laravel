<?php
namespace App\Enums;

enum Status: string
{
    case JOINED = 'joined';
    case HOLD = 'hold';
    case ADMITAD_HOLD = 'admitad_hold';
    case PENDING = 'pending';
    case REJECT = 'rejected';
}
