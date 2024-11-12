<?php

use backend\models\Notification;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\NotificationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index p-3">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Notification', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'options' => [
            'class' => 'table-responsive grid-view',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            if ($model->read) {
                return ['style' => 'filter: contrast(60%)'];
            } else {
                return [];
            }
        },
        'columns' => [
            [
                "attribute" => 'id',
                'headerOptions' => ['style' => 'width: 75px;'],
            ],
            'message',
            [
                "attribute" => 'source_class',
                'headerOptions' => ['style' => 'width: 250px;'],
            ],
            [
                "attribute" => 'source_entity',
                'headerOptions' => ['style' => 'width: 100px;'],
            ],
            [
                "attribute" => 'type',
                'headerOptions' => ['style' => 'width: 95px;'],
            ],
            [
                "attribute" => 'read',
                'headerOptions' => ['style' => 'width: 75px;'],
            ],
            [
                'header' => '',
                'value' => function ($model) {
                    if ($link = $model->linkToEntity()) {
                        return "<a href='" . $link . "'><span class='fa fa-link'></span></a>";
                    } else {
                        return "";
                    }
                },
                'format' => 'html',
                'headerOptions' => ['style' => 'width: 50px;']
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Notification $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'headerOptions' => ['style' => 'width: 100px;']
            ],
        ],
    ]); ?>


</div>
