<?php

namespace app\components;

use Yii;
use yii\db\Expression;
use yii\base\Model;
use app\components\Constants as C;
use app\models\Challan;
use app\models\ClientMaster;
use app\models\ExpenseMaster;
use app\models\InvoiceMaster;
use app\models\Payments;
use app\models\VehicleMaster;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;

class Dashboard extends Model
{

    public $client_type;
    public $baseUrl ;

    public function __construct(){
        $this->baseUrl = $this->client_type==C::CLIENT_TYPE_VENDOR?"vendor":"customer";
    }


    public function getTotalCustomer()
    {
        return ClientMaster::find()->active()->andFilterWhere(["client_type" => $this->client_type])->count();
    }

    public function getTotalInvoice()
    {
        return InvoiceMaster::find()->active()->andFilterWhere(["client_type" => $this->client_type])->sum('total');
    }

    public function getTotalOutstanding()
    {
        return InvoiceMaster::find()->onlyActive()->andFilterWhere(["client_type" => $this->client_type])->sum("total-payment");
    }

    public function getTotalPaid()
    {
        return Payments::find()->onlyActive()->andFilterWhere(["client_type" => $this->client_type])->sum("amount_paid");
    }

    public function getTotalChallan()
    {
        $query =  Challan::find()->alias('a');
        $query->setAlias('a');
        return $query->joinWith(['client c'])->andFilterWhere(["c.client_type" => $this->client_type])->onlyActive()->count();
    }

    public function getPendingChallan()
    {
        $query =  Challan::find()->alias('a');
        $query->setAlias('a');
        return $query->joinWith(['client c'])->andFilterWhere(["c.client_type" => $this->client_type])->active()->andWhere('a.total-a.amount_paid>0')->count();
    }

    public function getMonthlyOutstanding()
    {
        $model = InvoiceMaster::find()->andWhere('total-payment>0')
            ->select(["invoice_date" => new Expression("left(invoice_date,7)"), "pending_count" => "count(id)", "pending_amount" => "sum(total-payment)"])
            ->andFilterWhere(["client_type" => $this->client_type])
            ->groupBy(['invoice_date'])
            ->asArray()->all();
        $response = [];
        foreach ($model as $d) {
            $response[] = [
                "invoice_month" => Html::a(date("Y-m-01", strtotime($d['invoice_date'])),
                            Yii::$app->urlManager->createUrl(["report/".$this->baseUrl."-invoice","InvoiceMasterSearch[invoice_date_start]"=>date("Y-m-01", strtotime($d['invoice_date'])),
                            "InvoiceMasterSearch[invoice_date_end]"=>date("Y-m-t", strtotime($d['invoice_date']))
                        ])),
                "pending_count" => $d['pending_count'],
                "pending_amount" => round($d['pending_amount'], 2)
            ];
        }
        return $response;
    }

    public function getCustomerInvoiceSummary()
    {
        $d = InvoiceMaster::find()->active()->andFilterWhere(["client_type" => $this->client_type])
            ->select([
                "total_invoice" => "count(id)",
                "total_amount" => "sum(total)",
                "pending_invoice" => "sum(case when total-payment>0 then 1 else 0 end )",
                "pending_invoice_amount" => "sum(case when total-payment>0 then total-payment else 0 end)",
                "paid_invoice" =>  "sum(case when total-payment<=0 then 1 else 0 end)",
                "paid_invoice_amount" => "sum(case when total-payment>0 then payment else 0 end )",
            ])->asArray()->all();

        $d = !empty($d[0]) ? $d[0] : [];
        return  [
            "total_invoice" => !empty($d["total_invoice"]) ? Html::a(round($d["total_invoice"], 2),Yii::$app->urlManager->createUrl(["report/".$this->baseUrl."-invoice"])) : "0",
            "total_amount" => !empty($d["total_amount"]) ? round($d["total_amount"], 2) : "0",
            "pending_invoice" => !empty($d["pending_invoice"]) ?  Html::a(round($d["pending_invoice"], 2),Yii::$app->urlManager->createUrl(["report/".$this->baseUrl."-invoice","InvoiceMasterSearch[invoice_status]"=>1])) : "0",
            "pending_amount" => !empty($d["pending_invoice_amount"]) ? round($d["pending_invoice_amount"], 2) : "0",
            "paid" => !empty($d["paid_invoice"]) ?  Html::a(round($d["paid_invoice"], 2),Yii::$app->urlManager->createUrl(["report/".$this->baseUrl."-invoice","InvoiceMasterSearch[invoice_status]"=>2])) : "0",
            "paid_amount" => !empty($d["paid_invoice_amount"]) ? round($d["paid_invoice_amount"], 2) : "0",
        ];
    }

