<?php

use yii\db\Migration;

/**
 * Class m231021_081453_create_table_invoice
 */
class m231021_081453_create_table_invoice extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('invoice', [
            'id' => $this->primaryKey(),
            'rental_id' => $this->integer(),
            'period_start' => $this->integer(),
            'period_end' => $this->integer(),
            'amount' => $this->integer(),
            'paid' => $this->boolean(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('invoice');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231021_081453_create_table_invoice cannot be reverted.\n";

        return false;
    }
    */
}
