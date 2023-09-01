<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Titkos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="titkos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'a1')->textInput() ?>

    <?= $form->field($model, 'a2')->textInput() ?>

    <?= $form->field($model, 'a3')->textInput() ?>

    <?= $form->field($model, 'a4')->textInput() ?>

    <?= $form->field($model, 'a5')->textInput() ?>

    <?= $form->field($model, 'b1')->textInput() ?>

    <?= $form->field($model, 'b2')->textInput() ?>

    <?= $form->field($model, 'sorsolas')->textInput() ?>

    <?= $form->field($model, 'talalat')->textInput() ?>

    <?= $form->field($model, 'nyeremeny')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
