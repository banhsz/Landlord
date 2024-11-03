<?php

namespace backend\models;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property int|null $rental_id
 * @property int|null $period_start
 * @property int|null $period_end
 * @property int|null $amount
 * @property int|null $paid
 * @property string|null $breakdown
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $paid_at
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rental_id','amount', 'paid', 'created_by',
                'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['breakdown'], 'string'],
            [['period_start', 'period_end', 'paid_at' ], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rental_id' => 'Rental ID',
            'period_start' => 'Period Start',
            'period_end' => 'Period End',
            'amount' => 'Amount',
            'paid' => 'Paid',
            'breakdown' => 'Breakdown',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'paid_at' => 'Paid At',
        ];
    }

    public function getLatestInvoice() {
        return Invoice::find()
            ->where(["rental_id" => $this->rental_id])
            ->orderBy(["period_end" => SORT_DESC])
            ->one();
    }

    public function getRental() {
        return $this->hasOne(Rental::class, ['id' => 'rental_id']);
    }

    //TODO: could be nicer
    public function renderBreakdownTable() {
        // JSON data as a string
        $jsonString = $this->breakdown;
        // Decode the JSON into a PHP array
        $data = json_decode($jsonString, true);
        // Check if decoding was successful
        if ($data !== null) {
            echo '<h1>Rent</h1>';
            echo '<div style="overflow-x:auto; font-size:13px">';
            echo '<table border="1" class="table text-end" style="width:auto">';
            echo '<tr><th>Month</th><th>Total Days</th><th>Rented Days</th><th>Monthly Rent</th><th>Daily Rent</th><th>Rent for This Month</th></tr>';
            foreach ($data as $month => $monthData) {
                echo '<tr>';
                echo '<td>' . $month . '</td>';
                echo '<td>' . $monthData['total_days_for_month'] . '</td>';
                echo '<td>' . $monthData['rented_days_for_month'] . '</td>';
                echo '<td>' . $monthData['monthly_rent'] . ' Ft' . '</td>';
                echo '<td>' . (int)$monthData['daily_rent'] . ' Ft' . '</td>';
                echo '<td><strong>' . (int)$monthData['rent_for_this_month'] . ' Ft' . '</strong></td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td><strong>Total</strong></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td><strong>' . $this->amount . ' Ft' . '</strong></td>';
            echo '</tr>';
            echo '</table>';
            echo '</div>';
        } else {
            echo 'Invalid JSON data';
        }
    }

    public static function getDashboardInvoiceData() {
        // 1) Last 5 months, ascending order
        $months = [];
        for ($i = 4; $i >= 0; $i--) {
            $months[] = date('Y F', strtotime("-$i month"));
        }

        // 2) Get the last 5 months of data (paid invoices)
        $query = (new Query())
            ->select([
                "DATE_FORMAT(FROM_UNIXTIME(paid_at), '%Y %M') AS yearMonth",
                "SUM(amount) AS totalAmount"
            ])
            ->from('invoice')
            ->where(['>=', 'FROM_UNIXTIME(paid_at)', date('Y-m-d', strtotime('-5 months'))])
            ->groupBy('yearMonth')
            ->orderBy(['yearMonth' => SORT_DESC])
            ->all();
        $queryResult = ArrayHelper::map($query, 'yearMonth', 'totalAmount');

        // 3) Map the results for the map created in 1)
        // note: mapping is done by yeah/month FORMAT so don't change format in step 1) and 2). If needed, change after 3).
        $result = [];
        foreach ($months as $month) {
            $result[] = [
                'year_month' => $month,
                'total_amount' => $queryResult[$month] ?? 0
            ];
        }

        // 4) format label/value here if needed
        // not needed for now

        return $result;
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->period_start && !is_numeric($this->period_start)) $this->period_start = strtotime($this->period_start);
            if ($this->period_end && !is_numeric($this->period_end)) $this->period_end = strtotime($this->period_end);
            if ($this->paid_at && !is_numeric($this->paid_at)) $this->paid_at = strtotime($this->paid_at);
            $this->updated_at = time();
            $this->updated_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;
            if ($this->isNewRecord) {
                $this->created_at = time();
                $this->created_by = Yii::$app->user->identity ? Yii::$app->user->identity->getId() : null;;
            }
            return true;
        }
        return false;
    }
}
