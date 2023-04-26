<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Challan $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Challans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="challan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'client_id',
            'challan_date',
            'site_address',
            'operator_id',
            'helper_id',
            'plan_id',
            'vehicle_id',
            'challan_no',
            'plan_start_time',
            'plan_end_time',
            'day_wise',
            'plan_measure',
            'plan_trip',
            'from_destination',
            'to_destination',
            'amount',
            'break_time:datetime',
            'up_time:datetime',
            'down_time:datetime',
            'plan_extra_hours',
            'plan_shift_type',
            'challan_image',
            'invoice_id',
            'is_processed',
            'status',
            'created_at',
            'updated_on',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
