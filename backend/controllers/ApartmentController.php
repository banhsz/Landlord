<?php

namespace backend\controllers;

use backend\models\Apartment;
use backend\models\ApartmentSearch;
use backend\models\Rental;
use backend\models\RentalSearch;
use Yii;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ApartmentController implements the CRUD actions for Apartment model.
 */
class ApartmentController extends Controller
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
     * Lists all Apartment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ApartmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $columns = $this->getColumns();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'columns' => $columns
        ]);
    }

    /**
     * Displays a single Apartment model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $rentalSearchModel = new RentalSearch();
        $rentalDataProvider = $rentalSearchModel->search($this->request->queryParams);
        // Rentals for current apartment only. no shit?
        $rentalDataProvider->query->andFilterWhere(["apartment_id" => $id]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'rentalDataProvider' => $rentalDataProvider,
            'rentalSearchModel' => $rentalSearchModel,
        ]);
    }

    /**
     * Creates a new Apartment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Apartment();

        if ($this->request->isPost) {
            // Load data from POST request to model
            $model->load(Yii::$app->request->post());

            // If a thumbnail was uploaded, upload it and assign path to 'image_path'
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile) {
                $model->image_path = $model->imageFile->baseName . '.' . $model->imageFile->extension;
                if ($model->upload()) {
                    unset($model->imageFile);
                }
            }

            // Save Model
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Apartment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            // Load data from POST request to model
            $model->load(Yii::$app->request->post());

            // If a thumbnail was uploaded, upload it and assign path to 'image_path'
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile) {
                $model->image_path = $model->imageFile->baseName . '.' . $model->imageFile->extension;
                if ($model->upload()) {
                    unset($model->imageFile);
                }
            }

            // Save Model
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Apartment model.
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
     * Finds the Apartment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Apartment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apartment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function getColumns()
    {
        $columns = [
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Apartment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'mim-width: 100px;'], // Adjust the width here
                'contentOptions' => ['style' => 'min-width: 100px;'], // Adjust the width here
                'header' => 'Action'
            ],
            [
                'attribute' => 'image_path',
                'value' => function ($model) {
                    if ($model->image_path) {
                        $path = Url::to('/uploads/img/' . $model->image_path);
                    } else {
                        $path = Url::to('/img/placeholder.png');

                    }
                    return "<img class='thumbnail' src='$path'>";
                },
                'format' => 'html',
                'headerOptions' => ['style' => 'width: 100px;'], // Adjust the width here
                'contentOptions' => ['style' => 'width: 100px;'], // Adjust the width here
            ],
            //'id',
            'name',
            'address',
            [
                'attribute' => 'rent',
                'value' => function ($model) {
                    if (!isset($model->rent)) return null;
                    return number_format($model->rent, 0, ',' , '.') . 'Ft';
                },
            ],
            'rooms',
            [
                'attribute' => 'is_smoking',
                'value' => function ($model) {
                    return $this->boolRenderer($model->is_smoking);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'is_animal_allowed',
                'value' => function ($model) {
                    return $this->boolRenderer($model->is_animal_allowed);
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'is_parking_spot',
                'value' => function ($model) {
                    return $this->boolRenderer($model->is_parking_spot);
                },
                'format' => 'html',
            ],
            //'created_by',
            //'updated_by',
            //'created_at',
            //'updated_at',
        ];

        $columnsSlim = [
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Apartment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'mim-width: 100px;'], // Adjust the width here
                'contentOptions' => ['style' => 'min-width: 100px;'], // Adjust the width here
                'header' => 'Action'
            ],
            'name',
        ];

        // If mobile device, return only few columns
        if(preg_match("/iPhone|Android|iPad|iPod|webOS/", $_SERVER['HTTP_USER_AGENT'], $matches)) {
            return $columnsSlim;
        }

        // Otherwise return regular columns
        return $columns;
    }

    private function boolRenderer($value)
    {
        // null
        if (!isset($value)) return null;
        // true/false
        return $value ? "<span class='text-success'>Yes</span>" : "<span class='text-danger'>No</span>";
    }
}
