<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Invoice $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="invoice-view p-3">

    <h1>Invoice #<?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'rental_id',
            [
                'attribute' => 'period_start',
                'value' => function ($model) {
                    return isset($model->period_start) ? date('Y-m-d', $model->period_start) : null;
                },
            ],
            [
                'attribute' => 'period_end',
                'value' => function ($model) {
                    return isset($model->period_end) ? date('Y-m-d', $model->period_end) : null;
                },
            ],
            [
                'attribute' => 'amount',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDecimal($model->amount, 0, '.') . ' Ft';
                },
            ],
            'paid',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <?php
        $model->renderBreakdownTable();
    ?>
</div>
