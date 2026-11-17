<?php

namespace App\Http\Controllers\Scramble;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Static\Methods;
use App\Http\Requests\Doc\TrackingLinkRequest;
use App\Http\Requests\Publisher\DeeplinkRequest;
use App\Models\ApiHistory;
use App\Models\Website;
use App\Service\Publisher\Advertiser\DeepLinkService;
use App\Service\Publisher\Advertiser\DocTrackingLinkService;

/**
 * @group Generate Deep / Tracking Links
 *
 * APIs for managing Generate Deep / Tracking Links
 *
 * @authenticated
 */
class Generate_Tracking_LinkController extends Controller
{
    /**
     * Generate Tracking Links
     *
     * This endpoint is used to generate tracking links by id available in the database.
     *
     * <h1 id="authenticating-requests">Authenticating Requests</h1>
     * <p>
     * To authenticate requests, include a <strong><code>token</code></strong> header
     * with the value <strong><code>your-token</code></strong>
     * </p>
     * 
     * @urlParam id integer required The ID of the advertiser. Example: 86049368
     *
     * @response scenario="Generate Tracking Links"
     *
     * <h3>Example Response (200 – Generate Tracking Link)</h3>
 *
 * <pre style="max-height:600px; overflow:auto;">
 * <code class="language-json">
     * {
     * "success": true,
     * "name": "99designs by Vista",
     * "tracking_url": "https://redirect.thousandslink.com/short/NaxDGFkv",
     * }
     * </code>
 * </pre>
     */
    public function __invoke($id, TrackingLinkRequest $request, DocTrackingLinkService $service)
    {
        $user = Methods::getDocUser($request);

        $website = Website::where('wid', $request->wid)->first();

        if(isset($website->id) && $website->id)
        {
            $request->merge(['widgetAdvertiser' => $id]);

            ApiHistory::create([
                "publisher_id" => $user->id ?? null,
                "website_id" => $website->id ?? null,
                "wid" => $request->wid,
                "by_id" => $id,
                "name" => "Generate Tracking Link",
                "token" => $request->header('token'),
                "ip" => request()->ip(),
            ]);

            return $service->checkAvailability($request, $user, $website->id);
        }

        return response()->json([
            "success" => false,
            "name" => $advertiser->name ?? null,
            "tracking_url" => $track ?? null
        ], 404);
    }
}
