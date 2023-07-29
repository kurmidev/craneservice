<?php


use app\components\ImsGridView;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\components\ConstFunc as F;

$pg = Yii::$app->request->get('pg');
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
           Ledger 
        </h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-download']), \Yii::$app->urlManager->createUrl(["{$base_controller}/export-data",'type'=>"invoice",'pg'=>$pg,'id' => $model->id]), ['title' => 'Export', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0 table-responsive">
        <?= ImsGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    "attribute" => "date",
                    "content" => function ($model) {
                        return $model->date;
                    },
                    'filter' => Html::textInput('LedgerReportSearch[date_start]', '', ['class' => 'form-control cal']) . '-' . Html::textInput('LedgerReportSearch[date_end]', '', ['class' => 'form-control cal'])
                ],
                'particular',
                'invoice_no',
                'debit',
                'credit',
            ],
        ]); ?>

    </div>
</div>