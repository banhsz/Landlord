<?php
/** @var yii\web\View $this */

use yii\web\View;

$this->title = 'My Yii Application';

$this->registerJsFile('/js/chart/chart.js', ['position' => View::POS_END]);
$this->registerJsFile('/js/chart/chartjs-plugin-datalabels.js', ['position' => View::POS_END]);
$this->registerJsFile('/js/chart/index/indexCharts.js', ['position' => View::POS_END]);
?>

<div class="site-index">
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-4 p-5">
                <canvas id="invoiceChart" data-paid="<?= $paidInvoices ?? 0 ?>" data-unpaid="<?= $unpaidInvoices ?? 0 ?>"></canvas>
            </div>
            <div class="col-sm-4 p-5">
                <canvas id="apartmentChart" data-ocucupied="<?= $occupiedApartmentCount ?? 0 ?>" data-free="<?= ($apartmentCount ?? 0) - ($occupiedApartmentCount ?? 0)?>"></canvas>
            </div>
            <div class="col-sm-4 p-5">
                <canvas id="rentalChart" data-active="<?= $activeRentalCount ?? 0 ?>" data-future="<?= $futureRentalCount ?? 0 ?>" data-expired="<?= $expiredRentalCount ?? 0 ?>"></canvas>
            </div>
            <div class="col-sm-3 p-5">
                <canvas id="tenantChart" data-tenant="<?= $tenantCount ?? 0 ?>"> </canvas>
            </div>
        </div>
    </div>
</div>
