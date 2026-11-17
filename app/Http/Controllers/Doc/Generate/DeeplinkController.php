<?php

namespace App\Http\Controllers\Doc\Generate;

use App\Helper\Static\Methods;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doc\DeeplinkRequest;
use App\Models\ApiHistory;
use App\Models\Website;
use App\Service\Publisher\Advertiser\DocDeepLinkService;

/**
 * @group Generate Deep / Tracking Links
 *
 * APIs for managing Generate Deep / Tracking Links
 *
 * @authenticated
 */

class DeeplinkController extends Controller
{

    /**
     * Generate Deep Links
     *
     * This endpoint is used to generate deep links by id available in the database.
     *
     * <h1 id="authenticating-requests">Authenticating Requests</h1>
     * <p>
     * To authenticate requests, include a <strong><code>token</code></strong> header
     * with the value <strong><code>your-token</code></strong>
     * </p>
     * 
     * @urlParam id integer required The ID of the advertiser. Example: 86049368
     *
     * @response scenario="Generate Deep Links"
     *
     * <h3>Example Response (200 – Generate DeepLink)</h3>
 *
     * <pre style="max-height:600px; overflow:auto;">
 * <code class="language-json">
     * {
     * "success": true,
     * "name": "99designs by Vista",
     * "deeplink_enabled": true,
     * "deeplink_link_url": "https://redirect.thousandslink.com/deeplink/77Gdj4gT"
     * }
    * </code>
 * </pre>
 * 
     */
    public function __invoke($id, DeeplinkRequest $request, DocDeepLinkService $service)
    {
        $user = Methods::getDocUser($request);

        $website = Website::where('wid', $request->wid)->first();

        $request->merge(['widgetAdvertiser' => $id]);

        ApiHistory::create([
            "publisher_id" => $user->id ?? null,
            "website_id" => $website->id ?? null,
            "wid" => $request->wid,
            "by_id" => $id,
            "name" => "Generate Deep Link",
            "token" => $request->header('token'),
            "ip" => request()->ip(),
        ]);

        return $service->checkAvailability($request, $user, $website->id);
    }
}
