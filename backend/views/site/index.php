<?php

/** @var yii\web\View $this */

use backend\models\Apartment;
use backend\models\Rental;
use backend\models\Tenant;

$this->title = 'My Yii Application';
$apartmentCount = Apartment::find()->count();
$tenantCount = Tenant::find()->count();
$rentalCount = Rental::find()->count();
?>

<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Welcome <?= Yii::$app->user->identity->username ?>!</h1>
    </div>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-4" style="height: 100px">
                <h1><span class="text-landlord"><?= $apartmentCount ?></span> Apartments</h1>
            </div>
            <div class="col-sm-4" style="height: 100px">
                <h1><span class="text-landlord"><?= $tenantCount ?></span> Tenants</h1>
            </div>
            <div class="col-sm-4" style="height: 100px">
                <h1><span class="text-landlord"><?= $rentalCount ?></span> Total Rentals</h1>
            </div>
        </div>
    </div>
</div>
