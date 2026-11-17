<?php
namespace App\Exports;

use App\Models\AdvertiserApply;
use App\Models\DeeplinkTracking;
use App\Models\Website;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeepLinkExport implements FromCollection, WithHeadings
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
            $links = DeeplinkTracking::select([
                "advertiser_name",
                "advertiser_id",
                "advertiser_url",
                "deep_link_tracking_url",
                "deep_link_tracking_url_sub_id",
                "deep_link_tracking_url_sub_id_tracking"
            ])
            ->join("advertiser_apply", "advertiser_apply.id", "=", "deeplink_tracking.advertiser_apply_id")
            ->join("advertiser_apply_ads", "advertiser_apply_ads.id", "=", "deeplink_tracking.advertiser_apply_ads_id")
            ->where("advertiser_apply.status", AdvertiserApply::STATUS_ACTIVE)
            ->where("deep_link_tracking.publisher_id", auth()->user()->id);

            if ($request->search_by_name) {
                $links = $links->where(function ($query) use ($request) {
                    $query->orWhere("advertiser_apply.name", "LIKE", "%{$request->search_by_name}%");
                    $query->orWhere("deep_link_tracking.url", "LIKE", "%{$request->search_by_name}%");
                    $query->orWhere("advertiser_apply_ads.url", "LIKE", "%{$request->search_by_name}%");
                    $query->orWhere("advertiser_apply_advertiser_id", "LIKE", "%{$request->search_by_name}%");
                    $query->orWhere("deep_link_tracking.sub_id", "LIKE", "%{$request->search_by_name}%");
                });
            }

            $links = $links->groupBy([
                "advertiser_apply.id",
                "deep_link_tracking_url.tracking_url",
                "deep_link_tracking_url.sub_id",
                "deep_link_tracking_tracking_url.sub_id"
            ]);

            $links = $links->get();

            foreach ($links as $link) {
                $data["advertiser_id"] = $link->sid;
                $data["advertiser_name"] = $link->name;
                $data["sub_id"] = $link->sub_id;
                $data["url"] = $link->url;
                $data["landing_url"] = $link->landing_url;
                $data["tracking_url"] = $link->tracking_url;
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
            "Sub ID",
            "URL",
            "Landing URL",
            "Tracking URL"
        ];
    }

    private function getFields()
    {
        return [
            "advertiser_id",
            "advertiser_name",
            "url",
            "tracking_url",
            "sub_id"
        ];
    }
}
