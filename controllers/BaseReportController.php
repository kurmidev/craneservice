<?php

namespace app\controllers;

use Yii;
use app\models\ChallanSearch;
use app\models\InvoiceMasterSearch;
use app\models\PaymentSearch;

class BaseReportController extends BaseController
{


   

   

    public function _challan($client_type)
    {
        if ($this->is_pdf || $this->is_csv) {
            $this->layout = false;
        }

        $searchModel = new ChallanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['client c', 'plan p'])->onlyActive()->andWhere(['c.client_type' => $client_type]);
        if ($this->is_pdf || $this->is_csv) {
            $dataProvider->sort = false;
            $dataProvider->pagination = false;
        } else {
            $dataProvider->pagination->pageSize = 20;
        }
        $content = $this->render('@app/views/reports/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "columns" => $searchModel->displayColumn(),
            "title" => "Challan",
            "search" => $searchModel->advanceSearch(),
            "is_pdf" => $this->is_pdf,
            "is_csv" =>  $this->is_csv
        ]);
        return $this->setReportRender($content, "Challan List", $dataProvider, $searchModel->displayColumn());
    }

    public function _invoice($client_type)
    {
        if ($this->is_pdf || $this->is_csv) {
            $this->layout = false;
        }
        $searchModel = new InvoiceMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['client c'])->onlyActive()->andWhere(['c.client_type' => $client_type]);
        if ($this->is_pdf) {
            $dataProvider->sort = false;
            $dataProvider->pagination = false;
        } else {
            $dataProvider->pagination->pageSize = 20;
        }
        $content = $this->render('@app/views/reports/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "columns" => $searchModel->displayColumn(),
            "title" => "Invoice List",
            "search" => $searchModel->advanceSearch(),
            "is_pdf" => $this->is_pdf,
            "is_csv" =>  $this->is_csv
        ]);
        return $this->setReportRender($content, "Invoice List", $dataProvider, $searchModel->displayColumn());
    }


    public function _payment($client_type)
    {
        if ($this->is_pdf || $this->is_csv) {
            $this->layout = false;
        }
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['client c'])->onlyActive()->andWhere(['c.client_type' => $client_type]);
        if ($this->is_pdf) {
            $dataProvider->sort = false;
            $dataProvider->pagination = false;
        } else {
            $dataProvider->pagination->pageSize = 20;
        }
        $content = $this->render('@app/views/reports/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "columns" => $searchModel->displayColumn(),
            "title" => "Payment List",
            "search" => $searchModel->advanceSearch(),
            "is_pdf" => $this->is_pdf,
            "is_csv" =>  $this->is_csv
        ]);
        return $this->setReportRender($content, "Payment List", $dataProvider, $searchModel->displayColumn());
    }
}
