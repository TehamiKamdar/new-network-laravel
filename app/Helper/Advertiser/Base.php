<?php
namespace App\Helper\Advertiser;

use App\Helper\Static\Vars;

class Base
{
    public static function getFormFieldReadOnly($type, $field)
    {
        goto H1FhQ; H1FhQ: $data = false; goto Qz5xJ; Qz5xJ: if ($type == Vars::AWIN) { $data = Awin::init($field); } elseif ($type == Vars::IMPACT_RADIUS) { $data = ImpactRadius::init($field); } elseif ($type == Vars::RAKUTEN) { $data = Rakuten::init($field); } elseif ($type == Vars::TRADEDOUBLER) { $data = Tradedoubler::init($field); } goto tFt2u; tFt2u: return $data;
    }
}