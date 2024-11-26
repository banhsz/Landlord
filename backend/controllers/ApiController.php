<?php

namespace backend\controllers;

use backend\models\Invoice;
use backend\models\Notification;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    public User $user;
    public $enableCsrfValidation = false;

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class'     => VerbFilter::class,
            'actions'   => [ // List actions and their allowed http methods here
                'test'              => ['get', 'post', 'put'],
                'get-invoices'      => ['get'],
                'post-notification' => ['post']
            ],
        ];
        return $behaviors;
    }

    /**
     * Overrides base class beforeAction function. This will
     * force token based auth for all actions within this controller.
     *
     * Note: pass User 'auth_key' in header with name 'auth'
     *
     * @param $action
     * @return bool
     * @throws BadRequestHttpException
     */
    public function beforeAction($action) {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Find user based on passed auth token
        $token = Yii::$app->request->getHeaders()->get('auth');
        if ($token) {
            if ($potentialUser = User::findOne(['auth_key' => $token])) {
                $this->user = $potentialUser;
                return parent::beforeAction($action);
            }
        }

        // If no user was found
        Yii::$app->response->statusCode = 403;
        Yii::$app->response->data = [
            'result'    => 'error',
            'data'      => 'Access denied!'
        ];
        return false;
    }


    /**
     * GET POST PUT api/test
     *
     * @api
     * @return string[]
     */
    public function actionTest() {
        return [
            'result'    => 'Success',
            'data'      => 'It works.'
        ];
    }

    /**
     * GET api/get-invoices
     *
     * @api
     * @return array
     */
    public function actionGetInvoices() {
        return [
            'result'    => 'Success',
            'data'      => Invoice::find()->asArray()->all()
       ];
    }

    /**
     * POST api/post-notification
     * {
     *  "message": "test notification 3"
     * }
     *
     * @api
     * @return string[]
     */
    public function actionPostNotification() {
        // request body
        $data = Yii::$app->request->getRawBody();
        $dataArray = json_decode($data, true);
        if (!isset($dataArray["message"])) {
            Yii::$app->response->statusCode = 400;
            return [
                'result'    => 'Error',
                'data'      => "Bad request. Key 'message' is required!"
            ];
        }

        if (Notification::createNotification($dataArray["message"])) {
            return [
                'result' => 'Success',
            ];
        } else {
            Yii::$app->response->statusCode = 500;
            return [
                'result'    => 'Error',
                'data'      => 'Failed to create notification.',
            ];
        }

    }
}
