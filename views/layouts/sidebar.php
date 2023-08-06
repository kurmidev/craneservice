<?php

use yii\widgets\Menu;
use app\components\MenuHelper;
$baseUrl = MenuHelper::getCurrentAction();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="<?= SITE_LOGO ?>" alt="Crane Service" class="brand-image img-circle elevation-3" style="opacity:1;">
        <span class="brand-text font-weight-light">Crane Service</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Short Cuts</li>
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl([$baseUrl . "/add-challan"]) ?>" title="Create Challan" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p>Create Challan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl([$baseUrl . "/add-invoice"]) ?>" title="Create Invoice"  class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p>Create Invoice</p>
                    </a>
                </li>
            </ul>
            <?= Menu::widget([
                'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', "data-widget" => "treeview", "role" => "menu", "data-accordion" => "false"],
                'items' => MenuHelper::renderMenu(),
                'itemOptions' => ['class' => 'nav-item'],
                'encodeLabels' => false,
                'activateItems' => true,
                'activateParents' => true,
                'activeCssClass' => 'active',
            ]);
            ?>

        </nav>
    </div>
</aside>