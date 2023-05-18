<?php

use app\components\MenuHelper;

$data = MenuHelper::renderPageTitle($this->context->action->controller->id, $this->context->action->id);
$title= !empty($data['title'])?$data['title']:(!empty($this->title)?$this->title:"");

?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><?= $title ?></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content-header">
  <div class="col-sm-12">
    <?php if (Yii::$app->session->hasFlash('s')) { ?>
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?= Yii::$app->session->getFlash('s'); ?>
      </div>
    <?php } ?>
    <?php if (Yii::$app->session->hasFlash('e')) { ?>
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?= Yii::$app->session->getFlash('e'); ?>
      </div>
    <?php } ?>
  </div>
</div>