    public function getCustomerChallanSummary()
    {
        $query =  Challan::find()->alias('a');
        $query->setAlias('a');
        $d = $query->joinWith(['client c'])->andFilterWhere(["c.client_type" => $this->client_type])->andWhere(['a.status'=>C::STATUS_ACTIVE])
            ->select([
                "total_challan" => "count(a.id)",
                "total_amount" => "sum(a.total)",
                "pending_challan" => "sum(case when a.total-a.amount_paid>0 then 1 else 0 end)",
                "pending_challan_amount" => "sum(case when a.total-a.amount_paid>0 then a.total-a.amount_paid else 0 end)",
                "paid_challan" =>  "sum(case when a.total-a.amount_paid<=0 then 1 else 0 end)",
                "paid_challan_amount" => "sum(case when a.total-a.amount_paid<=0 then a.amount_paid else 0 end)",
            ])->asArray()->all();

        $d = !empty($d[0]) ? $d[0] : [];
        return  [
            "total" => !empty($d["total_challan"]) ? Html::a(round($d["total_challan"], 2),Yii::$app->urlManager->createUrl(["report/".$this->baseUrl."-challan"]))  : "0",
            "total_amount" => !empty($d["total_amount"]) ?  round($d["total_amount"], 2) : "0",
            "pending" => !empty($d["pending_challan"]) ? Html::a(round($d["pending_challan"], 2),Yii::$app->urlManager->createUrl(["report/".$this->baseUrl."-challan","ChallanSearch[challan_status]"=>2]))  : "0",
            "pending_amount" => !empty($d["pending_challan_amount"]) ? round($d["pending_challan_amount"], 2) : "0",
            "paid" => !empty($d["paid_challan"]) ? Html::a(round($d["paid_challan"], 2),Yii::$app->urlManager->createUrl(["report/".$this->baseUrl."-challan","ChallanSearch[challan_status]"=>1])) : "0",
            "paid_amount" => !empty($d["paid_challan_amount"]) ? round($d["paid_challan_amount"], 2) : "0",
        ];
    }

    public function getMonthlyChallanOutstanding()
    {
        $model = Challan::find()->alias('a')->joinWith(['client c'])->andWhere(['a.status'=>C::STATUS_ACTIVE])
            ->select(["challan_date" => new Expression("left(a.challan_date,7)"), "challan_count" => "count(a.id)", "challan_amount" => "sum(a.base_amount)"])
            ->andFilterWhere(["c.client_type" => $this->client_type])
            ->groupBy(['left(a.challan_date,7)'])
            ->asArray()->all();
        $response = [];
        foreach ($model as $d) {
            $response[] = [
                "challan_date" =>   Html::a(date("Y-m-01", strtotime($d['challan_date'])),
                Yii::$app->urlManager->createUrl(["report/".$this->baseUrl."-challan","ChallanSearch[challan_created_start]"=>date("Y-m-01", strtotime($d['challan_date'])),
                "ChallanSearch[challan_created_end]"=>date("Y-m-t", strtotime($d['challan_date']))
            ])),
                "challan_count" => $d['challan_count'],
                "challan_amount" => round($d['challan_amount'], 2)
            ];
        }
        return $response;
    }

    public function getVehicleSummary()
    {
        $model = VehicleMaster::find()->alias("a")
            ->leftJoin("challan c", "c.vehicle_id=a.id and c.status=" . C::STATUS_ACTIVE)
            ->leftJoin("expense_master e", "e.vehicle_id=a.id  and e.status=" . C::STATUS_ACTIVE)
            ->andWhere(['a.status' => C::STATUS_ACTIVE])
            ->select(['vehicle_no', "sales_amount" => "sum(c.total)", "expenses" => "sum(e.total)"])
            ->groupBy(['vehicle_no'])
            ->orderBy(['sales_amount' => SORT_DESC])
            ->asArray()->all();
        $resp = [];
        foreach ($model as $d) {
            $resp[] = [
                "vehicle_no" => Html::a($d['vehicle_no'],Yii::$app->urlManager->createUrl(["report/vehicle-summary","VehicleMasterSearch[vehicle_no]"=>$d['vehicle_no']])),
                "sales_amount" => round($d['sales_amount'], 2),
                "expenses" => round($d['expenses'], 2),
                "profit_loss" => round($d['sales_amount'] - $d['expenses'], 2)
            ];
        }
        return  $resp;
    }

