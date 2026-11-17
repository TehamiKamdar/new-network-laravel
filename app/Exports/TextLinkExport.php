<?php
namespace App\Exports;

use App\Models\AdvertiserApply;
use App\Models\Tracking;
use App\Models\Website;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TextLinkExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $request = $this->request;

        // Check if the user has active websites
        $websites = Website::withAndWhereHas("users", function ($user) {
            return $user->where("id", auth()->user()->id);
        })->where("status", Website::ACTIVE)->count();

        $list = [];

        if ($websites) {
            // Fetch tracking links with related data
            $links = Tracking::select([
                "advertisers.name",
                "advertisers.sid",
                "advertisers.url",
                "trackings.tracking_url_short",
                "trackings.sub_id",
                "advertiser_applies.tracking_url_short as advertiser_tracking_url_short"
            ])
                ->join("advertiser_applies", "advertiser_applies.internal_advertiser_id", "trackings.advertiser_id")
                ->join("advertisers", "advertisers.id", "trackings.advertiser_id")
                ->where("advertiser_applies.status", AdvertiserApply::STATUS_ACTIVE)
                ->where("trackings.publisher_id", auth()->user()->id);

            // Apply search filter if provided
            if ($request->search_by_name) {
                $searchTerm = "%{$request->search_by_name}%";
                $links = $links->where(function ($query) use ($searchTerm) {
                    $query->orWhere("advertisers.name", "LIKE", $searchTerm)
                        ->orWhere("trackings.tracking_url_short", "LIKE", $searchTerm)
                        ->orWhere("advertisers.url", "LIKE", $searchTerm)
                        ->orWhere("advertisers.sid", "LIKE", $searchTerm)
                        ->orWhere("trackings.sub_id", "LIKE", $searchTerm)
                        ->orWhere("advertiser_applies.tracking_url_short", "LIKE", $searchTerm);
                });
            }

            // Group and fetch the results
            $links = $links->groupBy([
                "advertisers.id",
                "trackings.tracking_url_short",
                "trackings.publisher_id",
                "trackings.sub_id"
            ])->get();

            // Prepare the data for export
            foreach ($links as $link) {
                $list[] = [
                    "advertiser_sid" => $link->sid,
                    "advertiser_name" => $link->name,
                    "sub_id" => $link->sub_id,
                    "url" => $link->url,
                    "tracking_url_short" => $link->tracking_url_short ?? $link->advertiser_tracking_url_short,
                ];
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
            "Tracking URL Short"
        ];
    }
}