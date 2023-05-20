<?php


use yii\grid\GridView;
use yii\helpers\Html;

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
                'date',
                [
                    "attribute" => 'quotation_no', 'label' => "Receipt No",
                    'content' => function ($model) use ($printUrl) {
                        return Html::a($model->quotation_no, Yii::$app->urlManager->createUrl([$printUrl, 'id' => $model->id]), ['target' => "_blank"]);
                    }
                ],
                "subject",
                'base_amount',
                "tax",
                "total",
            ],
        ]); ?>

    </div>
</div>