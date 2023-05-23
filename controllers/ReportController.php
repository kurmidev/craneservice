<?php

namespace app\controllers;

use app\controllers\BaseReportController;
use app\components\Constants as C;

class ReportController extends BaseReportController{

    public function actionCustomerChallan(){
        $type = C::CLIENT_TYPE_CUSTOMER;
        return $this->_challan($type);
    }


    public function actionCustomerInvoice(){
        $type = C::CLIENT_TYPE_CUSTOMER;
        return $this->_invoice($type);
    }


    public function actionCustomerPayment(){
        $type = C::CLIENT_TYPE_CUSTOMER;
        return $this->_payment($type);
    }

    public function actionVendorChallan(){
        $type = C::CLIENT_TYPE_VENDOR;
        return $this->_challan($type);
    }


    public function actionVendorInvoice(){
        $type = C::CLIENT_TYPE_VENDOR;
        return $this->_invoice($type);
    }


    public function actionVendorPayment(){
        $type = C::CLIENT_TYPE_VENDOR;
        return $this->_payment($type);
    }


}