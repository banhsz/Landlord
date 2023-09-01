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
<div class="titkos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Titkos', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Auto Create Titkos', ['auto-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'a1',
            'a2',
            'a3',
            'a4',
            'a5',
            'b1',
            'b2',
            [
                'attribute' => 'sorsolas',
                'value' => function ($model) {
                    return date('Y-M-d', $model->sorsolas);
                },
            ],
            'talalat',
            'nyeremeny',
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
