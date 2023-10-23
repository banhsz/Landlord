<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <script src="/js/jquery/3.7.1_dist_jquery.min.js"></script>
    <script src="/js/adminlte/3.2_dist_js_adminlte.min.js"></script>
    <link rel="stylesheet" href="/css/adminlte/3.2_dist_css_adminlte.min.css">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
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
        <form class="form-inline ml-3 d-none">
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
            <li>
                <a class="btn text-white" href=""><span class="fa fa-user text-white mr-2"></span><?= Yii::$app->user->identity->username ?></a>
            </li>
            <li>
                <a class="btn" href=""><span class="fa fa-bell text-white"></span></a>
                <a class="navbar-notification-count text-white" href="">5</a>
            </li>
        </ul>
    </nav>
    <div class="content-wrapper">
        <?= $content ?>
    </div>
    <aside class="main-sidebar sidebar-dark-primary elevation-1">
        <!-- Brand Logo -->
        <div class="text-center">
            <a href="/">
                <img src="<?= Url::to('/img/pngegg.png') ?>" class="img img-fluid pt-1" style="height:75px">
            </a>
        </div>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="/" class="nav-link <?= ($controller == 'site') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Profile (<?= Yii::$app->user->identity->username ?>)
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-bell nav-icon"></i>
                                    <p>Notifications</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-user-cog nav-icon"></i>
                                    <p>Profile Settings</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link <?= ($controller == '') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-wrench"></i>
                            <p>Configuration</p>
                            <i class="right fa fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-cog nav-icon"></i>
                                    <p>Site Settings</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/apartment" class="nav-link <?= ($controller == 'apartment') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-building"></i>
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
                    <li class="nav-item">
                        <a href="/invoice" class="nav-link <?= ($controller == 'invoice') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-file-invoice-dollar"></i>
                            <p>Invoices</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link <?= ($controller == '') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-money-bill-wave"></i>
                            <p>Payments</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link <?= ($controller == '') ? 'active' : '' ?>">
                            <i class="nav-icon fa fa-ticket-alt"></i>
                            <p>Tickets</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php
                        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                            . Html::submitButton(
                                '<span class="fa fa-sign-out-alt mr-2"></span>Logout (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-light btn-block text-decoration-none']
                            )
                            . Html::endForm();
                        ?>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="main-footer d-none">
        Landlord
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
