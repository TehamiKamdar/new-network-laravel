<?php
namespace App\Exports;

use App\Models\PaymentHistory;
use App\Models\Transaction;
use App\Models\Website;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TransactionExport implements FromCollection, WithHeadings, WithCustomCsvSettings, WithEvents
{
    protected $start_date, $end_date, $paymentID;

    public function __construct(string $start_date, string $end_date, string $paymentID)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->paymentID = $paymentID;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $websites = Website::withAndWhereHas("users", function ($user) {
            return $user->where("id", auth()->user()->id);
        })
        ->where("status", Website::ACTIVE)
        ->count();

        if (!$websites) {
            return collect([]);
        }

        $transactions = Transaction::select(
            "transaction_date",
            "advertiser_name",
            "external_advertiser_id",
            "transaction_id",
            "sale_amount_currency",
            "sale_amount",
            "commission_amount_currency",
            "commission_amount",
            "commission_status",
            "payment_status"
        );

        if ($this->paymentID) {
            $payment = PaymentHistory::select("transaction_idz")->find($this->paymentID);
            $transactions = $transactions->whereIn("transaction_id", $payment->transaction_idz);
        } else {
            $transactions = $transactions->whereBetween("transaction_date", [$this->start_date, $this->end_date]);
        }

        $transactions = $transactions->fetchPublisher(auth()->user())->get();

        return $transactions->map(function ($transaction) {
            return [
                "transaction_date" => $transaction->transaction_date,
                "advertiser_name" => $transaction->advertiser_name,
                "external_advertiser_id" => $transaction->external_advertiser_id,
                "transaction_id" => $transaction->transaction_id,
                "sale_amount" => $transaction->sale_amount_currency . " " . $transaction->sale_amount,
                "commission_amount" => $transaction->commission_amount_currency . " " . $transaction->commission_amount,
                "status" => $this->determineStatus($transaction),
            ];
        });
    }

    public function headings(): array
    {
        return [
            "Transaction Date",
            "Advertiser Name",
            "Advertiser ID",
            "Transaction ID",
            "Sale Amount",
            "Commission Amount",
            "Commission Status",
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle("A1:G1")->getFont()->setBold(true);
            }
        ];
    }

    public function getCsvSettings(): array
    {
        return [
            "delimiter" => ",",
            "enclosure" => '"',
            "use_bom" => false,
        ];
    }

    private function determineStatus($transaction)
    {
        return match ($transaction->payment_status) {
            Transaction::PAYMENT_STATUS_RELEASE_PAYMENT, Transaction::PAYMENT_STATUS_CONFIRM => Transaction::STATUS_PAID,
            Transaction::PAYMENT_STATUS_RELEASE => str_replace('_', ' ', Transaction::STATUS_PENDING_PAID),
            default => match ($transaction->commission_status) {
                Transaction::STATUS_PENDING => Transaction::STATUS_PENDING,
                Transaction::STATUS_HOLD => Transaction::STATUS_HOLD,
                Transaction::STATUS_APPROVED => Transaction::STATUS_APPROVED,
                Transaction::STATUS_PAID => Transaction::STATUS_PAID,
                Transaction::STATUS_DECLINED => Transaction::STATUS_DECLINED,
                default => null,
            },
        };
    }
}
