<?php

namespace app\controllers;

use app\components\Constants as C;

class CustomerController extends ClientController{


    public function __construct($id,$module)
    {
        $this->clientType = C::CLIENT_TYPE_CUSTOMER;
        $this->title = "Vendor";
        parent::__construct($id,$module);
    }

    public function actionAddCustomer(){
        return $this->actionCreate();
    }

    public function actionEditCustomer($id){
        return $this->actionUpdate($id);
    }
}