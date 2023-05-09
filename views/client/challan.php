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
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl([$addUrl, "id" => $model->id]), ['title' => 'Add Challan', 'class' => 'btn btn-primary btn-sm']) ?>
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
                [
                    'attribute' => 'plan_id', 'label' => 'Plan',
                    'content' => function ($model) {
                        return !empty($model->plan) ? $model->plan->name : "";
                    },
                    'filter' => ArrayHelper::map(PlanMaster::find()->active()->all(), 'id', 'name'),
                ],
                "plan_start_time",
                "plan_end_time",
                "break_time",
                "up_time",
                "amount",
                "total",
                [
                    'attribute' => 'invoice_id', 'label' => 'Is Invoice Generated',
                    'content' => function ($model) {
                        return !empty($model->invoice_id) ? "Yes" : "No";
                    },
                ],
                'actionOn',
                'actionBy',
                [
                    "label" => "Action",
                    "content" => function ($data) use ($editUrl,$printUrl) {
                        return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl([$editUrl, 'id' => $data['id']]), ['title' => 'Update ' . $data['challan_no'], 'class' => 'btn btn-primary-alt'])
                        .Html::a(Html::tag('span', '', ['class' => 'fa fa-print']), \Yii::$app->urlManager->createUrl([$printUrl, 'id' => $data['id']]), ['title' => 'Update ' . $data['challan_no'], 'class' => 'btn btn-primary-alt']);
                    }
                ]
            ],
        ]); ?>

    </div>
</div>