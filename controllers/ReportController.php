<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseReportController;
use app\components\Constants as C;
use app\models\PlanMaster;
use app\models\PlanMasterSearch;
use app\models\VehicleMasterSearch;

class ReportController extends BaseReportController
{

    public function actionCustomerChallan()
    {
        $type = C::CLIENT_TYPE_CUSTOMER;
        return $this->_challan($type);
    }


    public function actionCustomerInvoice()
    {
        $type = C::CLIENT_TYPE_CUSTOMER;
        return $this->_invoice($type);
    }


    public function actionCustomerPayment()
    {
        $type = C::CLIENT_TYPE_CUSTOMER;
        return $this->_payment($type);
    }

    public function actionVendorChallan()
    {
        $type = C::CLIENT_TYPE_VENDOR;
        return $this->_challan($type);
    }


    public function actionVendorInvoice()
    {
        $type = C::CLIENT_TYPE_VENDOR;
        return $this->_invoice($type);
    }


    public function actionVendorPayment()
    {
        $type = C::CLIENT_TYPE_VENDOR;
        return $this->_payment($type);
    }

    public function actionVehicleSummary()
    {
        if ($this->is_pdf || $this->is_csv) {
            $this->layout = false;
        }
        $searchModel = new VehicleMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->setAlias("a");
        $dataProvider->query->leftJoin("challan c", "c.vehicle_id=a.id and c.status=" . C::STATUS_ACTIVE)
            ->leftJoin("expense_master e", "e.vehicle_id=a.id  and e.status=" . C::STATUS_ACTIVE)
            ->andWhere(['a.status' => C::STATUS_ACTIVE])
            ->select(['vehicle_no', "sales_amount" => "sum(c.total)", "expenses" => "sum(e.total)", "profit_loss" => "sum(c.total-e.total)"])
            ->groupBy(['vehicle_no'])
            ->orderBy(['sales_amount' => SORT_DESC]);

        if ($this->is_pdf) {
            $dataProvider->sort = false;
            $dataProvider->pagination = false;
        } else {
            $dataProvider->pagination->pageSize = 20;
        }
        $content = $this->render('@app/views/reports/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "columns" => $searchModel->displayColumn('summary'),
            "title" => "Vehicle Summary",
            "search" => $searchModel->advanceSearch('summary'),
            "is_pdf" => $this->is_pdf,
            "is_csv"=> $this->is_csv
        ]);
        return $this->setReportRender($content, "Vehicle Summary", $dataProvider, $searchModel->displayColumn('summary'));
    }

    public function actionPackageSummary()
    {
        if ($this->is_pdf || $this->is_csv) {
            $this->layout = false;
        }
        $searchModel = new PlanMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->setAlias("a");
        $dataProvider->query->leftJoin("challan c", "c.plan_id=a.id and c.status=" . C::STATUS_ACTIVE)
            ->leftJoin("invoice_master e", "e.id=c.invoice_id")
            ->select([
                "a.name", "total_challan" => "sum(case when c.id is not null then 1 else 0 end )",
                "challan_amount" => "sum(case when c.id is not null then c.total else 0 end )",
                "total_invoice" => "sum(case when e.id is not null then 1 else 0 end )",
                "invoice_amount" => "sum(case when e.id is not null then e.total else 0 end )",
            ])->groupBy(['a.name']);

        if ($this->is_pdf || $this->is_csv) {
            $dataProvider->sort = false;
            $dataProvider->pagination = false;
        } else {
            $dataProvider->pagination->pageSize = 20;
        }
        $content = $this->render('@app/views/reports/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "columns" => $searchModel->displayColumn('summary'),
            "title" => "Package Summary",
            "search" => $searchModel->advanceSearch('summary'),
            "is_pdf" => $this->is_pdf,
            "is_csv" =>  $this->is_csv
        ]);
        return $this->setReportRender($content, "Package Summary", $dataProvider, $searchModel->displayColumn('summary'));
    }
}
