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
        <h1 class="display-4">Welcome Landlord!</h1>
        <p class="lead">This is your landing page</p>
    </div>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-4" style="height: 200px">
                <h1 style="position: relative; top:50%"><span class="text-landlord"><?= $apartmentCount ?></span> apartments</h1>
            </div>
            <div class="col-sm-4" style="height: 200px">
                <h1 style="position: relative; top:50%"><span class="text-landlord"><?= $tenantCount ?></span> unique tenants</h1>
            </div>
            <div class="col-sm-4" style="height: 200px">
                <h1 style="position: relative; top:50%"><span class="text-landlord"><?= $rentalCount ?></span> total rentals</h1>
            </div>
        </div>
    </div>
</div>
