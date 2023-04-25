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

    public function actionEditVendor($id){
        return $this->actionUpdate($id);
    }
}