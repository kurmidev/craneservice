<?php

use app\models\Challan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ChallanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Challans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="challan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Challan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'client_id',
            'challan_date',
            'site_address',
            'operator_id',
            //'helper_id',
            //'plan_id',
            //'vehicle_id',
            //'challan_no',
            //'plan_start_time',
            //'plan_end_time',
            //'day_wise',
            //'plan_measure',
            //'plan_trip',
            //'from_destination',
            //'to_destination',
            //'amount',
            //'break_time:datetime',
            //'up_time:datetime',
            //'down_time:datetime',
            //'plan_extra_hours',
            //'plan_shift_type',
            //'challan_image',
            //'invoice_id',
            //'is_processed',
            //'status',
            //'created_at',
            //'updated_on',
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Challan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
