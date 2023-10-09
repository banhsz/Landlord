<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="layout-fixed">
<?php $this->beginBody() ?>
<div class="wrapper">
    <?php //not having this breaks bootstrap js for some fucking reason
        NavBar::begin([
            'options' => [
                'style' => 'display: none;',
            ],
        ]);
        NavBar::end();
    ?>

    <?php $controller = Yii::$app->controller->id ?>
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item pl-2 pr-2">
                <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto pr-2">
            <?php
                echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-light text-decoration-none']
                    )
                    . Html::endForm();
            ?>
        </ul>
    </nav>
    <div class="content-wrapper">
        <?= $content ?>
    </div>
    <aside class="main-sidebar sidebar-dark-primary elevation-1">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-light">Landlord</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="/" class="nav-link <?= ($controller == 'site') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/apartment" class="nav-link <?= ($controller == 'apartment') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-building"></i>
                            <p>Apartments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/rental" class="nav-link <?= ($controller == 'rental') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-key"></i>
                            <p>Rentals</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/tenant" class="nav-link <?= ($controller == 'tenant') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-male"></i>
                            <p>Tenants</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="main-footer">
        Footer
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
