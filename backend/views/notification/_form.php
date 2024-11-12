<?php

use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Notification $model */
/** @var yii\widgets\ActiveForm $form */

$typeOptions = ['info', 'success', 'danger', 'warning'];
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->textInput() ?>

    <?= $form->field($model, 'source_class')->textInput() ?>

    <?= $form->field($model, 'source_entity')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList(array_combine($typeOptions, $typeOptions),
        [
            'prompt' => 'Select an option'
        ]
    ); ?>

    <?= $form->field($model, 'read')->widget(SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Yes',
            'offText' => 'No',
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
