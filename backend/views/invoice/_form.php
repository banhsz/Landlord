<?php

use kartik\date\DatePicker;
use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Invoice $model */
/** @var yii\widgets\ActiveForm $form */

if (($model->period_start)) $model->period_start = date('Y-m-d', $model->period_start);
if (($model->period_end)) $model->period_end = date('Y-m-d', $model->period_end);
if (($model->paid_at)) $model->paid_at = date('Y-m-d', $model->paid_at);
?>

<div class="invoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rental_id')->textInput() ?>

    <?= $form->field($model, 'period_start')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Select date ...', 'autocomplete' => "off"],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true,
            'orientation' => 'bottom',
        ]
    ]); ?>

    <?= $form->field($model, 'period_end')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Select date ...', 'autocomplete' => "off"],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true,
            'orientation' => 'bottom',
        ]
    ]); ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'paid')->widget(SwitchInput::class, [
        'pluginOptions' => [
            'onText' => 'Yes',
            'offText' => 'No',
        ]
    ]); ?>

    <?= $form->field($model, 'paid_at')->widget(DatePicker::class, [
        'options' => ['placeholder' => 'Select date ...', 'autocomplete' => "off"],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'autoclose' => true,
            'orientation' => 'bottom',
        ]
    ]); ?>

    <?= "" // $form->field($model, 'created_by')->textInput() ?>

    <?= "" // $form->field($model, 'updated_by')->textInput() ?>

    <?= "" // $form->field($model, 'created_at')->textInput() ?>

    <?= "" // $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'breakdown')->hiddenInput(['value' => $model->breakdown ?? "{}"])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
