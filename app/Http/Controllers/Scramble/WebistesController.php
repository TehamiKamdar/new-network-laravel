<?php

namespace App\Http\Controllers\Scramble;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Doc\Website\BaseController;
use Illuminate\Http\Request;
use App\Helper\Static\Methods;
use App\Helper\Static\Vars;
use App\Http\Requests\Doc\WebsiteRequest;
use App\Http\Resources\Doc\Websites\WebsiteCollection;
use App\Models\ApiHistory;
use App\Models\Website;
use Dedoc\Scramble\Attributes\Response;

class WebistesController extends BaseController
{
    /**
     * Get All Websites
     *
     * This endpoint fetches a paginated list of websites associated with the authenticated user.
     *
     * <h1 id="authenticating-requests">Authenticating Requests</h1>
     * <p>
     * To authenticate requests, include a <strong><code>token</code></strong> header
     * with the value <strong><code>your-token</code></strong>
     * </p>
     *
     * <h3>Example Response (200, Get All Websites)</h3>
     *
     * <pre><code class="language-json">
     * {
     *   "data": [
     *     {
     *       "id": 90644632,
     *       "name": "****************",
     *       "url": "https://www.*********.au/",
     *       "partner_types": [
     *         "Coupons/Deals"
     *       ],
     *       "categories": [
     *         "News & Blogging"
     *         "Lifestyle"
     *       ],
     *       "status": "Active",
     *       "monthly_traffic": "5000",
     *       "monthly_page_views": "5000",
     *       "last_updated": "05/21/2025"
     *     }
     *   ],
     *   "pagination": {
     *     "total": 1,
     *     "count": 1,
     *     "per_page": 20,
     *     "current_page": 1,
     *     "total_pages": 1
     *   }
     * }
     * </code></pre>
     */


    #[Response(
        status: 200,
        description: 'List of websites',
        content: [
            'application/json' => [
                'example' => [
                    'data' => [
                        [
                            'id' => 75159452,
                            'name' => 'popularclix.com/',
                            'url' => 'https://www.popularclix.com/',
                            'partner_types' => ['Coupons/Deals', 'Content/Blog'],
                            'categories' => [
                                'Health & Beauty',
                                'Apparel, Footwear, Accessories',
                                'Furniture & Homeware',
                                'Home & Garden',
                            ],
                            'status' => 'Active',
                            'monthly_traffic' => '10000',
                            'monthly_page_views' => '10000',
                            'last_updated' => '12/18/2025',
                        ],
                    ],
                    'pagination' => [
                        'total' => 1,
                        'count' => 1,
                        'per_page' => 20,
                        'current_page' => 1,
                        'total_pages' => 1,
                    ],
                ],
            ],
        ]
    )]

    public function __invoke(WebsiteRequest $request)
    {
        $limit = $request->limit ?? Vars::LIMIT_20;
        $user = Methods::getDocUser($request);
        $websites = Website::select($this->websiteFields())->whereHas('users', function ($query) use ($user) {
            return $query->where("id", $user->id);
        })->orderBy("name", "ASC")->paginate($limit);
        if ($websites) {
            ApiHistory::create([
                "publisher_id" => $user->id,
                "name" => "List Websites",
                "token" => $request->header('token'),
                "page" => $request->page,
                "limit" => $limit,
                "ip" => request()->ip(),
            ]);

            return new WebsiteCollection($websites);
        }

    }


     /**
     * Get Website By ID
     *
     * @urlParam id integer required The ID of the website. Example: 90644632
     *
     * This endpoint is used to fetch all available websites from the database through authentication.
      * <h1 id="authenticating-requests">Authenticating Requests</h1>
 * <p>
 * To authenticate requests, include a <strong><code>token</code></strong> header
 * with the value <strong><code>your-token</code></strong>
 * </p>
 * 
 * <h3>Example Response (200 – Get Website By ID)</h3>
 *
 * <pre style="max-height:600px; overflow:auto;">
 * <code class="language-json">
     * {
     * "data": [
     * {
     * "id": 90644632,
     * "name": "****************",
     * "url": "https://www.*********.au/",
     * "partner_types": [
     * "Coupons/Deals",
     * "Content/Blog"
     * ],
     * "categories": [
     * "News & Blogging",
     * "Business",
     * "Shopping",
     * "Lifestyle"
     * ],
     * "status": "Active",
     * "monthly_traffic": "25000",
     * "monthly_page_views": "55000",
     * "last_updated": "08/14/2023"
     * }
     * ],
     * "pagination": {
     * "total": 1,
     * "count": 1,
     * "per_page": 20,
     * "current_page": 1,
     * "total_pages": 1
     * }
     * }
      * </code>
 * </pre>
     */

 public function show_By_id($id, Request $request)
     {
        $user = Methods::getDocUser($request);
        $website = Website::select($this->websiteFields())->where('wid', $id)->whereHas('users', function($query) use($user) {
            return $query->where("id", $user->id);
        })->orderBy("name","ASC")->first();

         ApiHistory::create([
             "publisher_id" => $user->id,
             "website_id" => $website->id,
             "wid" => $id,
             "by_id" => $id,
             "name" => "Show Website",
             "token" => $request->header('token'),
             "ip" => request()->ip(),
         ]);

        return new WebsiteResource($website);
    }

}
