<?php

namespace backend\models;

use Yii;

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
            [['rental_id', 'period_start', 'period_end', 'amount', 'paid', 'created_by',
                'updated_by', 'created_at', 'updated_at', 'paid_at'], 'integer'],
            [['breakdown'], 'string'],
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


    //TODO: refactor this code
    public function renderBreakdownTable() {
        // JSON data as a string
        $jsonString = $this->breakdown;
        // Decode the JSON into a PHP array
        $data = json_decode($jsonString, true);
        // Check if decoding was successful
        if ($data !== null) {
            echo '<h1>Monthly breakdown of invoice amount</h1>';
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
}
