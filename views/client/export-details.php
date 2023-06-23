<?php


use yii\grid\GridView;
use app\components\Constants as C;
use app\models\BaseModel;

?>


    <?php if (in_array($pg, ['challan', 'pending-challan'])) { ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'showFooter' => true,
            'columns' => [
                'challan_date',
                'challan_no',
                'plan.name',
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
                [
                    'attribute' => 'down_time',
                    'footer' => "<b>Total</b>",
                ],
                [
                    'attribute' => 'base_amount', 'label' => 'Rates',
                    'footer' => BaseModel::getTotal($dataProvider->models, 'base_amount'),
                ],
                [
                    'attribute' => 'amount', 'label' => 'Amount',
                    'footer' => BaseModel::getTotal($dataProvider->models, 'amount'),
                ],
                [
                    'attribute' => 'invoice_id', 'label' => 'Is Invoice Generated',
                    'content' => function ($model) {
                        return !empty($model->invoice_id) ? "Yes" : "No";
                    },
                ],
            ],
        ]); ?>
    <?php } ?>

    <?php if (in_array($pg, ['invoice'])) { ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}',
            'showFooter' => true,
            'columns' => [
                "invoice_no",
                'invoice_date:date',
                [
                    'attribute' => 'invoice_type', 'label' => 'Invoice Type',
                    'content' => function ($model) {
                        return !empty($model->invoice_type) ? C::INVOICE_TYPE_LIST[$model->invoice_type] : "";
                    },
                ],
                [
                    'attribute' => 'id', 'label' => 'D/C No',
                    'content' => function ($model) {
                        return $model->id;
                    },
                ],
                [
                    'attribute' => "remark",
                    'footer' => "<b>Total</b>",
                ],
                [
                    'attribute' => 'base_amount',
                    'footer' => BaseModel::getTotal($dataProvider->models, 'base_amount'),
                ],
                [
                    'attribute' => 'tax',
                    'footer' => BaseModel::getTotal($dataProvider->models, 'tax'),
                ],
                [
                    'attribute' => 'total',
                    'footer' => BaseModel::getTotal($dataProvider->models, 'total'),
                ],
                [
                    'attribute' => 'status', 'label' => 'Status',
                    'content' => function ($model) {
                        if ($model->status == C::STATUS_DELETED) {
                            return "Deleted";
                        } else if ($model->payment < $model->total && $model->payment > 0) {
                            return "Partial Paid";
                        } else if ($model->payment >= $model->total) {
                            return "Paid";
                        } else {
                            return 'UN Paid';
                        }
                    },
                ],
            ],
        ]); ?>
    <?php } ?>


    <?php if (in_array($pg, ['payments'])) { ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}',
            'showFooter' => true,
            'columns' => [
                'payment_date',
                'receipt_no',
                [
                    'attribute' => 'payment_mode', 'label' => 'Mode',
                    'content' => function ($model) {
                        return !empty($model->payment_mode) ? C::PAYMENT_MODE_LIST[$model->payment_mode] : "";
                    },
                ],
                [
                    'attribute' => 'id', 'label' => 'D/C No',
                    'content' => function ($model) {
                        return $model->id;
                    },
                ],
                [
                    "attribute" => "", "label" => "Aginst Invoice",
                    "content" => function ($m) {
                        return !empty($m->invoice) ? count($m->invoice) : 0;
                    }
                ],
                "intrument_no",
                "instrument_date",
                [
                    'attribute' => "remark",
                    'footer' => "<b>Total</b>",
                ],
                [
                    'attribute' => 'amount_paid',
                    'footer' => BaseModel::getTotal($dataProvider->models, 'amount_paid'),
                ],
            ],
        ]); ?>
    <?php } ?>