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
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl([$addUrl,"id"=>$model->id]), ['title' => 'Add Challan', 'class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body p-0">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'challan_date',
                'challan_no',
                [
                    'attribute' => 'plan_id', 'label' => 'Plan',
                    'content' => function ($model) {
                        return !empty($model->plan)?$model->plan->name:"";
                    },
                    'filter' => ArrayHelper::map(PlanMaster::find()->active()->all(), 'id', 'name'),
                ],
                "plan_start_time",
                "plan_end_time",
                "break_time",
                "up_time",
                "amount",
                "total_amount",
                [
                    'attribute' => 'invoice_id', 'label' => 'Is Invoice Generated',
                    'content' => function ($model) {
                        return !empty($model->invoice_id)?"No":"Yes";
                    },
                ],
                'actionOn',
                'actionBy',
                [
                    "label" => "Action",
                    "content" => function ($data) {
                        return Html::a(Html::tag('span', '', ['class' => 'fa fa-edit']), \Yii::$app->urlManager->createUrl(['plan/edit-plan', 'id' => $data['id']]), ['title' => 'Update ' . $data['name'], 'class' => 'btn btn-primary-alt']);
                    }
                ]
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>