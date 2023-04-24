<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlanMaster $model */

$this->title = 'Create Plan Master';
$this->params['breadcrumbs'][] = ['label' => 'Plan Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
