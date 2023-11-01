<?php

use backend\models\Invoice;
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\InvoiceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Invoices';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs("    
    $('.open-breakdown-modal').on('click', function () {
            $('#breakdown-modal').modal('show');
    });
");
?>
<div class="invoice-index p-3">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i>&nbsp;New Invoice', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-magic"></i>&nbsp;Auto Create Invoices', ['auto-create-invoices'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{pager}\n{items}\n{pager}\n{summary}", // Place the pager at the top
        'tableOptions' => ['class' => 'table table-striped'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            if ($model->paid) {
                return ['style' => 'filter: contrast(60%)'];
            } else {
                return [];
            }
        },
        'columns' => [
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Invoice $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width: 100px;'], // Adjust the width here
                'contentOptions' => ['style' => 'width: 100px;'], // Adjust the width here
            ],
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:1%'],
            ],
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
                    return $model->amount. ' Ft';
                },
            ],
            [
                'attribute' => 'paid',
                'value' => function ($model) {
                    return $model->paid ? "Yes" : "No";
                },
            ],
            //'created_by',
            //'updated_by',
            'created_at',
            //'updated_at',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <?php
        Modal::begin([
            'id' => 'breakdown-modal',
        ]);

        echo 'Modal content goes here...';

        Modal::end();
    ?>

</div>
