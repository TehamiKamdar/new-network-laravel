<?php

namespace App\Service\Publisher\Advertiser;

use App\Models\Advertiser;

class DetailService{

    public function init($id)
    {
        $brand = Advertiser::with('advertiser_applies')->findOrFail($id);
    
        return response()->json([
            "success" => true,
            "data" => $brand
        ]);
    }
}