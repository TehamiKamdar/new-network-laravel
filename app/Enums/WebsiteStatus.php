<?php
namespace App\Enums;

enum WebsiteStatus: string
{
    case Active = 'active';
    case Hold = 'hold';
    case Reject = 'rejected';
}
