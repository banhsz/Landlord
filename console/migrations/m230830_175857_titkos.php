<?php

use yii\db\Migration;

/**
 * Class m230830_175857_titkos
 */
class m230830_175857_titkos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('titkos', [
            'id' => $this->primaryKey(),
            'a1' => $this->integer(),
            'a2' => $this->integer(),
            'a3' => $this->integer(),
            'a4' => $this->integer(),
            'a5' => $this->integer(),
            'b1' => $this->integer(),
            'b2' => $this->integer(),
            'sorsolas' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('titkos');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230830_175857_titkos cannot be reverted.\n";

        return false;
    }
    */
}
