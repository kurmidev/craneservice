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
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl(["{$base_controller}/add-invoice", "id" => $model->id]), ['title' => 'Add Invoice', 'class' => 'btn btn-primary btn-sm']) ?>
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-cash-register']), \Yii::$app->urlManager->createUrl(["{$base_controller}/pay-invoice", "id" => $model->id]), ['title' => 'Pay Invoice', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0 table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'invoice_no',
                'invoice_date:date',
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
                        if($model->status==C::STATUS_DELETED){
                            return "Deleted";
                        }else if($model->payment<$model->total && $model->payment>0){
                            return "Partial Paid";
                        }else if($model->payment>=$model->total){
                            return "Paid";
                        }else{
                            return 'UN Paid';
                        }
                    },
                ],
                [
                    "label" => "Action",
                    "content" => function ($data) use ($base_controller) {
                        $print =//Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl(["{$base_controller}/edit-invoice", 'id' => $data['id']]), ['title' => 'Update ' . $data['invoice_no'], 'class' => 'btn btn-primary-alt'])
                             Html::a(Html::tag('span', '', ['class' => 'fa fa-print']), \Yii::$app->urlManager->createUrl(["{$base_controller}/print-invoice", 'id' => $data['id']]), ['title' => 'Print ' . $data['invoice_no'], 'class' => 'btn btn-primary-alt',"target"=>"_blank"]);
                            if($data['payment']<=0){
                                $print.= Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl(["{$base_controller}/edit-invoice", 'id' => $data['id']]), ['title' => 'Edit ' . $data['invoice_no'], 'class' => 'btn btn-primary-alt']);
                                $print.= Html::a(Html::tag('span', '', ['class' => 'fa fa-trash']), \Yii::$app->urlManager->createUrl(["{$base_controller}/delete-invoice", 'id' => $data['id']]), ['title' => 'Delete ' . $data['invoice_no'], 'class' => 'btn btn-primary-alt']);
                            }
                            return $print;
                    }
                ]
            ],
        ]); ?>

    </div>
</div>