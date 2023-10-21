<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Rental $model */

$this->title = 'Create Rental';
$this->params['breadcrumbs'][] = ['label' => 'Rentals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-create p-3">
    <?= $this->render('_form', [
        'model' => $model,
        'apartmentId' => $apartmentId ?? null
    ]) ?>

</div>
