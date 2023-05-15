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
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl([$addUrl, "id" => $model->id]), ['title' => 'Add Invoice', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0 table-responsive">


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'invoice_no',
                [
                    'attribute' => 'invoice_type', 'label' => 'Invoice Type',
                    'content' => function ($model) {
                        return !empty($model->invoice_type) ?C::INVOICE_TYPE_LIST[ $model->invoice_type] : "";
                    },
                    'filter' => ArrayHelper::map(PlanMaster::find()->active()->all(), 'id', 'name'),
                ],
                [
                    'attribute' => 'id', 'label' => 'D/C No',
                    'content' => function ($model) {
                        return $model->id;
                    },
                ],
                "remark",
                "base_amount",
                "tax",
                "total",
                [
                    'attribute' => 'status', 'label' => 'Status',
                    'content' => function ($model) {
                        return !empty($model->status) ? "Paid" : "Pending";
                    },
                ],
                [
                    "label" => "Action",
                    "content" => function ($data) use ($editUrl, $printUrl) {
                        return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl([$editUrl, 'id' => $data['id']]), ['title' => 'Update ' . $data['invoice_no'], 'class' => 'btn btn-primary-alt'])
                            . Html::a(Html::tag('span', '', ['class' => 'fa fa-print']), \Yii::$app->urlManager->createUrl([$printUrl, 'id' => $data['id']]), ['title' => 'Update ' . $data['invoice_no'], 'class' => 'btn btn-primary-alt']);
                    }
                ]
            ],
        ]); ?>

    </div>
</div>