<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-12 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-12 form-control'],
            'errorOptions' => ['class' => 'col-lg-12 invalid-feedback'],
        ],
    ]); ?>

    <div class="input-group mb-3">
        <?=
        $form->field($model, 'username', ['options' => ['class' => 'row']])->textInput()
            ->input('text', ['class' => 'form-control uname', "placeholder" => "Enter your username"]);
        ?>
    </div>
    <div class="input-group mb-3">
        <?=
        $form->field($model, 'password', ['options' => ['class' => 'row']])->passwordInput()
            ->input('password', ['class' => 'form-control pword', "placeholder" => "Enter your password"]);
        ?>
    </div>

    <div class="row">
        <div class="col-8 p-10">
            <?= $form->field($model, 'rememberMe', ['options' => ["class" => "col-12"]])->checkbox([
                'template' => "{input} {label}",
                ['class' => 'form-control']
            ]) ?>
        </div>
        <div class="col-4">
            <?= Html::submitButton('LOGIN', ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>