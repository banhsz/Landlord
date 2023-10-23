<?php

/** @var yii\web\View $this */
/** @var integer $invoiceId */


use backend\models\Invoice;
use backend\models\Rental;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$email = "?";
$isGuest = Yii::$app->user->isGuest;
if (!$isGuest) {
    $email = Yii::$app->user->identity->email;
}

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="invoice-form">
        <?php $form = ActiveForm::begin(["method" => "get"]); ?>

        <?= Html::label('Invoice #', 'invoice_id') ?>
        <?= Html::input('number', 'invoiceId', null, ['class' => 'form-control']) ?>

        <div class="form-group mt-2">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
