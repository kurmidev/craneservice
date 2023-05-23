<?php

namespace app\controllers;

use app\models\ChallanSearch;
use app\models\InvoiceMasterSearch;
use app\models\PaymentSearch;

class BaseReportController extends BaseController{


    public function _challan($client_type){
        $searchModel = new ChallanSearch();
        $searchModel->withEnable = true;
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(["client_type" => $client_type]);

        return $this->render('@app/views/reports/challan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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