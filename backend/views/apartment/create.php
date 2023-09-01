<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Apartment $model */

$this->title = 'Create Apartment';
$this->params['breadcrumbs'][] = ['label' => 'Apartments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apartment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
