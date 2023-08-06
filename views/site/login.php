<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" style="padding:7rem 0;">
    <div class="row">
        <div class="col-md-6 order-md-2">
            <img src="./dist/img/login_page.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="mb-4">
                        <img src="./dist/img/logo.png" alt="<?=SITE_NAME?>" style="height:200px">
                        <h3>Welcome back to <strong><?=SITE_NAME?></strong></h3>
                        <p class="mb-4">Please enter your username to log in..</p>
                    </div>
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
                        <div class="col-12 p-10 mb-10">
                            <?= $form->field($model, 'rememberMe', ['options' => ["class" => "col-12"]])->checkbox([
                                'template' => "{input} {label}",
                                ['class' => 'form-control']
                            ]) ?>
                        </div>
                        <div class="col-12 p-20 text-center">
                            <?= Html::submitButton('LOGIN', ['class' => 'btn btn-secondary p-10']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>