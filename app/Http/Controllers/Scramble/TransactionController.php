<?php

namespace App\Http\Controllers\Scramble;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Static\Methods;
use App\Helper\Static\Vars;
use App\Http\Requests\Doc\TransactionRequest;
use App\Http\Controllers\Doc\Transaction\BaseController;
use App\Http\Resources\Doc\Transactions\TransactionCollection;
use App\Models\ApiHistory;
use App\Models\PaymentHistory;
use App\Models\Transaction;
use App\Models\Website;

class TransactionController extends BaseController
{
       /**
     * Get All Transactions
     *
     * This endpoint is used to fetch all available transactions from the database through authentication.
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
     * "data": [
     * {
     * "transaction_id": "10789.568059",
     * "advertiser_id": 9584144,
     * "advertiser_name": "abc",
     * "publisher_id": 8585396,
     * "publisher_name": "Tester",
     * "website_id": 695723,
     * "website_name": "abctester.com.au/",
     * "payment_id": null,
     * "commission_status": "Pending",
     * "commission_amount": "65",
     * "commission_amount_currency": "USD",
     * "sale_amount": "857.77",
     * "sale_amount_currency": "USD",
     * "transaction_date": "2025-04-21 18:52:30",
     * "commission_type": "CLICK_COOKIE",
     * "url": null,
     * "sub_id": "bgd8522-7385-453a-9d75-991f355514064",
     * },
     * {...............},
     * ]
     *  "pagination": {
     *  "total": 632,
     *  "count": 50,
     *  "per_page": 50,
     *  "current_page": 1,
     *  "total_pages": 17
     *  }
     * }
     * </code>
 * </pre>
 * 
     */
    public function __invoke(TransactionRequest $request)
    {
        $limit = $request->limit ?? Vars::LIMIT_20;
        $user = Methods::getDocUser($request);
        $website = Website::where('wid', $request->wid)->first();
        $count = 0;
        $transactions = Transaction::with([
            'advertiser:id,sid', 'publisher:id,sid,first_name,last_name', 'website:id,wid,name'
        ])->select($this->transactionFields())->where("publisher_id", $user->id)
            ->where("website_id", $website->id);

        if($request->start_date)
            $transactions = $transactions->whereDate('transaction_date', '>=', $request->start_date);

        if($request->end_date)
            $transactions =  $transactions->whereDate('transaction_date', '<=', $request->end_date);

        if ($request->transaction_id)
            $transactions = $transactions->where('transaction_id', $request->transaction_id);

        if($request->payment_id)
        {
            $payment = PaymentHistory::select('transaction_idz')->where('payment_id', $request->payment_id)->first();
            $transactions = $transactions->whereIn("transaction_id", $payment->transaction_idz);
          
            foreach($payment->transaction_idz as $tran){
                    $transaction = Transaction::where("transaction_id", $tran)->first();
                    if($transaction){
                       $count ++;
                    }
            }
        }

        $transactions = $transactions->orderBy("transaction_date","DESC")->paginate($limit);

        ApiHistory::create([
            "publisher_id" => $user->id,
            "website_id" => $website->id,
            "wid" => $request->wid,
            "name" => "List Transactions",
            "token" => $request->header('token'),
            "page" => $request->page,
            "limit" => $limit,
            "ip" => request()->ip(),
        ]);
        

        return new TransactionCollection($transactions);
    }
}
