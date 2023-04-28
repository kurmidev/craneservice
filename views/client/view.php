<?php

use yii\helpers\Html;


?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    </div>
                    <h3 class="profile-username text-center">
                        <?= $model->company_name ?>
                    </h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email: </b>
                            <?= $model->email ?>
                        </li>
                        <li class="list-group-item">
                            <b>Mobile No: </b>
                            <?= $model->mobile_no ?>
                        </li>
                        <li class="list-group-item">
                            <b>Phone No: </b>
                            <?= $model->phone_no ?>
                        </li>
                        <li class="list-group-item">
                            <b>Address: </b>
                            <?= $model->address ?>
                        </li>
                        <li class="list-group-item">
                            <b>GSTIN / UIN: </b>

                        </li>
                        <li class="list-group-item">
                            <b>PAN No: </b>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <?= Html::a("Pending Challan", Yii::$app->urlManager->createUrl([$baseUrl . '/pending-challan', "id" => $model->id]), ["class" => "nav-link active " . (Yii::$app->controller->action->id == "pending-challan" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Challan List", Yii::$app->urlManager->createUrl([$baseUrl . '/challan-list', "id" => $model->id]), ["class" => "nav-link " . (Yii::$app->controller->action->id == "challan-list" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Pending Invoice", Yii::$app->urlManager->createUrl([$baseUrl . '/pending-invoice', "id" => $model->id]), ["class" => "nav-link " . (Yii::$app->controller->action->id == "pending-invoice" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Invoice History", Yii::$app->urlManager->createUrl([$baseUrl . '/invoice', "id" => $model->id]), ["class" => "nav-link " . (Yii::$app->controller->action->id == "invoice" ? "active" : "")]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a("Payment History", Yii::$app->urlManager->createUrl([$baseUrl . '/payment', "id" => $model->id]), ["class" => "nav-link " . (Yii::$app->controller->action->id == "payment" ? "active" : "")]) ?>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <?= $this->render("@app/views/client/challan", [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            "addUrl" => $addUrl,
                            "model" => $model
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>