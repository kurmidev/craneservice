<?php

use app\components\ImsGridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;


?>
<div class="card">
    <div class="card-body p-0 table-responsive">
        <?= ImsGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'payment_date',
                [
                    "attribute" => 'receipt_no', 'label' => "Receipt No",
                    'content' => function ($model) use ($base_controller) {
                        return Html::a($model->receipt_no, Yii::$app->urlManager->createUrl(["{$base_controller}/print-receipt", 'id' => $model->id]), ['target' => "_blank"]);
                    }
                ],
                'amount_paid',
                [
                    'attribute' => 'payment_mode', 'label' => 'Mode',
                    'content' => function ($model) {
                        return !empty($model->payment_mode) ? C::PAYMENT_MODE_LIST[$model->payment_mode] : "";
                    },
                    'filter' => C::PAYMENT_MODE_LIST,
                ],
                [
                    'attribute' => 'id', 'label' => 'D/C No',
                    'content' => function ($model) {
                        return $model->id;
                    },
                ],
                [
                    "attribute" => "", "label" => "Aginst Invoice",
                    "content" => function ($m) use ($model, $detailUrl) {
                        if (!empty($m->paymentsDetails)) {
                            $d = ArrayHelper::getColumn($m->paymentsDetails, 'invoice_id');
                            return !empty($d) ? Html::a(count(array_unique($d)), Yii::$app->urlManager->createUrl([$detailUrl, 'pay_id' => $m->id, 'id' => $model->id])) : 0;
                        }
                        return 0;
                    }
                ],
                "intrument_no",
                "instrument_date",
                "remark",
                [
                    "label" => "Action",
                    "content" => function ($data) use ($base_controller) {
                        $print = Html::a(Html::tag('span', '', ['class' => 'fa fa-print']), \Yii::$app->urlManager->createUrl(["{$base_controller}/print-receipt", 'id' => $data['id']]), ['title' => 'Print ' . $data['receipt_no'], 'class' => 'btn btn-primary-alt'])
                            . Html::a(Html::tag('span', '', ['class' => 'fa fa-trash']), \Yii::$app->urlManager->createUrl(["{$base_controller}/delete-payment", 'id' => $data['id']]), ['title' => 'Print ' . $data['receipt_no'], 'class' => 'btn btn-primary-alt']);

                        return $print;
                    }
                ]
            ],
        ]); ?>

    </div>
</div>