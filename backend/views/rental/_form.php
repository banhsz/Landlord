<?php

use backend\models\Apartment;
use backend\models\Tenant;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Rental $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rental-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'apartment_id')->textInput() ?> -->

    <?php
        $apartments = Apartment::find()->asArray()->all();
        $apartmentList = ArrayHelper::map($apartments, 'id', 'name');
        var_dump($apartmentList);

        $tenants = Tenant::find()->asArray()->all();
        $tenantList = ArrayHelper::map($tenants, 'id', 'name');
        var_dump($tenantList);
    ?>

    <?=
        $form->field($model, 'apartment_id')->widget(Select2::class, [
            'data' => $apartmentList,
            'options' => ['placeholder' => 'Select an apartment...'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0,
            ],
        ]);
    ?>

    <!-- <?= $form->field($model, 'tenant_id')->textInput() ?> -->

    <?=
        $form->field($model, 'tenant_id')->widget(Select2::class, [
            'data' => $tenantList,
            'options' => ['placeholder' => 'Select a tenant...'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 0,
            ],
        ]);
    ?>

    <?= $form->field($model, 'rent_start')->textInput() ?>

    <?= $form->field($model, 'rent_end')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
