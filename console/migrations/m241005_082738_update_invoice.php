<?php

use backend\models\Invoice;
use yii\db\Migration;

/**
 * Class m241005_082738_update_invoice
 */
class m241005_082738_update_invoice extends Migration
{
    public $tableName = "invoice";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'paid_at', $this->integer()->after('paid'));
        $invoices = Invoice::find()->all();
        /** @var Invoice $invoice */
        foreach ($invoices as $invoice) {
            if ($invoice->paid) {
                $invoice->paid_at = $invoice->period_end + 172800;
                $invoice->save();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'paid_at');
    }
}