    public function getSummary()
    {
        $model = InvoiceMaster::find()->alias("a")->andFilterWhere(["a.client_type" => $this->client_type])
            ->leftJoin('client_master c', 'a.client_id=c.id')
            ->select([
                "invoice_date" => new Expression("left(a.invoice_date,7)"),
                "client_count" => "sum(case when left(a.invoice_date,7)=left(c.created_at,7) then 1 else 0 end)",
                "total_bills" => "count(a.id)",
                "total_amount" => "sum(total)",
                "pending_bills" => "sum(case when a.total>a.payment then 1 else 0 end)",
                "pending_amount" => "sum(a.total-a.payment)",
                "collected_bills" => "sum(case when a.total-a.payment<=0 then 1 else 0 end)",
                "collected_amount" => "sum(a.payment)",
            ])
            ->andWhere(["c.status" => C::STATUS_ACTIVE])
            ->groupBy(["invoice_date"])->asArray()->all();

        return !empty($model) ? $model : [];
    }

    public function getMonthlyExpenses()
    {
        $model = ExpenseMaster::find()->active()
            ->select(["date" => new Expression("left(date,7)"), "count" => "count(id)", "amount" => "sum(total)"])
            ->groupBy(['date'])
            ->asArray()->all();

        return !empty($model) ? $model : [];
    }

    public function getTodaysExpenses()
    {
        $model = ExpenseMaster::find()->active()->andWhere(['date' => date("Y-m-d")])
            ->select(["date" => new Expression("left(date,7)"), "count" => "count(id)", "amount" => "sum(total)"])
            ->groupBy(['date'])
            ->asArray()->all();

        return !empty($model) ? $model : [];
    }

    public function getVehicleExpense()
    {
        $model = ExpenseMaster::find()->alias("a")->andWhere(['a.status' => C::STATUS_ACTIVE])->andWhere(['not', ["a.vehicle_id" => null]])
            ->leftJoin('vehicle_master v', 'v.id=a.vehicle_id')
            ->select(["vehicle_no" => "v.vehicle_no", "count" => "count(a.id)", "amount" => "sum(a.total)"])
            ->groupBy(['v.vehicle_no'])
            ->asArray()->all();

        return !empty($model) ? $model : [];
    }


    public function getStaffExpense()
    {
        $model = ExpenseMaster::find()->alias("a")->andWhere(['a.status' => C::STATUS_ACTIVE])->andWhere(['not', ["a.staff_id" => null]])
            ->leftJoin('employee_master v', 'v.id=a.staff_id')
            ->select(["staff" => "v.name", "count" => "count(a.id)", "amount" => "sum(a.total)"])
            ->groupBy(['v.name'])
            ->asArray()->all();

        return !empty($model) ? $model : [];
    }

    public function getTopFiveVehicle()
    {
        $model = VehicleMaster::find()->alias("a")
        ->leftJoin("challan c", "c.vehicle_id=a.id and c.status=" . C::STATUS_ACTIVE)
        ->leftJoin("expense_master e", "e.vehicle_id=a.id  and e.status=" . C::STATUS_ACTIVE)
        ->andWhere(['a.status' => C::STATUS_ACTIVE])
        ->select(['vehicle_no', "sales_amount" => "sum(c.total)", "expenses" => "sum(e.total)"])
        ->groupBy(['vehicle_no'])
        ->orderBy(['sales_amount' => SORT_DESC])
        ->asArray()->all();

        $resp = [];
        if (!empty($model)) {
            foreach ($model as $m) {
                $resp[] = [
                    "sum" => $m['sales_amount'],
                    "vehicle_no" => $m['vehicle_no'],
                    "color" => sprintf('#%06X', mt_rand(0, 0xFFFFFF))
                ];
            }
        }
        return [
            "id" => "topfivevehicle",
            "labels" => !empty($resp) ? ArrayHelper::getColumn($resp, 'vehicle_no') : [],
            "dataset" => !empty($resp) ? ArrayHelper::getColumn($resp, 'sum') : [],
            "color" => !empty($resp) ? ArrayHelper::getColumn($resp, 'color') : [],
        ];
    }
}
