<?php


use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\Constants as C;
use app\components\ConstFunc as F;
use app\models\PlanAttributes;

?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
            <?= Html::a(Html::tag('span', '', ['class' => 'fa fa-plus']), \Yii::$app->urlManager->createUrl(['plan/add-plan']), ['title' => 'Add New Attributes', 'class' => 'btn btn-primary btn-sm']) ?>
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
                'name',
                'code',
                'price',
                
                //'type',
                //'shift_hrs',
                //'tax_slot',
                [
                    'attribute' => 'attrbute_id', 'label' => 'Attributes',
                    'content' => function ($model) {
                        return !empty($model->attr)?$model->attr->name:"";
                    },
                    'filter' => ArrayHelper::map(PlanAttributes::find()->active()->all(), 'id', 'name'),
                ],
                [
                    'attribute' => 'status', 'label' => 'Status',
                    'content' => function ($model) {
                        return F::getLabels(C::LABEL_STATUS, $model->status);
                    },
                    'filter' => C::LABEL_STATUS,
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