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
            <div class="col-sm-12 col-xl-12 col-xxl-6 p-4">
                <canvas id="paymentChart"> </canvas>
            </div>
            <div class="col-sm-12 col-xl-12 col-xxl-6 p-4">
                <h5 class="text-secondary font-weight-bold pb-2">Notifications (mock data)</h5>
                <div class="alert alert-success d-flex flex-row justify-content-between">
                    <div class="text-left">
                        <span class="fa fa-money-bill-wave mr-2 text-success"></span><strong class="mr-2">Payment #23 received for invoice #155</strong>
                    </div>
                    <div class="text-right">
                        <strong>2023-11-04 16:40</strong>
                    </div>
                </div>
                <div class="alert alert-danger d-flex flex-row justify-content-between">
                    <div class="text-left">
                        <span class="fa fa-exclamation mr-2 text-danger"></span><strong class="mr-2">New ticket #2</strong>
                    </div>
                    <div class="text-right">
                        <strong>2023-11-01 09:03</strong>
                    </div>
                </div>
                <div class="alert alert-primary d-flex flex-row justify-content-between">
                    <div class="text-left">
                        <span class="fa fa-info mr-2 text-primary"></span><strong class="mr-2"> Invoices auto generated successfully</strong>
                    </div>
                    <div class="text-right">
                        <strong>2023-10-31 15:30</strong>
                    </div>
                </div>
                <div class="alert alert-primary d-flex flex-row justify-content-between">
                    <div class="text-left">
                        <span class="fa fa-info mr-2 text-primary"></span><strong class="mr-2"> Next invoice period is ending today</strong>
                    </div>
                    <div class="text-right">
                        <strong>2023-10-31 08:00</strong>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 col-xxl-3 p-4">
                <canvas id="invoiceChart" data-paid="<?= $paidInvoices ?? 0 ?>" data-unpaid="<?= $unpaidInvoices ?? 0 ?>"></canvas>
            </div>
            <div class="col-sm-6 col-xl-4 col-xxl-3 p-4">
                <canvas id="apartmentChart" data-ocucupied="<?= $occupiedApartmentCount ?? 0 ?>" data-free="<?= ($apartmentCount ?? 0) - ($occupiedApartmentCount ?? 0)?>"></canvas>
            </div>
            <div class="col-sm-6 col-xl-4 col-xxl-3 p-4">
                <canvas id="rentalChart" data-active="<?= $activeRentalCount ?? 0 ?>" data-future="<?= $futureRentalCount ?? 0 ?>" data-expired="<?= $expiredRentalCount ?? 0 ?>"></canvas>
            </div>
            <div class="col-sm-6 col-xl-4 col-xxl-3 p-4">
                <canvas id="tenantChart" data-tenant="<?= $tenantCount ?? 0 ?>"> </canvas>
            </div>
        </div>
    </div>
</div>
