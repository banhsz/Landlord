<?php

use backend\models\Rental;
use backend\models\Tenant;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Apartment $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Apartments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="apartment-view p-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <h1><?= Html::encode($this->title) ?></h1>
                <p>
                    <?= Html::a('<i class="fa fa-edit"></i>&nbsp;Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<i class="fa fa-trash"></i>&nbsp;Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger pull-right',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
                <div class="col-sm-12">
                    <?php
                    if (isset($model->image_path)) {
                        $path = Url::to('/uploads/img/' . $model->image_path);
                    } else {
                        $path = Url::to('/img/placeholder.png');
                    }
                    echo "<img class='img img-fluid img-apt-view mb-4' src='$path' alt=''>";

                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'name',
                            'address',
                            'rent'
                        ],
                    ])
                    ?>
                </div>
                <div class="col-12">
                    <p class="">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <i class="fa fa-info"></i>&nbsp;Show more details
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body p-0 border-0">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'rooms',
                                    'is_smoking',
                                    'is_animal_allowed',
                                    'is_parking_spot',
                                    'created_by',
                                    'updated_by',
                                    'created_at',
                                    'updated_at',
                                    //'image_path',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div>
                    <h1>Rentals</h1>
                    <?= Html::a('<i class="fa fa-plus"></i>&nbsp;New Rental', ['rental/create', 'apartment_id' => $model->id], ['class' => 'btn btn-success']) ?>
                    <?php
                        echo GridView::widget([
                            'options' => [
                                'class' => 'table-responsive grid-view',
                            ],
                            'dataProvider' => $rentalDataProvider ?? null,
                            'filterModel' => $rentalSearchModel ?? null,
                            'columns' => [
                                //['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'id',
                                    'label' => 'Rental ID'
                                ],
                                //'apartment_id',
                                [
                                    'attribute' => 'tenant_id',
                                    'value' => function ($rentalSearchModel) {
                                        return Tenant::findOne(['id' => $rentalSearchModel->tenant_id])->name;
                                    },
                                    'label' => 'Tenant'
                                ],
                                'rent_start',
                                'rent_end',
                                //'created_by',
                                //'updated_by',
                                //'created_at',
                                //'updated_at',
                                /*
                                [
                                    'class' => ActionColumn::className(),
                                    'urlCreator' => function ($action, Rental $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    }
                                ],
                                */
                            ],
                        ]);
                        //var_dump($rentals ?? "");
                        //var_dump($rentals ? $tenant = Tenant::findOne(['id' => $rentals[0]->tenant_id]) : '');
                        //var_dump($rentals ?? "");
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
