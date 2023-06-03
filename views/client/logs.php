<?php


use app\components\ImsGridView;
use app\components\Constants as C;

?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Audit Logs</h3>
        <div class="card-tools">
        </div>
    </div>
    <div class="card-body p-0 table-responsive">
        <?= ImsGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'actionOn',
                [
                    'attribute' => 'action_taken', 'label' => 'Action Taken',
                    'content' => function ($model) {
                        switch ($model->action_taken) {
                            case C::STATUS_ACTIVE:
                                return "Inserted";
                            case C::STATUS_INACTIVE:
                                return "Upated";
                            case C::STATUS_DELETED:
                                return "Deleted";
                            default:
                                return "";
                        }
                    },
                ],
                "remark",
                "actionBy"
            ],
        ]); ?>

    </div>
</div>