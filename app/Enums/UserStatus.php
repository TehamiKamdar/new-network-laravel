<?php
namespace App\Enums;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case PENDING = 'pending';
    case HOLD = 'hold';
    case REJECT = 'rejected';
}
