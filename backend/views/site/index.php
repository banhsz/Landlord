<?php
/** @var yii\web\View $this */

use backend\models\Invoice;
use backend\models\Notification;
use yii\web\View;

$this->title = 'Landlord';
$invoiceData = Invoice::getDashboardInvoiceData();
$notifications = Notification::getLatestNotifications();

$this->registerJs("    
    let invoiceData = ".json_encode($invoiceData).";
", View::POS_HEAD); // Must be loaded first
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
                <h5 class="text-secondary font-weight-bold pb-2">Notifications</h5>
                <?php foreach ($notifications as $notification) { ?>
                    <a href="/notification/view?id=<?= $notification->id ?>">
                        <div class="alert alert-<?= $notification->type ?> d-flex flex-row justify-content-between">
                            <div class="text-left">
                                <span class=" <?= !$notification->read ? 'fa fa-exclamation text-danger' : '' ?> mr-2"></span><strong class="mr-2"><?= $notification->message ?></strong>
                            </div>
                            <div class="text-right">
                                <strong>2023-11-04 16:40</strong>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
            <div class="col-sm-6 col-xl-4 col-xxl-3 p-4 max-h-450">
                <canvas id="invoiceChart" data-paid="<?= $paidInvoices ?? 0 ?>" data-unpaid="<?= $unpaidInvoices ?? 0 ?>"></canvas>
            </div>
            <div class="col-sm-6 col-xl-4 col-xxl-3 p-4 max-h-450">
                <canvas id="apartmentChart" data-ocucupied="<?= $occupiedApartmentCount ?? 0 ?>" data-free="<?= ($apartmentCount ?? 0) - ($occupiedApartmentCount ?? 0)?>"></canvas>
            </div>
            <div class="col-sm-6 col-xl-4 col-xxl-3 p-4 max-h-450">
                <canvas id="rentalChart" data-active="<?= $activeRentalCount ?? 0 ?>" data-future="<?= $futureRentalCount ?? 0 ?>" data-expired="<?= $expiredRentalCount ?? 0 ?>"></canvas>
            </div>
            <div class="col-sm-6 col-xl-4 col-xxl-3 p-4 max-h-450">
                <canvas id="tenantChart" data-tenant="<?= $tenantCount ?? 0 ?>"> </canvas>
            </div>
        </div>
    </div>
</div>
