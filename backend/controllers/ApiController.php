<?php

namespace backend\controllers;

use backend\models\Apartment;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    public $enableCsrfValidation = false; // Disable CSRF validation for API

    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['your-action'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'your-action' => ['get'], // Specify that 'your-action' only accepts GET requests
                ],
            ],
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
            ],
        ];
    }

    public function actionYourAction()
    {
        //$response = ['message' => 'This is a modelless API endpoint'];
        //return $response;
        $apartments = Apartment::find()->asArray()->all();
        return $apartments;
    }
}
