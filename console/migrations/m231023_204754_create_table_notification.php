<?php

use yii\db\Migration;

/**
 * Class m231023_204754_create_table_notification
 */
class m231023_204754_create_table_notification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('notification', [
            'id' => $this->primaryKey(),
            'message' => $this->integer(),
            'source_class' => $this->integer(),
            'source_entity' => $this->integer(),
            'read' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m231023_204754_create_table_notification cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231023_204754_create_table_notification cannot be reverted.\n";

        return false;
    }
    */
}
