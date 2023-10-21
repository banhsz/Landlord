<?php

use yii\db\Migration;

/**
 * Class m231021_173340_add_column_breakdown_to_invoice_table
 */
class m231021_173340_add_column_breakdown_to_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('invoice', 'breakdown', $this->string(8000));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('invoice', 'breakdown');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231021_173340_add_column_breakdown_to_invoice_table cannot be reverted.\n";

        return false;
    }
    */
}
