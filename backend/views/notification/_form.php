<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Notification $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'message')->textInput() ?>

    <?= $form->field($model, 'source_class')->textInput() ?>

    <?= $form->field($model, 'source_entity')->textInput() ?>

    <?= $form->field($model, 'read')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
