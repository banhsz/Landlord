<?php

use backend\models\Tenant;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\TenantSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tenants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenant-index p-3">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i>&nbsp;New Tenant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'options' => [
            'class' => 'table-responsive grid-view',
        ],
        'tableOptions' => ['class' => 'table table-striped'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tenant $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width: 300px !important;', 'label' => "actions"], // Adjust the width here
                'contentOptions' => ['class' => 'action-column-nowrap'], // Adjust the width here
                'header' => 'Actions&nbsp;'
            ],
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:1%'],
            ],
            'name',
            'e_mail',
            'phone',
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
        ],
        'layout' => "{summary}\n{pager}\n{items}\n{pager}\n{summary}",
    ]); ?>

    <?php Pjax::end(); ?>

</div>
