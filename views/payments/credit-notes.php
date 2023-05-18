<?php


use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;



?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl([$addUrl,'id'=>$model->id]), ['title' => 'Add New Attributes', 'class' => 'btn btn-primary btn-sm']) ?>
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
                    "attribute" => 'receipt_no', 'label' => "Receipt No",
                    'content' => function ($model) use ($printUrl) {
                        return Html::a($model->receipt_no, Yii::$app->urlManager->createUrl([$printUrl, 'id' => $model->id]), ['target' => "_blank"]);
                    }
                ],
                'invoice.invoice_no',
                'base_amount',
                "tax",
                "total",
                "remark",
                [
                    "label" => "Action",
                    "content" => function ($data) use ($editUrl, $printUrl) {
                        return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl([$editUrl, 'id' => $data['client_id'],"note_id"=>$data['id']]), ['title' => 'Update ' . $data['receipt_no'], 'class' => 'btn btn-primary-alt'])
                            . Html::a(Html::tag('span', '', ['class' => 'fa fa-print']), \Yii::$app->urlManager->createUrl([$printUrl, 'id' => $data['id']]), ['title' => 'Print ' . $data['receipt_no'], 'class' => 'btn btn-primary-alt']);
                    }
                ],
            ]
        ]); ?>

    </div>
</div>