<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Apartment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="apartment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rent')->textInput() ?>

    <?= $form->field($model, 'rooms')->textInput() ?>

    <?= $form->field($model, 'is_smoking')->textInput() ?>

    <?= $form->field($model, 'is_animal_allowed')->textInput() ?>

    <?= $form->field($model, 'is_parking_spot')->textInput() ?>

    <!--
        <?= $form->field($model, 'created_by')->textInput() ?>

        <?= $form->field($model, 'updated_by')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>
    -->

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('<i class="fa fa-save"></i>&nbsp;Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
