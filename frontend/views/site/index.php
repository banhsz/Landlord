<?php

/** @var yii\web\View $this */

use backend\models\Rental;
use yii\helpers\Html;

$email = "?";
$isGuest = Yii::$app->user->isGuest;
if (!$isGuest) {
    $email = Yii::$app->user->identity->email;
}

$rentals = Rental::find()
    ->joinWith('tenant')
    ->where(['tenant.e_mail' => $email])
    ->all();
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php
    var_dump($rentals);
    ?>
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Welcome <?= $isGuest ? "tenant!" : ((Yii::$app->user->identity->username . "!")) ?> </h1>
            <p class="fs-5 fw-light"><?= Html::a('<span class="fa fa-money-bill"></span> Pay rent', ['/site/pay'], ['class' => 'btn btn-success']) ?></p>
            <?php if ($isGuest) { ?>
                <p class="fs-5 fw-light">For more features, please <?= Html::a('<span class="fa fa-sign-in-alt"></span> Log in', ['/site/login'], ['class' => 'btn btn-primary']) ?></p>
                <p class="fs-5 fw-light">Don't have an account yet? <?= Html::a('<span class="fa fa-user-plus"></span> Signup', ['/site/signup'], ['class' => 'btn btn-primary']) ?></p>
            <?php } else { ?>
                <p class="fs-5 fw-light">
                    Looking for your <?= Html::a(
                    '<span class="fa fa-file-invoice-dollar"></span> Invoices',
                    ['/site/'],
                    ['class' => 'btn btn-primary m-1']) . "?" ?>
                </p>
                <p class="fs-5 fw-light">
                    Got a question/complaint? Submit a <?= Html::a(
                    '<span class="fas fa-ticket-alt"></span> Ticket',
                    ['/site/'],
                    ['class' => 'btn btn-primary']) ?>
                </p>
            <?php } ?>
        </div>
    </div>

    <div class="body-content">
    </div>
</div>
