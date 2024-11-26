<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use yii\web\Controller;

/**
 * ProfileController implements the CRUD actions for Notification model.
 */
class ProfileController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * Shows logged-in users profile data
     */
    public function actionIndex()
    {
        $model = User::findOne(Yii::$app->user->id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
