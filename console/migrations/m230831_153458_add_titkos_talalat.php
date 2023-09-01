<?php

use yii\db\Migration;

/**
 * Class m230831_153458_add_titkos_talalat
 */
class m230831_153458_add_titkos_talalat extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('titkos', 'talalat', $this->string());
        $this->addColumn('titkos', 'nyeremeny', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('titkos', 'talalat');
        $this->dropColumn('titkos', 'nyeremeny');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230831_153458_add_titkos_talalat cannot be reverted.\n";

        return false;
    }
    */
}
