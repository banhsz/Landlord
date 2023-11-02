<?php

namespace backend\controllers;

use backend\models\Apartment;
use backend\models\Invoice;
use backend\models\Rental;
use backend\models\Tenant;
use common\models\LoginForm;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $apartmentCount = Apartment::find()->count();
        $tenantCount = Tenant::find()->count();
        $rentalCount = Rental::find()->count();
        $activeRentalCount = Rental::find()->andWhere(['<=', 'rent_start', time()])->andWhere(['OR', ['rent_end' => null], ['>=', 'rent_end', time()]])->count();
        $futureRentalCount = Rental::find()->andWhere(['>', 'rent_start', time()])->count();
        $expiredRentalCount = Rental::find()->andWhere(['<', 'rent_end', time()])->count();
        $occupiedApartmentCount = (new Query())
            ->select(['apartment.id AS apartment_id'])
            ->from('apartment')
            ->join('inner join','rental', 'apartment.id = rental.apartment_id')
            ->andWhere(['or', ['is', 'rental.rent_end', null], ['>', 'rental.rent_end', time()]])
            ->groupBy('apartment.id')
            ->count();
        $paidInvoices = sizeof(Invoice::findAll(["paid" => 1]));
        $unpaidInvoices = sizeof(Invoice::findAll(["paid" => 0]));

        return $this->render('index', [
            "apartmentCount"            => $apartmentCount,
            "tenantCount"               => $tenantCount,
            "rentalCount"               => $rentalCount,
            "activeRentalCount"         => $activeRentalCount,
            "futureRentalCount"         => $futureRentalCount,
            "expiredRentalCount"        => $expiredRentalCount,
            "occupiedApartmentCount"    => $occupiedApartmentCount,
            "paidInvoices"              => $paidInvoices,
            "unpaidInvoices"            => $unpaidInvoices
        ]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
