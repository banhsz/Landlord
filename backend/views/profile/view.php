<?php

use common\models\User;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;

/** @var View $this */
/** @var User $model */

$this->title = "Profile";
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJs("    
    $('.eye-auth-key').on('click', function () {
        $('.auth-key').removeClass('d-none');
        $('.eye-auth-key').addClass('d-none');
    });
");

?>
<div class="notification-view">
    <div class="container-fluid p-3">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'email',
                [
                    'attribute' => 'auth_key',
                    'format' => 'html',
                    'value' => function ($model) {
                        return "<a class='fa fa-eye eye-auth-key' title='Click to show'></a><span class='d-none auth-key'>" . $model->auth_key . "</span>";
                    },
                ],
            ],
        ]) ?>
    </div>
</div>
