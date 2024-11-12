<?php

use yii\db\Migration;

/**
 * Class m241112_212759_update_table_notification
 */
class m241112_212759_update_table_notification extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('notification');
        $this->createTable('notification', [
            'id' => $this->primaryKey(),
            'message' => $this->string(),
            'source_class' => $this->string(),
            'source_entity' => $this->integer(),
            'type' => $this->string(),
            'read' => $this->boolean(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
