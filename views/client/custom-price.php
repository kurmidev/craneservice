<?php


use app\components\ImsGridView;
use yii\helpers\Html;

?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl(["{$base_controller}/add-custom-price", "id" => $model->id]), ['title' => 'Add Custom Price', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0 table-responsive">


        <?= ImsGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'plan.name:text:Plan',
                'plan.price:raw:Actual Price',
                'custom_price:raw:Customer Price',
                'actionOn',
                'actionBy',
                [
                    "label" => "Action",
                    "content" => function ($data) {
                        return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl(["customer/edit-custom-price", 'id' => $data['id']]), ['title' => 'Update Custom Price ', 'class' => 'btn btn-primary-alt']);
                    }
                ]
            ],
        ]); ?>

    </div>
</div>