<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Tenant $model */

$this->title = 'Update Tenant: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tenants', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tenant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
