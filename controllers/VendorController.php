<?php

namespace app\controllers;

use app\components\Constants as C;

class VendorController extends ClientController{


    public function __construct($id,$module)
    {
        $this->clientType = C::CLIENT_TYPE_VENDOR;
        $this->title = "Vendor";
        parent::__construct($id,$module);
    }

    public function actionAddVendor(){
        return $this->actionCreate();
    }

    public function actionEditVendor($id=null){
        return $this->actionUpdate($id);
    }

    public function actionViewVendor($id){
        return $this->actionView($id);
    }
}