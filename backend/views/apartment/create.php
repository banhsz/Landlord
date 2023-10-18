<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Apartment $model */

$this->title = 'Create New Apartment';
$this->params['breadcrumbs'][] = ['label' => 'Apartments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-create">
    <div class="container-fluid p-3">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>
