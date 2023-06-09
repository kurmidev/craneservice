<?php


use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\components\ConstFunc as F;
use app\models\PlanAttributes;
use app\models\PlanMaster;

?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
            
        </div>
    </div>
    <div class="card-body p-0 table-responsive">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'challan_date',
                'challan_no',
                'company.name',
                'mobile_no',
                'phone_no',
                'plan.name',
                [
                    'attribute' => 'id', 'label' => 'D/C No',
                    'content' => function ($model) {
                        return $model->id;
                    },
                ],
                [
                    "attribute"=>"","label"=>"Total Hours/Qty",
                    'content' => function($model){
                        return $model->plan->type==C::PACKAGE_WISE_TRIP?$model->plan_trip:date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60));
                    }
                ],
                "plan_start_time",
                "plan_end_time",
                "break_time",
                "up_time",
                "down_time",
                "amount",
                "total",
                [
                    'attribute' => 'invoice_id', 'label' => 'Is Invoice Generated',
                    'content' => function ($model) {
                        return !empty($model->invoice_id) ? "Yes" : "No";
                    },
                ],
                [
                    "label" => "Action",
                    "content" => function ($data) use ($editUrl, $printUrl) {
                        return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl([$editUrl, 'id' => $data['id']]), ['title' => 'Update ' . $data['challan_no'], 'class' => 'btn btn-primary-alt'])
                            . Html::a(Html::tag('span', '', ['class' => 'fa fa-print']), \Yii::$app->urlManager->createUrl([$printUrl, 'id' => $data['id']]), ['title' => 'Print ' . $data['challan_no'], 'class' => 'btn btn-primary-alt']);
                    }
                ]
            ],
        ]); ?>

    </div>
</div>