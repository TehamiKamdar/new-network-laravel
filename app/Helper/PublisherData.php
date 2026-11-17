<?php
namespace App\Helper;

use App\Models\Advertiser;
use App\Models\AdvertiserApply;
use App\Models\Mix;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;

class PublisherData
{
    public static function getAdvertisersAccess(): bool
    {
        return Gate::check("ext_publisher_my_advertiser") || 
               Gate::check("ext_publisher_find_advertiser");
    }

    public static function getReportsAccess(): bool
    {
        return Gate::check("ext_publisher_reports_performance") || 
               Gate::check("ext_publisher_reports_transaction");
    }

    public static function getLinksAccess(): bool
    {
        return Gate::check("publisher_links_banners") || 
               Gate::check("publisher_links_text_n_emails") || 
               Gate::check("ext_publisher_links_coupons") || 
               Gate::check("publisher_links_products") || 
               Gate::check("publisher_links_brand_datafeeds");
    }

    public static function getPaymentsAccess(): bool
    {
        return Gate::check("publisher_payments_summary") || 
               Gate::check("publisher_payments_details") || 
               Gate::check("publisher_payments_transaction_inquiries");
    }

    public static function isDashboardActive()
    {
        return request()->is("partner/dashboard") ? "active" : '';
    }

    public static function isAdvertiserActive()
    {
        return (request()->is("partner/approved-brands") || 
                request()->is("partner/all-brands") || 
                request()->is("partner/brand-analytics") || 
                request()->is("partner/advertiser-detail/*")) 
                ? "active" 
                : '';
    }

    public static function isAdvertiserSubActive()
    {
        return (request()->is("partner/approved-brands") || 
                request()->is("partner/all-brands") || 
                request()->is("partner/brand-analytics") || 
                request()->is("partner/advertiser-detail/*")) 
                ? "show" 
                : '';
    }

    public static function isReportActive()
    {
        return request()->is("partner/analytics/*") ? "active" : '';
    }
    
    public static function isReportSubActive()
    {
        return request()->is("partner/analytics/*") ? "show" : '';
    }
    
    public static function isReportTransactionActive()
    {
        return request()->is("partner/analytics/analytical-reports") ? "active" : '';
    }

    public static function isReportConversionActive()
    {
        return request()->is("partner/analytics/conversions") ? "active" : '';
    }
        
    public static function isCreativeActive()
    {
        return request()->is("partner/campaign-type/*") ? "active" : '';
    }

    public static function isCreativeSubActive()
    {
        return request()->is("partner/campaign-type/*") ? "show" : '';
    }

    public static function isCreativeOffersActive()
    {
        return request()->is("partner/campaign-type/special-offers") ? "active" : '';
    }

    public static function isCreativeLinksActive()
    {
        return request()->is("partner/campaign-type/affiliate-links") ? "active" : '';
    }

     public static function isPaymentActive()
    {
        return request()->is("partner/payouts") ? "active" : '';
    }

    public static function isToolActive()
    {
        return request()->is("partner/tools/*") ? "active" : '';
    }

    public static function getMixNames($ids)
    {
        return Mix::select("name")->whereIn("id", $ids)->get()->pluck("name")->toArray();
    }

    public static function getMixIdz($names)
    {
        return Mix::select("id")->whereIn("name", $names)->get()->pluck("id")->toArray();
    }

    public static function getAdvertiserList()
    {
        $advertisers = Advertiser::select(["sid", "name", "deeplink_enabled"]);
        
        $advertisers->withAndWhereHas("advertiser_applies", function ($apply) {
            $user = auth()->user();
            $apply->where("status", AdvertiserApply::STATUS_ACTIVE)
                  ->where("is_tracking_generate", AdvertiserApply::GENERATE_LINK_COMPLETE)
                  ->where("publisher_id", $user->id)
                  ->where("website_id", $user->active_website_id);
        });

        return $advertisers->get()->toArray();
    }
}