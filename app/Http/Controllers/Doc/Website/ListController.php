<?php

namespace App\Http\Controllers\Doc\Website;

use App\Helper\Static\Methods;
use App\Helper\Static\Vars;
use App\Http\Requests\Doc\WebsiteRequest;
use App\Http\Resources\Doc\Websites\WebsiteCollection;
use App\Models\ApiHistory;
use App\Models\Website;
use Dedoc\Scramble\Attributes\Response;
/**
 * @group Websites
 *
 * APIs for managing Websites
 *
 * @authenticated
 */
class ListController extends BaseController
{
/**
 * Get All Websites
 *
 * This endpoint fetches a paginated list of websites associated with the authenticated user.
 *
 * @endpoint GET /v1/websites
 * @queryParam limit integer Optional. Number of items per page. Example: 20
 * @queryParam page integer Optional. Page number. Example: 1
 * @header token string required Your API token for authentication
 * 
 * <h1 id="authenticating-requests">Authenticating Requests</h1>
 * <p>
 * To authenticate requests, include a <strong><code>token</code></strong> header
 * with the value <strong><code>your-token</code></strong>
 * </p>
 * 
 * <h3>Example Response (200 – Get All Transactions)</h3>
 *
 * <pre style="max-height:600px; overflow:auto;">
 * <code class="language-json">
 * {
 *   "data": [
 *     {
 *       "id": 75159452,
 *       "name": "popularclix.com/",
 *       "url": "https://www.popularclix.com/",
 *       "partner_types": ["Coupons/Deals", "Content/Blog"],
 *       "categories": [
 *         "Health & Beauty",
 *         "Apparel, Footwear, Accessories",
 *         "Furniture & Homeware",
 *         "Home & Garden"
 *       ],
 *       "status": "Active",
 *       "monthly_traffic": "10000",
 *       "monthly_page_views": "10000",
 *       "last_updated": "12/18/2025"
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
        $websites = Website::select($this->websiteFields())->whereHas('users', function($query) use($user) {
            return $query->where("id", $user->id);
        })->orderBy("name","ASC")->paginate($limit);
if($websites){
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
}
