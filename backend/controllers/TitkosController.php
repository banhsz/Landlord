<?php

namespace backend\controllers;

use backend\models\Titkos;
use backend\models\TitkosSearch;
use DateTime;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TitkosController implements the CRUD actions for Titkos model.
 */
class TitkosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Titkos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TitkosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Titkos model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Titkos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Titkos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Titkos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Titkos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Titkos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Titkos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Titkos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAutoCreate() {
        // Pick numbers. Scuffed af
        // A
        $numbersA = range(1, 50);
        shuffle($numbersA);
        $numbersAPicked = array_slice($numbersA, 0, 5);
        sort($numbersAPicked);
        // B
        $numbersB = range(1, 12);
        shuffle($numbersB);
        $numbersBPicked = array_slice($numbersB, 0, 2);
        sort($numbersBPicked);

        $model = new Titkos();
        $model->a1 = $numbersAPicked[0];
        $model->a2 = $numbersAPicked[1];
        $model->a3 = $numbersAPicked[2];
        $model->a4 = $numbersAPicked[3];
        $model->a5 = $numbersAPicked[4];
        $model->b1 = $numbersBPicked[0];
        $model->b2 = $numbersBPicked[1];
        $model->sorsolas = self::findNextTitok('tuesday', 'friday');
        $model->save();

        return $this->redirect(['index']);
    }

    public static function findNextTitok($day1, $day2) {
        if (date('H') > 20) {
            $now = new DateTime('+1 day');
        } else {
            $now = new DateTime();
        }
        $daysOfWeek = array(
            'sunday' => 0,
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6
        );

        $currentDay = strtolower($now->format('l')); // Get current day in lowercase
        $targetDay1 = $daysOfWeek[$day1];
        $targetDay2 = $daysOfWeek[$day2];

        $daysToAdd1 = ($targetDay1 - $daysOfWeek[$currentDay] + 7) % 7;
        $daysToAdd2 = ($targetDay2 - $daysOfWeek[$currentDay] + 7) % 7;

        $nextDay = ($daysToAdd1 <= $daysToAdd2) ? $now->modify("+$daysToAdd1 days") : $now->modify("+$daysToAdd2 days");
        return $nextDay->getTimestamp();
    }
}
