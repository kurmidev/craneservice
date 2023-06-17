<?php


use app\components\ImsGridView;

$this->title = "Payment details for  receipt {$title}";

?>
<div class="card">
    <div class="card-body p-0 table-responsive">
        <?= ImsGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'invoice_no',
                'invoice_date',
                'work_order_no',
                'vendor_no',
                'total',
                'payment',
            ],
        ]); ?>

    </div>
</div>