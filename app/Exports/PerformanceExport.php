<?php
namespace App\Exports;

use App\Models\Transaction;
use App\Models\Website;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PerformanceExport implements FromCollection, WithHeadings
{
    protected string $end_date, $start_date;

    public function __construct(string $start_date, string $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $list = array();

        $websites = Website::withAndWhereHas("users", function ($user) {
            return $user->where("id", auth()->user()->id);
        })->where("status", Website::ACTIVE)->count();

        if ($websites) {
            $startDate = $this->start_date;
            $endDate = $this->end_date;
            $transactions = Transaction::with([
                "tracking" => function ($tracking) {
                    return $tracking->selectRaw("SUM(hits) total_clicks, adverter_id")
                        ->groupBy("advertiser_id");
                }
            ])
            ->whereBetween("transaction_date", [$startDate, $endDate])
            ->selectRaw("COUNT(id) as total_transactions, SUM(sale_amount) as total_sale_amount, SUM(commission_amount) as total_commission_amount")
            ->fetchPublisher(auth()->user())
            ->groupBy("external_advertiser_id")
            ->get();

            foreach ($transactions as $transaction) {
                $totalClicks = $transaction->tracking->total_clicks ?? 0;
                $totalTransactions = $transaction->total_transactions ?? 0;
                $totalSaleAmount = $transaction->total_sale_amount ?? 0;
                $totalCommissionAmount = $transaction->total_commission_amount ?? 0;

                $conversationRate = number_format(0, 1);
                if ($totalTransactions > 0 && $totalClicks > 0) {
                    $conversationRate = number_format(round($totalTransactions / $totalClicks * 100), 1) . "%";
                }

                $averagePayout = number_format(0, 1);
                if ($totalCommissionAmount > 0 && $totalSaleAmount > 0) {
                    $averagePayout = number_format(round($totalCommissionAmount / $totalSaleAmount * 100), 1) . "%";
                }

                $data["advertiser_id"] = $transaction->external_advertiser_id;
                $data["advertiser_name"] = $transaction->advertiser_name;
                $data["total_clicks"] = $totalClicks;
                $data["total_transactions"] = $totalTransactions;
                $data["conversion_rate"] = $conversationRate;
                $data["total_sale_amount"] = $totalSaleAmount;
                $data["total_commission_amount"] = $totalCommissionAmount;
                $data["average_payout"] = $averagePayout;

                $list[] = $data;
            }
        }

        return collect($list);
    }

    public function headings(): array
    {
        return array(
            "Advertiser ID",
            "Advertiser Name",
            "Clicks",
            "Transactions",
            "Conversion Rate",
            "Sale Amount",
            "Commission",
            "Average Payout"
        );
    }
}
