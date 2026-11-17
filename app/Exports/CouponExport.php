<?php
namespace App\Exports;

use App\Models\AdvertiserApply;
use App\Models\Coupon;
use App\Models\Website;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CouponExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $request = $this->request;
        $websites = Website::withAndWhereHas("users", function ($user) {
            return $user->where("id", auth()->user()->id);
        })->where("status", Website::ACTIVE)->count();

        $list = array();

        if ($websites) {
            $user = auth()->user();
            $coupons = new Coupon();

            if ($request->search_by_name) {
                $coupons = $coupons->where(function ($query) use ($request) {
                    $query->orWhere("coupons.title", "LIKE", "%{$request->search_by_name}%")
                          ->orWhere("advertiser_applies.advertiser_name", "LIKE", "%{$request->search_by_name}%");
                });
            }

            $coupons = $coupons->join("advertiser_applies", "advertiser_applies.id", "=", "coupons.advertiser_apply_id")
                ->where("advertiser_applies.status", AdvertiserApply::STATUS_ACTIVE)
                ->where("advertiser_applies.publisher_id", $user->id)
                ->where("advertiser_applies.website_id", $user->active_website_id)
                ->orderBy("advertiser_applies.advertiser_name", "ASC")
                ->take(10)
                ->get();

            foreach ($coupons as $coupon) {
                $data = [];
                $data["advertiser_id"] = $coupon->sid;
                $data["advertiser_name"] = $coupon->advertiser_name;
                $data["offer_id"] = $coupon->promotion_id ?? "-";
                $data["offer_name"] = $coupon->title ?? "-";
                $data["code"] = $coupon->code ? $coupon->code : "No code required";
                $data["start_date"] = $coupon->start_date ? $coupon->start_date : "-";
                $data["end_dates"] = $coupon->end_date ? $coupon->end_date : "-";
                $data["click_through_url"] = isset($coupon->website_id)
                    ? route("track.coupon", [
                        "advertiser" => $coupon->internal_advertiser_id,
                        "website" => $coupon->website_id,
                        "coupon" => $coupon->id
                    ])
                    : route("track.simplified", [
                        "advertiser" => $coupon->internal_advertiser_id,
                        "website" => $coupon->website_id
                    ]);
                $list[] = $data;
            }
        }

        return collect($list);
    }

    public function headings(): array
    {
        return [
            "Advertiser ID",
            "Advertiser Name",
            "Offer ID",
            "Offer Name",
            "Code",
            "Start Date",
            "End Dates",
            "Click Through URL"
        ];
    }
}
