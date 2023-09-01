<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Titkos $model */

$this->title = 'Create Titkos';
$this->params['breadcrumbs'][] = ['label' => 'Titkos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titkos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
