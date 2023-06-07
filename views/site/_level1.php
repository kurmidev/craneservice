<?php

use yii\helpers\Html;
use app\components\Constants as C;

$baseModel = $model->client_type== C::CLIENT_TYPE_CUSTOMER?"customer":"vendor";

?>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Customer <br> &nbsp;</span>
            <span class="info-box-number"><?=Html::a($model->totalCustomer,Yii::$app->urlManager->createUrl(["customer/index"]))?></span>
        </div>

    </div>
</div>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Invoice <br> &nbsp; </span>
            <span class="info-box-number"><?=Html::a($model->totalInvoice,Yii::$app->urlManager->createUrl(["report/".$baseModel."-invoice"]))?></span>
        </div>
    </div>
</div>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Outstanding <br> &nbsp; </span>
            <span class="info-box-number"><?=Html::a($model->totalOutstanding,Yii::$app->urlManager->createUrl(["report/".$baseModel."-invoice",'InvoiceMasterSearch[invoice_status]'=>1]))?></span>
        </div>
    </div>
</div>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Paid <br> &nbsp;</span>
            <span class="info-box-number"><?=Html::a($model->totalPaid,Yii::$app->urlManager->createUrl(["report/".$baseModel."-payment"]))?></span>
        </div>
    </div>
</div>



<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-atom"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Total <br> Challan</span>
            <span class="info-box-number">
                <?=Html::a($model->totalChallan,Yii::$app->urlManager->createUrl("report/".$baseModel."-challan"))?>
            </span>
        </div>
    </div>
</div>

<div class="col-2 col-sm-2 col-md-2">
    <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-people-carry"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Pending <br> Challan</span>
            <span class="info-box-number">
            <?=Html::a($model->pendingChallan,Yii::$app->urlManager->createUrl(["report/".$baseModel."-challan","ChallanSearch[challan_status]"=>2]))?>
            </span>
        </div>
    </div>
</div>




