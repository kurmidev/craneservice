<?php

namespace app\controllers;

use Yii;
use app\models\ChallanSearch;
use app\models\InvoiceMasterSearch;
use app\models\PaymentSearch;
use app\components\ConstFunc as F;

class BaseReportController extends BaseController
{


    public $is_pdf = false;

    public function init()
    {
        parent::init();
        $this->is_pdf = Yii::$app->request->get('is_pdf');
    }

    public function setReportRender($content, $filename)
    {
        return $this->is_pdf ? F::printPdf($content, $filename) : $content;
    }

    public function _challan($client_type)
    {
        if ($this->is_pdf) {
            $this->layout = false;
        }

        $searchModel = new ChallanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['client c', 'plan p'])->onlyActive()->andWhere(['c.client_type' => $client_type]);
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
            "title" => "Challan",
            "search" => $searchModel->advanceSearch(),
            "is_pdf" => $this->is_pdf
        ]);
        return $this->setReportRender($content, "Challan List");
    }

    public function _invoice($client_type)
    {
        if ($this->is_pdf) {
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
        $content= $this->render('@app/views/reports/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            "columns" => $searchModel->displayColumn(),
            "title" => "Invoice List",
            "search" => $searchModel->advanceSearch(),
            "is_pdf" => $this->is_pdf
        ]);
        return $this->setReportRender($content, "Invoice List");
    }


    public function _payment($client_type)
    {
        if ($this->is_pdf) {
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
            "is_pdf" => $this->is_pdf
        ]);
        return $this->setReportRender($content, "Payment List");

    }
}
