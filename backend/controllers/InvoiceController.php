<?php

namespace backend\controllers;

use app\models\Invoice;
use app\models\InvoiceSearch;
use backend\models\Rental;
use DateInterval;
use DatePeriod;
use DateTime;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends Controller
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
     * Lists all Invoice models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->orderBy(['id' => SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoice model.
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
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Invoice();

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
     * Updates an existing Invoice model.
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
     * Deletes an existing Invoice model.
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
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAutoCreateInvoices() {
        /** @var Rental[] $rentals  **/
        /** @var Invoice $latestInvoice  **/

        $rentals = Rental::find()->all();
        foreach ($rentals as $rental) {
                $invoice = new Invoice();
                $invoice->rental_id = $rental->id;

                // Calculate invoice 'period_start'
                $latestInvoice = $invoice->getLatestInvoice();
                if (!$latestInvoice) { // First invoice -> 'period_start' is 'rent_start' date
                    $invoice->period_start = $rental->rent_start;
                } else { // Not first invoice -> 'period_start' is the latest invoice 'period_end' +1 day
                    $invoice->period_start = $latestInvoice->period_end + 86400; //86400 ticks = 1 day
                }
                // This will escape all scenarios in which we would start the invoice period in the future, which
                // would be incorrect. This can happen if latest invoice is today or 'rent_start' is in the future.
                if ($invoice->period_start > time()) continue;

                // Calculate invoice 'period_end'
                if (!$rental->rent_end) { // Continuous rental. 'period_end' is today.
                    $invoice->period_end = time();
                } else { // Otherwise 'period_end' is today or 'rent_end', whichever comes first.
                    $invoice->period_end = ($rental->rent_end < time()) ? $rental->rent_end : time();
                }
                // This will escape the scenario where a period start would be after period end. This can happen
                // if we want to calculate a period start for someone who left a while ago.
                if ($invoice->period_start > $invoice->period_end) continue;

                // Calculate invoice 'amount'
                // Monthly rent is set for each apartment. However, months can have different number of days (30,31,28)
                // If someone partially rented a month, they should only pay for the days they rented, but since the
                // months have different number of days, daily rent is fluctuating. We must calculate rent per month
                // to bill accurately.
                $startDate = new DateTime();
                $startDate->setTimestamp($invoice->period_start);
                $endDate = new DateTime();
                $endDate->setTimestamp($invoice->period_end);
                $currentDate = clone $startDate;
                $interval = new DateInterval('P1D'); // 1 day interval
                $monthDays = [];
                while ($currentDate <= $endDate) {
                    $monthName = $currentDate->format('F');
                    $yearMonth = $currentDate->format('Y F');
                    if (!isset($monthDays[$yearMonth])) {
                        $monthDays[$yearMonth] = 0;
                    }
                    $monthDays[$yearMonth]++;
                    $currentDate->add($interval);
                }
                $breakdown = [];
                $sum = 0;
                foreach ($monthDays as $month => $rentedDays) {
                    // Split the year and month
                    list($year, $month) = explode(" ", $month);
                    // Create a date string for the first day of the month
                    $firstDayOfMonth = "{$year}-{$month}-01";
                    // Calculate the number of days in the month
                    $daysInMonth = date("t", strtotime($firstDayOfMonth));
                    $breakdown[$year.'-'.$month] = [
                      'total_days_for_month'    => (int)$daysInMonth,
                      'rented_days_for_month'   => (int)$rentedDays,
                      'monthly_rent'            => $rental->apartment->rent,
                      'daily_rent'              => $rental->apartment->rent / (int)$daysInMonth,
                      'rent_for_this_month'     => $rental->apartment->rent / (int)$daysInMonth * (int)$rentedDays,
                    ];
                    $sum += $breakdown[$year.'-'.$month]['rent_for_this_month'];
                }
                $invoice->amount = (int)$sum;
                //echo (json_encode($sum));
                //echo (json_encode($breakdown));
                //die();
                // FIXME: rent should only change if 1) there are no active rentals for the apartment 2) if there are active rentals, all days up until today must be invoiced

                $invoice->paid = 0;
                $invoice->breakdown = json_encode($breakdown);
                $invoice->save();
        }
        return $this->redirect(['index']);
    }


}
