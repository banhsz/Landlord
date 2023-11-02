<?php

/** @var yii\web\View $this */

use backend\models\Apartment;
use backend\models\Rental;
use backend\models\Tenant;
use yii\db\Query;
use yii\web\View;

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

$this->registerJsFile('/js/chart/chart.js', ['position' => View::POS_END]);
$this->registerJsFile('/js/chart/chartjs-plugin-datalabels.js', ['position' => View::POS_END]);
$this->registerJsFile('/js/chart/index/indexCharts.js', ['position' => View::POS_END]);
?>

<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Welcome <?= Yii::$app->user->identity->username ?>!</h1>
    </div>
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-4 p-5">
                <canvas id="apartmentChart" data-ocucupied="<?= $occupiedApartmentCount ?>" data-free="<?= $apartmentCount - $occupiedApartmentCount ?>"></canvas>
            </div>
            <div class="col-sm-4 p-5">
                <canvas id="tenantChart" data-tenant="<?= $tenantCount ?>"></canvas>
            </div>
            <div class="col-sm-4 p-5">
                <canvas id="rentalChart" data-active="<?= $activeRentalCount ?>" data-future="<?= $futureRentalCount ?>" data-expired="<?= $expiredRentalCount ?>"></canvas>
            </div>
        </div>
    </div>
</div>
