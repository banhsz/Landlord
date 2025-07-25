<?php

use backend\models\Titkos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\TitkosSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Titkos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titkos-index p-3">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus pr-1"></i>Create Titkos', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-magic pr-1"></i>Auto Create Titkos', ['auto-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'options' => [
            'class' => 'table-responsive grid-view',
        ],
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'Numbers',
                'value' => function ($model) {
                    return $model->getFormattedNumberText();
                },
                'contentOptions' => ['style' => 'white-space: nowrap;'],
            ],
            [
                'attribute' => 'sorsolas',
                'value' => function ($model) {
                    return date('m/d', $model->sorsolas);
                },
                'contentOptions' => ['style' => 'white-space: nowrap;'],
            ],
            [
                'attribute' => 'talalat',
                'contentOptions' => ['style' => 'white-space: nowrap;'],
            ],
            [
                'attribute' => 'nyeremeny',
                'contentOptions' => ['style' => 'white-space: nowrap;'],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Titkos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
