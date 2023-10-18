<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Apartment $model */

$this->title = 'Update Apartment: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Apartments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="apartment-update">
    <div class="container-fluid p-3">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
