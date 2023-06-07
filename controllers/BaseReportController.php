<?php

namespace app\controllers;

use Yii;
use app\models\ChallanSearch;
use app\models\InvoiceMasterSearch;
use app\models\PaymentSearch;

class BaseReportController extends BaseController{


    public function _challan($client_type) {
        $searchModel = new ChallanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['client c', 'plan p'])->onlyActive()->andWhere(['c.client_type' => $client_type]);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('@app/views/reports/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    "columns" => $searchModel->displayColumn(),
                    "title" => "Active Customer",
                    "search" => $searchModel->advanceSearch()
        ]);
    }

    public function _invoice($client_type){
        $searchModel = new InvoiceMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['client c'])->onlyActive()->andWhere(['c.client_type' => $client_type]);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('@app/views/reports/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    "columns" => $searchModel->displayColumn(),
                    "title" => "Active Customer",
                    "search" => $searchModel->advanceSearch()
        ]);
    }


    public function _payment($client_type){
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['client c'])->onlyActive()->andWhere(['c.client_type' => $client_type]);
        $dataProvider->pagination->pageSize = 20;
        return $this->render('@app/views/reports/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    "columns" => $searchModel->displayColumn(),
                    "title" => "Active Customer",
                    "search" => $searchModel->advanceSearch()
        ]);
    }
}