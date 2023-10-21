<?php

/** @var yii\web\View $this */

use backend\models\Apartment;
use backend\models\Rental;
use backend\models\Tenant;
use yii\db\Query;

$this->title = 'My Yii Application';
$apartmentCount = Apartment::find()->count();
$tenantCount = Tenant::find()->count();
$rentalCount = Rental::find()->count();
$activeRentalCount = Rental::find()
    ->andWhere(['<=', 'rent_start', time()])
    ->andWhere(['OR',
            ['rent_end' => null],
            ['>=', 'rent_end', time()]])
    ->count();
$futureRentalCount = Rental::find()
    ->andWhere(['>', 'rent_start', time()])
    ->count();
$expiredRentalCount = Rental::find()
    ->andWhere(['<', 'rent_end', time()])
    ->count();
$occupiedApartmentCount = (new Query())
    ->select(['apartment.id AS apartment_id'])
    ->from('apartment')
    ->join('inner join','rental', 'apartment.id = rental.apartment_id')
    ->andWhere(['or', ['is', 'rental.rent_end', null], ['>', 'rental.rent_end', time()]])
    ->groupBy('apartment.id')
    ->count();
?>

<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Welcome <?= Yii::$app->user->identity->username ?>!</h1>
    </div>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-4" style="height: 100px">
                <h1><span class="text-landlord"><?= $apartmentCount ?></span> Apartments</h1>
                <h2><span class="text-success"><?= $occupiedApartmentCount ?></span> Occupied/Pre-booked</h2>
                <h2><span class="text-primary"><?= $apartmentCount - $occupiedApartmentCount ?></span> Free</h2>
            </div>
            <div class="col-sm-4" style="height: 100px">
                <h1><span class="text-landlord"><?= $tenantCount ?></span> Tenants</h1>
            </div>
            <div class="col-sm-4" style="height: 100px">
                <h1><span class="text-landlord"><?= $rentalCount ?></span> Total Rentals</h1>
                <h2><span class="text-success"><?= $activeRentalCount ?></span> Active</h2>
                <h2><span class="text-primary"><?= $futureRentalCount ?></span> Future</h2>
                <h2><span class="text-danger"><?= $expiredRentalCount ?></span> Expired</h2>
            </div>
        </div>
    </div>
</div>
