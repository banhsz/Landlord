<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Notification $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notification-view">
    <div class="container-fluid p-3">
        <h1><?= Html::encode($this->title) ?></h1>

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
                'message',
                'source_class',
                'source_entity',
                'type',
                'read',
                [
                    'attribute' => 'link',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($link = $model->linkToEntity()) {
                            return "<a href='" . $link . "'><span class='fa fa-link'></span></a>";
                        } else {
                            return "";
                        }
                    },
                ],
            ],
        ]) ?>
     </div>
</div>
