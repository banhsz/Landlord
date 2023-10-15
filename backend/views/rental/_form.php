<?php

use backend\models\Apartment;
use backend\models\Tenant;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Rental $model */
/** @var yii\widgets\ActiveForm $form */

$tenantModel = new Tenant();
if (($model->rent_start)) $model->rent_start = date('Y-m-d', $model->rent_start);
if (($model->rent_end)) $model->rent_end = date('Y-m-d', $model->rent_end);

$this->registerJsFile('@web/js/rental/_form.js');
?>

<div class="rental-form p-2">
    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>

        <!-- <?= $form->field($model, 'apartment_id')->textInput() ?> -->

        <?php
            $apartments = Apartment::find()->asArray()->all();
            $apartmentList = ArrayHelper::map($apartments, 'id', 'name');
            $tenants = Tenant::find()->asArray()->all();
            $tenantList = ArrayHelper::map($tenants, 'id', 'name');
        ?>

        <?php if ($model->isNewRecord) { ?>
            <div class="toggle-buttons">
                <span>New tenant?</span>
                <?= Html::radio('toggle-radio', true, ['value' => 'yes', 'id' => 'toggle-yes']) ?>
                <?= Html::label('Yes', 'toggle-yes', ['class' => 'btn btn-success']) ?>

                <?= Html::radio('toggle-radio', false, ['value' => 'no', 'id' => 'toggle-no']) ?>
                <?= Html::label('No', 'toggle-no', ['class' => 'btn btn-danger']) ?>
            </div>

            <div id="new-tenant-div" class="mb-3">
                <h2>Tenant</h2>
                <?= $form->field($tenantModel, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($tenantModel, 'e_mail')->textInput(['maxlength' => true]) ?>

                <?= $form->field($tenantModel, 'phone')->textInput(['maxlength' => true]) ?>
            </div>
        <?php } ?>

        <h2>Rental</h2>
        <?php
            if (isset($apartmentId)) {

                echo $form->field($model, 'apartment_id')->hiddenInput(['value' => $apartmentId])->label(false);
            } else {
                echo $form->field($model, 'apartment_id')->widget(Select2::class, [
                    'data' => $apartmentList,
                    'options' => ['placeholder' => 'Select an apartment...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 0,
                    ],
                ]);
            }
        ?>

        <!-- <?= $form->field($model, 'tenant_id')->textInput() ?> -->

        <div id="apartment-id-div" <?= ($model->isNewRecord) ? 'style="display: none"' : '' ?> >
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
        </div>

        <?= $form->field($model, 'rent_start')->widget(DatePicker::class, [
            'options' => ['placeholder' => 'Select date ...', 'autocomplete' => "off"],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoclose' => true,
                'orientation' => 'bottom',
            ]
        ]); ?>

        <?= $form->field($model, 'rent_end')->widget(DatePicker::class, [
            'options' => ['placeholder' => 'Select date ...', 'autocomplete' => "off"],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                'autoclose' => true,
                'orientation' => 'bottom',
            ]
        ]); ?>

        <!--
        <?= $form->field($model, 'created_by')->textInput() ?>

        <?= $form->field($model, 'updated_by')->textInput() ?>

        <?= $form->field($model, 'created_at')->textInput() ?>

        <?= $form->field($model, 'updated_at')->textInput() ?>
        -->

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success mt-3']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
