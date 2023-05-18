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

$this->title = "Payment details for  receipt {$title}";

?>
<div class="card">
    <div class="card-body p-0 table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'invoice.invoice_no',
                'invoice.invoice_date',
                'challan.challan_no',
                'challan.challan_date',
                'challan.total',
                'challan.amount_paid',
            ],
        ]); ?>

    </div>
</div>