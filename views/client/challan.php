<?php


use app\components\ImsGridView;
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
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl(["{$base_controller}/add-challan", "id" => $model->id]), ['title' => 'Add Challan', 'class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-download']), \Yii::$app->urlManager->createUrl(["{$base_controller}/print-ledger",'id'=>$model->id]), ['title' => 'Export', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0 table-responsive">


        <?= ImsGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'challan_date',
                'challan_no',
                [
                    'attribute' => 'plan_id', 'label' => 'Plan',
                    'content' => function ($model) {
                        return !empty($model->plan) ? $model->plan->name : "";
                    },
                    'filter' => ArrayHelper::map(PlanMaster::find()->active()->all(), 'id', 'name'),
                ],
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
                "base_amount",
                "amount",
                [
                    'attribute' => 'invoice_id', 'label' => 'Is Invoice Generated',
                    'content' => function ($model) {
                        return !empty($model->invoice_id) ? "Yes" : "No";
                    },
                ],
                [
                    "label" => "Action",
                    "content" => function ($data) use ($base_controller) {
                        $print = Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl(["{$base_controller}/edit-challan", 'id' => $data['id']]), ['title' => 'Update ' . $data['challan_no'], 'class' => 'btn btn-primary-alt'])
                            . Html::a(Html::tag('span', '', ['class' => 'fa fa-print']), \Yii::$app->urlManager->createUrl(["{$base_controller}/print-challan", 'id' => $data['id']]), ['title' => 'Print ' . $data['challan_no'], 'class' => 'btn btn-primary-alt']);
                            if(empty($data['invoice_id'])){
                                $print.= Html::a(Html::tag('span', '', ['class' => 'fa fa-trash']), \Yii::$app->urlManager->createUrl(["{$base_controller}/delete-challan", 'id' => $data['id']]), ['title' => 'Print ' . $data['challan_no'], 'class' => 'btn btn-primary-alt']);
                            }

                            return $print;
                    }
                ]
            ],
        ]); ?>

    </div>
</div>