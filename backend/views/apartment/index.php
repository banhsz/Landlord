<?php

use backend\models\Apartment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\ApartmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array $columns */

$this->title = 'Apartments';
$this->params['breadcrumbs'][] = $this->title;
try {
    $this->registerJsFile('@web/js/stickyTableHead.js');
} catch (Exception $e) {
    var_dump($e->getMessage());
    die();
}
?>
<div class="apartment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i>&nbsp;New Apartment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns,
        'tableOptions' => ['class' => 'table table-striped'],
        'layout' => "{summary}\n{pager}\n{items}\n{pager}\n{summary}", // Place the pager at the top
    ]); ?>



    <?php Pjax::end(); ?>

</div>
