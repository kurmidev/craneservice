<?php

namespace app\controllers;

use app\models\ChallanSearch;
use app\models\InvoiceMasterSearch;
use app\models\PaymentSearch;

class BaseReportController extends BaseController{


    public function actionActiveCustomer() {
        $searchModel = new CustomerAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->joinWith(['customer', 'operator'])->andWhere([$dataProvider->query->talias . 'status' => C::STATUS_ACTIVE]);
        $dataProvider->pagination->pageSize = 100;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    "columns" => $searchModel->displayColumn(),
                    "title" => "Active Customer",
                    "search" => $searchModel->advanceSearch()
        ]);
    }

    public function _invoice($client_type){
        $searchModel = new InvoiceMasterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(["client_type" => $client_type]);

        return $this->render('@app/views/reports/invoice', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function _payment($client_type){
        $searchModel = new PaymentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(["client_type" => $client_type]);

        return $this->render('@app/views/reports/payment', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}