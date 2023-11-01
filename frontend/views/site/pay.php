<?php

/** @var yii\web\View $this */
/** @var integer $invoiceId */


use backend\models\Invoice;
use backend\models\Rental;
use yii\helpers\Html;
use yii\helpers\Url;

$email = "?";
$isGuest = Yii::$app->user->isGuest;
if (!$isGuest) {
    $email = Yii::$app->user->identity->email;
}

$this->title = 'My Yii Application';
$invoice = Invoice::findOne(["id" => $invoiceId]);

$this->registerJs("    
    $('#btn-pay').on('click', function (e) {
        $('#pay-icon').toggleClass('fa-money-bill');
        $('#pay-icon').toggleClass('fa-spinner');
    });
");
?>
<div class="site-index">
    <?php if (!$invoice) { ?>
        <div class="alert alert-danger">
            <i class="fa fa-ban"></i>&nbsp;<strong>Invoice #<?=$invoiceId?> was not found</strong>
        </div>
    <?php } else if (!$invoice->paid){ ?>
        <div class="alert alert-primary w-100">
            <i class="fa fa-info-circle"></i>&nbsp<strong>Invoice #<?=$invoiceId?>. Please make sure that all data is correct before paying.</strong>
        </div>
        <?php //TODO: refactor this trash
            echo '<h1>General</h1>';
            echo '<table border="1" class="table">';
                echo '<tr>';
                    echo '<td><strong>Apartment</strong></td>';
                    echo '<td><strong>' . $invoice->rental->apartment->address . '</strong></td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td><strong>Period start</strong></td>';
                    echo '<td><strong>' . date('Y-m-d', $invoice->period_start) . '</strong></td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td><strong>Period end</strong></td>';
                    echo '<td><strong>' . date('Y-m-d', $invoice->period_end) . '</strong></td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td><strong>Amount</strong></td>';
                    echo '<td><strong>' . $invoice->amount . ' Ft' . '</strong></td>';
                echo '</tr>';
            echo '</table>';
        ?>
        <?php $invoice->renderBreakdownTable(); ?>
        <div class="mt-2 mb-2 float-end">
            <?= Html::a('<i class="fa fa-money-bill" id="pay-icon"></i> Pay', ['/site/pay-invoice', "invoiceId" => $invoiceId], ['class' => 'btn btn-success', 'id' => "btn-pay"]) ?>
        </div>
    <?php } else if ($invoice->paid) { ?>
        <div class="alert alert-success">
            <i class="fa fa-check"></i>&nbsp;<strong>Invoice #<?=$invoiceId?> is paid.</strong>
        </div>
    <?php } ?>
    <?= Html::a('Back', ['/site/pay'], ['class' => 'btn btn-primary']) ?>
</div>
