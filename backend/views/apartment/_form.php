<?php

use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\helpers\Url;
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

    <?= $form->field($model, 'is_smoking')->widget(SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Yes',
            'offText' => 'No',
        ]
    ]); ?>

    <?= $form->field($model, 'is_animal_allowed')->widget(SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Yes',
            'offText' => 'No',
        ]
    ]); ?>

    <?= $form->field($model, 'is_parking_spot')->widget(SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Yes',
            'offText' => 'No',
        ]
    ]); ?>

    <!--
        <?= $form->field($model, 'created_by')->textInput() ?>

        <?= $form->field($model, 'updated_by')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>
    -->

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?php
        if (isset($model->image_path)) {
            $path = Url::to('/uploads/img/' . $model->image_path);
        } else {
            $path = Url::to('/img/placeholder.png');
        }
        echo "<img class='img img-fluid img-apt-view mb-4' src='$path' alt='' style='max-width:300px'>";
    ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('<i class="fa fa-save"></i>&nbsp;Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
