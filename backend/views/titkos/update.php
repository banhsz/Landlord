<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Titkos $model */

$this->title = 'Update Titkos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Titkos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="titkos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
