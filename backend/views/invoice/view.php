<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Invoice $model */

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
        // JSON data as a string
        $jsonString = $model->breakdown;
        // Decode the JSON into a PHP array
        $data = json_decode($jsonString, true);
        // Check if decoding was successful
        if ($data !== null) {
            echo '<h1>Monthly breakdown of invoice amount</h1>';
            echo '<table border="1" class="table text-right">';
                echo '<tr><th>Month</th><th>Total Days</th><th>Rented Days</th><th>Monthly Rent</th><th>Daily Rent</th><th>Rent for This Month</th></tr>';
                foreach ($data as $month => $monthData) {
                    echo '<tr>';
                    echo '<td>' . $month . '</td>';
                    echo '<td>' . $monthData['total_days_for_month'] . '</td>';
                    echo '<td>' . $monthData['rented_days_for_month'] . '</td>';
                    echo '<td>' . $monthData['monthly_rent'] . '</td>';
                    echo '<td>' . (int)$monthData['daily_rent'] . '</td>';
                    echo '<td>' . (int)$monthData['rent_for_this_month'] . '</td>';
                    echo '</tr>';
                }
                echo '<tr>';
                echo '<td><strong>Total</strong></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td><strong>' . $model->amount . '</strong></td>';
                echo '</tr>';
            echo '</table>';
        } else {
            echo 'Invalid JSON data';
        }
    ?>
</div>
