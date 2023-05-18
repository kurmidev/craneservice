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
    <div class="card-body p-0 table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'payment_date',
                'receipt_no',
                [
                    "attribute" => 'receipt_no', 'label' => "Receipt No",
                    'content' => function ($model) use ($printlUrl) {
                        return Html::a($model->receipt_no, Yii::$app->urlManager->createUrl([$printlUrl, 'id' => $model->id]), ['target' => "_blank"]);
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
            ],
        ]); ?>

    </div>
</div>