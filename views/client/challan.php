<?php


use app\components\ImsGridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\components\ConstFunc as F;
use app\models\PlanAttributes;
use app\models\PlanMaster;

$pg = Yii::$app->request->get('pg');
if (empty($pg)) {
    $pg = "pending-challan";
}
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <?= !empty($amount) ? ("Total :" . CURRENCY_SYMBOL . " " . $amount) : "" ?>
        </h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl(["{$base_controller}/add-challan", "id" => $model->id]), ['title' => 'Add Challan', 'class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-download']), \Yii::$app->urlManager->createUrl(["{$base_controller}/export-data", 'type' => "challan", 'pg' => $pg, 'id' => $model->id]), ['title' => 'Export', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0 table-responsive">


        <?= ImsGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    "attribute" => "challan_date",
                    "content" => function ($model) {
                        return $model->challan_date;
                    },
                    'filter' => Html::textInput('ChallanSearch[challan_created_start]', '', ['class' => 'form-control cal']) . '-' . Html::textInput('ChallanSearch[challan_created_end]', '', ['class' => 'form-control cal'])
                ],
                [
                    "attribute" => "challan_no", "label" => "Challan No",
                    "content" => function ($model) use ($base_controller) {
                        return  Html::a($model->challan_no, \Yii::$app->urlManager->createUrl(["{$base_controller}/print-challan", 'id' => $model->id]), ['title' => 'Print ' . $model->challan_no,]);
                    },
                ],
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
                    "attribute" => "", "label" => "Total Hours/Qty",
                    'content' => function ($model) {
                        return $model->plan->type == C::PACKAGE_WISE_TRIP ? $model->plan_trip : date('H:i', mktime(0, (strtotime($model->plan_end_time) - strtotime($model->plan_start_time)) / 60));
                    }
                ],
                "plan_start_time",
                "plan_end_time",
                "break_time",
                "up_time",
                "down_time",
                [
                    'attribute' => 'base_amount', 'label' => 'Rate',
                    'content' => function ($model) {
                        return $model->base_amount;
                    },
                ],
                [
                    'attribute' => 'amount', 'label' => 'Amount',
                    'content' => function ($model) {
                        return $model->amount + $model->extra;
                    },
                ],
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
                        if (empty($data['invoice_id'])) {
                            $print .= Html::button(Html::tag('span', '', ['class' => 'fa fa-trash']), [
                                "data-url" => \Yii::$app->urlManager->createUrl(["{$base_controller}/delete-challan", 'id' => $data['id']]),
                                "data-title" => "Delete challan " . $data['challan_no'],
                                "data-body" => "Do you want to delete " . $data['challan_no'] . "?",
                                'class' => 'btn btn-primary-alt deletemodal'
                            ]);
                        }

                        return $print;
                    }
                ]
            ],
        ]); ?>

    </div>
</div>