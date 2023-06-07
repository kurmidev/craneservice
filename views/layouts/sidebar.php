<?php

use yii\widgets\Menu;
use app\components\MenuHelper;
?>
<aside class="main-sidebar elevation-4 sidebar-light-pink">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= SITE_LOGO ?>" alt="Crane Service" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Crane Service</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <?= Menu::widget([
                'options' => ['class' => 'nav nav-pills nav-sidebar flex-column',"data-widget"=>"treeview", "role"=>"menu","data-accordion"=>"false"],
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
