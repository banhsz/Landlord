<?php

use backend\models\Rental;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\RentalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Rentals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rental-index p-3">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i>&nbsp;New Rental', ['create'], ['class' => 'btn btn-success']) ?>
        <a href="<?= Url::to(['/rental', "activeOnly" => 1]); ?>" class="btn btn-primary"><span class="fa fa-user-check mr-1"></span>Show active only</a>
        <a href="<?= Url::to('/rental'); ?>" class="btn btn-primary"><span class="fa fa-user mr-1"></span>Show all</a>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-striped'],
        'options' => [
            'class' => 'table-responsive grid-view',
        ],
        'rowOptions' => function ($model, $key, $index, $grid) {
            if ($model->isExpired()) {
                return ['style' => 'filter: contrast(60%)'];
            } else {
                return [];
            }
        },
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            /*
            [
                'attribute' => 'rent days',
                'value' => function($model) {
                    return (isset($model->rent_start) && isset($model->rent_end)) ?
                        (($model->rent_end - $model->rent_start) / (60 * 60 * 24) + 1) : null;
                }
            ],*/
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Rental $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width: 100px;'], // Adjust the width here
                'contentOptions' => ['style' => 'width: 100px;'], // Adjust the width here
            ],
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:1%'],
            ],
            [
                'attribute' => 'apartment',
                'value' => function($model) {
                    return (isset($model->apartment_id)) ?
                        ($model->apartment->name) : null;
                }
            ],
            [
                'attribute' => 'tenant',
                'value' => function($model) {
                    return (isset($model->tenant_id)) ?
                        ($model->tenant->name) : null;
                }
            ],
            [
                'attribute' => 'rent_start',
                'value' => function($model) {
                    return (isset($model->rent_start)) ? date('Y-m-d', $model->rent_start) : null;
                }
            ],
            [
                'attribute' => 'rent_end',
                'value' => function($model) {
                    return (isset($model->rent_end)) ? date('Y-m-d', $model->rent_end) : null;
                }
            ],
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
        ],
        'layout' => "{summary}\n{pager}\n{items}\n{pager}\n{summary}",
    ]); ?>

    <?php Pjax::end(); ?>

</div>
