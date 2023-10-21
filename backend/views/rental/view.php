<?php

use backend\models\Rental;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Rental $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rentals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rental-view p-3">
    <?php if (isset($model->rent_end) && (($model->rent_end) < time())) { ?>
        <div class="alert alert-danger">
            <span class="fa fa-ban mr-2"></span>This rental has <strong>expired at <?= date("Y-m-d", $model->rent_end) ?></strong>. Tenant no longer lives there.
        </div>
    <?php } else if ($model->rent_start <= time()) { ?>
        <div class="alert alert-success">
            <span class="fa fa-check mr-2"></span>This rental is active. Tenant lives there currently.
        </div>
    <?php } else { ?>
        <div class="alert alert-primary">
            <span class="fa fa-info mr-2"></span>This rental <strong>will start in the future at <?= date("Y-m-d", $model->rent_start)?></strong>. Tenant does not live there yet.
        </div>
    <?php }  ?>

    <h1>Rental #<?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<span class="fa fa-edit mr-1"></span>Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<span class="fa fa-trash mr-1"></span>Update', ['delete', 'id' => $model->id], [
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
            [
                'attribute' => 'apartment_id',
                'label' => "Apartment",
                'value' => function ($model) {
                    return HTML::a($model->apartment->name, ['/apartment/view', 'id' => $model->apartment->id]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'tenant_id',
                'label' => "Tenant",
                'value' => function ($model) {
                    return HTML::a($model->tenant->name . " (" . $model->tenant->e_mail. ")", ['/tenant/view', 'id' => $model->tenant->id]);
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'rent_start',
                'value' => function ($model) {
                    return isset($model->rent_start) ? date('Y-m-d', $model->rent_start) : null;
                },
            ],
            [
                'attribute' => 'rent_end',
                'value' => function ($model) {
                    return isset($model->rent_end) ? date('Y-m-d', $model->rent_end) : null;
                },
            ],
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return isset($model->created_by) ? User::findOne(["id" => $model->created_by])->username : null;
                },
            ],
            [
                'attribute' => 'updated_by',
                'value' => function ($model) {
                    return isset($model->updated_by) ? User::findOne(["id" => $model->updated_by])->username : null;
                },
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return isset($model->created_at) ? date('Y-m-d', $model->created_at) : null;
                },
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return isset($model->updated_at) ? date('Y-m-d', $model->updated_at) : null;
                },
            ],
        ],
    ]) ?>

</div>
