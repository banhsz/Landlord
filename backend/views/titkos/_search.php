<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TitkosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="titkos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'a1') ?>

    <?= $form->field($model, 'a2') ?>

    <?= $form->field($model, 'a3') ?>

    <?= $form->field($model, 'a4') ?>

    <?php // echo $form->field($model, 'a5') ?>

    <?php // echo $form->field($model, 'b1') ?>

    <?php // echo $form->field($model, 'b2') ?>

    <?php // echo $form->field($model, 'sorsolas') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
